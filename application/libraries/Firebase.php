<?php
require_once FCPATH.'application/third_party/vendor/autoload.php';

class Firebase {

	private $messaging;
	private $firebase;

	public function __construct() {
		$serviceCredentials = FCPATH.'serviceAccount.json'; 
        $serviceAccount = Kreait\Firebase\ServiceAccount::fromJsonFile($serviceCredentials);
        
        $this->firebase = (new Kreait\Firebase\Factory)
            ->withServiceAccount($serviceAccount)
            ->create();
        $this->messaging = $this->firebase->getMessaging();
	}

	public function directNotification($notificationTitle,$notificationBody,$deviceToken,$data = array(),$androidConfig = array(), $iosConfig = array())
	{		
		$withNotification = TRUE;
		if(!empty($notificationTitle) && !empty($notificationBody))
		{
			$notification = Kreait\Firebase\Messaging\Notification::create()
	            ->withTitle($notificationTitle)
	            ->withBody($notificationBody);

	        $message = Kreait\Firebase\Messaging\MessageToRegistrationToken::create($deviceToken)
	            ->withNotification($notification) // optional            
	        ;       
	    }
	    else
	    {
	    	$withNotification = FALSE;
	    }

        if(!empty($data))
        {
        	if($withNotification)
        	{
        		$message = $message->withData($data);
        	}
        	else
        	{
        		$message = Kreait\Firebase\Messaging\MessageToRegistrationToken::create($deviceToken)
		            ->withData($data) // optional            
		        ;
        	}
        }
        if(!empty($androidConfig))
        {
        	$config = Kreait\Firebase\Messaging\AndroidConfig::fromArray($androidConfig);
        	$message = $message->withAndroidConfig($config);
        }
        if(!empty($iosConfig))
        {
        	$config = Kreait\Firebase\Messaging\ApnsConfig::fromArray($iosConfig);
        	$message = $message->withApnsConfig($config);
        }
        $result = $this->messaging->send($message);
	}

	public function topicNotification($notificationTitle,$notificationBody,$topic,$data = array(),$androidConfig = array(), $iosConfig = array())
	{
		$withNotification = TRUE;
		if(!empty($notificationTitle) && !empty($notificationBody))
		{
			$notification = Kreait\Firebase\Messaging\Notification::create()
	            ->withTitle($notificationTitle)
	            ->withBody($notificationBody);

	        $message = Kreait\Firebase\Messaging\MessageToTopic::create($topic)
	            ->withNotification($notification) // optional            
	        ;       
	    }
	    else
	    {
	    	$withNotification = FALSE;
	    }

        if(!empty($data))
        {
        	if($withNotification)
        	{
        		$message = $message->withData($data);
        	}
        	else
        	{
        		$message = Kreait\Firebase\Messaging\MessageToTopic::create($topic)
		            ->withData($data) // optional            
		        ;
        	}
        }
        if(!empty($androidConfig))
        {
        	$config = Kreait\Firebase\Messaging\AndroidConfig::fromArray($androidConfig);
        	$message = $message->withAndroidConfig($config);
        }
        if(!empty($iosConfig))
        {
        	$config = Kreait\Firebase\Messaging\ApnsConfig::fromArray($iosConfig);
        	$message = $message->withApnsConfig($config);
        }
        $result = $this->messaging->send($message);        
	}

	public function subscribeTopic($topic,$registrationTokens)
	{
		$this->firebase
            ->getMessaging()
            ->subscribeToTopic($topic, $registrationTokens);
	}

	public function unsubscribeTopic($topic,$registrationTokens)
	{
		$this->firebase
            ->getMessaging()
            ->unsubscribeFromTopic($topic, $registrationTokens);
	}

    public function multicastNotification($notificationTitle,$notificationBody,$deviceTokens,$data = array(),$androidConfig = array(), $iosConfig = array())
    {
        $withNotification = TRUE;
        if(!empty($notificationTitle) && !empty($notificationBody))
        {
            $notification = Kreait\Firebase\Messaging\Notification::create()
                ->withTitle($notificationTitle)
                ->withBody($notificationBody);

            $message = Kreait\Firebase\Messaging\CloudMessage::new()
                ->withNotification($notification) // optional            
            ;       
        }
        else
        {
            $withNotification = FALSE;
        }

        if(!empty($data))
        {
            if($withNotification)
            {
                $message = $message->withData($data);
            }
            else
            {
                $message = Kreait\Firebase\Messaging\CloudMessage::new()
                    ->withData($data) // optional            
                ;
            }
        }
        if(!empty($androidConfig))
        {
            $config = Kreait\Firebase\Messaging\AndroidConfig::fromArray($androidConfig);
            $message->withAndroidConfig($config);
        }
        if(!empty($iosConfig))
        {
            $config = Kreait\Firebase\Messaging\ApnsConfig::fromArray($iosConfig);
            $message->withApnsConfig($config);
        }
        $result = $this->messaging->sendMulticast($message,$deviceTokens);
    }
}

<!-- Messages: style can be found in dropdown.less-->
<li class="dropdown messages-menu">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <i class="fa fa-envelope-o"></i>
    <span class="label label-success unreadMessageCount"></span>
  </a>
  <ul class="dropdown-menu">
    <li class="header">
    <?php if(!$allRead){?>
      <?php if($newMessage>0){?>
        <font class="unreadMessageCountLong">You have <?php if($newMessage > 1) { echo $newMessage.' messages'; } else { echo $newMessage.' message'; }?></font>
      <?php } ?>
    <?php } else { ?>
      <font class="unreadMessageCountLong">No new messages</font>
    <?php }?>
    </li>
    <?php if(count($messageLists)>0){ ?>
    <li>
      <!-- inner menu: contains the actual data -->
      <ul class="menu">
        <?php for($i=0,$n=count($messageLists);$i<$n;$i++){?>
        <li><!-- start message -->
          <a href="#" data-toggle="modal" data-target="#quickRead" data-mid="<?php echo $messageLists[$i]['messageId']; ?>">
            <div class="pull-left">
              <img src="<?php echo $messageLists[$i]['senderImage']; ?>" class="img-circle" alt="User Image">
            </div>
            <h4>
              <?php echo $messageLists[$i]['senderName']; ?>
              <small><i class="fa fa-clock-o"></i> <?php echo $messageLists[$i]['recievedTime'];?></small>
            </h4>
            <p><?php echo $messageLists[$i]['messageTitle']; ?></p>
          </a>
        </li>
        <?php } ?>
        <!-- end message -->
      </ul>
    </li>
    <li class="footer"><a href="<?php echo site_url('message'); ?>">See All Messages</a></li>
    <?php } ?>
  </ul>
</li>
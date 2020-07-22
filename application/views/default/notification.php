<!-- Notifications: style can be found in dropdown.less -->
<li class="dropdown notifications-menu">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <i class="fa fa-bell-o"></i>
    <?php if(!$allRead) { ?>
      <span class="label label-warning"><?php echo $newNotification; ?></span>
    <?php } ?>
  </a>
  <ul class="dropdown-menu">
    <li class="header">
    <?php if(!$allRead){?>
      <?php if($newNotification > 0) {?>
        You have <?php if($newNotification > 1) { echo $newNotification.' notifications'; } else { echo $newNotification.' notification'; }?>
      <?php } ?>
    <?php } else { ?>
      No new notification
    <?php } ?>
    </li>
    <?php if(count($notificationLists)>0) { ?>
    <li>
      <!-- inner menu: contains the actual data -->
      <ul class="menu">
        <?php for($i=0,$n=count($notificationLists);$i<$n;$i++){?>
        <li>
          <a href="#">
            <i class="<?php echo $notificationLists[$i]['icon']; ?> <?php echo $notificationLists[$i]['textColor']; ?>"></i> <?php echo $notificationLists[$i]['content']; ?>
          </a>
        </li>
        <?php } ?>
      </ul>
    </li>
    <li class="footer"><a href="#">View all</a></li>
    <?php } ?>
  </ul>
</li>
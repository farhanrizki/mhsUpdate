<!-- User Account: style can be found in dropdown.less -->
<li class="dropdown user user-menu">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <img src="<?php echo $profilePic; ?>" class="user-image" alt="User Image">
    <span class="hidden-xs"><?php echo $profileName; ?></span>
  </a>
  <ul class="dropdown-menu">
    <!-- User image -->
    <li class="user-header">
      <img src="<?php echo $profilePic; ?>" class="img-circle" alt="User Image">

      <p>
        <?php echo $profileName.' - '.$profileJob; ?>
        <small>Member since <?php echo $profileReg; ?></small>
      </p>
    </li>
    <!-- Menu Body -->
    <!--
    <li class="user-body">
      <div class="row">
        <div class="col-xs-4 text-center">
          <a href="#">Followers</a>
        </div>
        <div class="col-xs-4 text-center">
          <a href="#">Sales</a>
        </div>
        <div class="col-xs-4 text-center">
          <a href="#">Friends</a>
        </div>
      </div>
    </li>
    -->
    <!-- /.row -->
    <!-- Menu Footer-->
    <!--
    <li class="user-footer">
      <div>
        <a href=http://login.whyphylabs.com class="btn btn-success btn-flat btn-block">Switch Apps</a>
      </div> 
    </li>
    -->
    <li class="user-footer">
      <div class="pull-left">
        <a href="<?php echo $profileLink; ?>" class="btn btn-default btn-flat">Profile</a>
      </div>
      <div class="pull-right">
        <a href="<?php echo site_url('logout'); ?>" class="btn btn-default btn-flat">Sign out</a>
      </div>
    </li>
  </ul>
</li>
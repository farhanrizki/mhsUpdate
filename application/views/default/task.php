<!-- Tasks: style can be found in dropdown.less -->
<li class="dropdown tasks-menu">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <i class="fa fa-flag-o"></i>
    <?php if(!$allRead) { ?>
      <span class="label label-danger"><?php echo $newTask; ?></span>
    <?php } ?>
  </a>
  <ul class="dropdown-menu">
    <li class="header">
      <?php if(!$allRead){?>
        <?php if($newTask > 0) {?>
          You have <?php if($newTask > 1) { echo $newTask.' tasks'; } else { echo $newTask.' task'; }?>
        <?php } ?>
      <?php } else { ?>
        No new notification
      <?php } ?>
    </li>
    <?php if(count($taskLists)>0) { ?>
    <li>
      <!-- inner menu: contains the actual data -->
      <ul class="menu">
        <?php for($i=0,$n=count($taskLists);$i<$n;$i++){ ?>
        <li><!-- Task item -->
          <a href="#">
            <h3>
              <?php echo $taskLists[$i]['title']; ?>
              <small class="pull-right"><?php echo $taskLists[$i]['progress']; ?>%</small>
            </h3>
            <div class="progress xs">
              <div class="progress-bar <?php echo $taskLists[$i]['barColor']; ?>" style="width: <?php echo $taskLists[$i]['progress']; ?>%" role="progressbar" aria-valuenow="<?php echo $taskLists[$i]['progress']; ?>" aria-valuemin="0" aria-valuemax="100">
                <span class="sr-only"><?php echo $taskLists[$i]['progress']; ?>% Complete</span>
              </div>
            </div>
          </a>
        </li>
        <?php } ?>
      </ul>
    </li>
    <li class="footer">
      <a href="#">View all tasks</a>
    </li>
    <?php } ?>
  </ul>
</li>
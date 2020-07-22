<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo $profileData['profilePic']; ?>" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo $profileData['profileName']; ?></p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <?php if($showSearch) { ?>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
    <?php } ?>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <?php for($i=0,$n=count($menuData);$i<$n;$i++){?>
        <?php if($menuData[$i]['menuVisible']) { ?>
        <li class="header"><?php echo $menuData[$i]['menuHeader']; ?></li>
        <?php } ?>
        <?php if(isset($menuData[$i]['menuList']) && $menuData[$i]['menuVisible']) { ?>
          <?php for($j=0,$m=count($menuData[$i]['menuList']);$j<$m;$j++){?>
            <?php if($menuData[$i]['menuList'][$j]['menuVisible']){ ?>
              <?php if(count($menuData[$i]['menuList'][$j]['menuChild'])>0){ ?>
              <li class="treeview <?php echo $menuData[$i]['menuList'][$j]['menuActive']; ?>">
                <a href="#">            
                  <i class="<?php echo $menuData[$i]['menuList'][$j]['menuIcon']; ?>"></i> 
                  <span><?php echo $menuData[$i]['menuList'][$j]['menuName']; ?></span> 
                  <?php if(isset($menuData[$i]['menuList'][$j]['showNotif'])) { ?>
                    <span class="label <?php echo $menuData[$i]['menuList'][$j]['menuNotifColor']; ?> pull-right"><?php echo $menuData[$i]['menuList'][$j]['menuNotif']; ?></span>
                  <?php } else { ?>
                    <i class="fa fa-angle-left pull-right"></i>
                  <?php } ?>
                </a>
                <ul class="treeview-menu">
                  <?php for($k=0,$o=count($menuData[$i]['menuList'][$j]['menuChild']);$k<$o;$k++){ ?>
                    <?php if($menuData[$i]['menuList'][$j]['menuChild'][$k]['menuVisible']){ ?>
                      <?php if(count($menuData[$i]['menuList'][$j]['menuChild'][$k]['menuChild']) > 0) { ?>
                        <li class="<?php echo $menuData[$i]['menuList'][$j]['menuChild'][$k]['menuActive']; ?>">
                          <a href="#">
                            <i class="<?php echo $menuData[$i]['menuList'][$j]['menuChild'][$k]['menuIcon']; ?>"></i> <?php echo $menuData[$i]['menuList'][$j]['menuChild'][$k]['menuName']; ?> <i class="fa fa-angle-left pull-right"></i>
                          </a>
                          <ul class="treeview-menu">
                          <?php for($l=0,$p=count($menuData[$i]['menuList'][$j]['menuChild'][$k]['menuChild']);$l<$p;$l++) { ?>
                            <?php if($menuData[$i]['menuList'][$j]['menuChild'][$k]['menuChild'][$l]['menuVisible']){ ?>
                              <?php if(count($menuData[$i]['menuList'][$j]['menuChild'][$k]['menuChild'][$l]['menuChild'])>0) { ?>
                                <li class="<?php echo $menuData[$i]['menuList'][$j]['menuChild'][$k]['menuChild'][$l]['menuActive']; ?>">
                                  <a href="#">
                                    <i class="<?php echo $menuData[$i]['menuList'][$j]['menuChild'][$k]['menuChild'][$l]['menuIcon']; ?>"></i> <?php echo $menuData[$i]['menuList'][$j]['menuChild'][$k]['menuChild'][$l]['menuName']; ?> <i class="fa fa-angle-left pull-right"></i>
                                  </a>
                                  <ul class="treeview-menu">
                                  <?php for($x=0,$y=count($menuData[$i]['menuList'][$j]['menuChild'][$k]['menuChild'][$l]['menuChild']);$x<$y;$x++){?>
                                    <?php if($menuData[$i]['menuList'][$j]['menuChild'][$k]['menuChild'][$l]['menuChild'][$x]['menuVisible']){ ?>
                                      <li class="<?php echo $menuData[$i]['menuList'][$j]['menuChild'][$k]['menuChild'][$l]['menuChild'][$x]['menuActive']; ?>"><a href="<?php if(strripos($menuData[$i]['menuList'][$j]['menuChild'][$k]['menuChild'][$l]['menuChild'][$x]['menuLink'], 'http') === FALSE) { echo site_url($menuData[$i]['menuList'][$j]['menuChild'][$k]['menuChild'][$l]['menuChild'][$x]['menuLink']); } else { echo $menuData[$i]['menuList'][$j]['menuChild'][$k]['menuChild'][$l]['menuChild'][$x]['menuLink']; } ?>"><i class="<?php echo $menuData[$i]['menuList'][$j]['menuChild'][$k]['menuChild'][$l]['menuChild'][$x]['menuIcon']; ?>"></i> <?php echo $menuData[$i]['menuList'][$j]['menuChild'][$k]['menuChild'][$l]['menuChild'][$x]['menuName']; ?></a></li>
                                    <?php } ?>
                                  <?php } ?>
                                  </ul>
                                </li>
                              <?php } else { ?>
                                <li class="<?php echo $menuData[$i]['menuList'][$j]['menuChild'][$k]['menuChild'][$l]['menuActive']; ?>"><a href="<?php if(strripos($menuData[$i]['menuList'][$j]['menuChild'][$k]['menuChild'][$l]['menuLink'], 'http') === FALSE) { echo site_url($menuData[$i]['menuList'][$j]['menuChild'][$k]['menuChild'][$l]['menuLink']); } else { echo $menuData[$i]['menuList'][$j]['menuChild'][$k]['menuChild'][$l]['menuLink']; } ?>"><i class="<?php echo $menuData[$i]['menuList'][$j]['menuChild'][$k]['menuChild'][$l]['menuIcon']; ?>"></i> <?php echo $menuData[$i]['menuList'][$j]['menuChild'][$k]['menuChild'][$l]['menuName']; ?></a></li>
                              <?php } ?>
                            <?php } ?>
                          <?php } ?>
                          </ul>
                        </li>
                      <?php } else { ?>
                        <li class="<?php echo $menuData[$i]['menuList'][$j]['menuChild'][$k]['menuActive']; ?>"><a href="<?php if(strripos($menuData[$i]['menuList'][$j]['menuChild'][$k]['menuLink'], 'http') === FALSE) { echo site_url($menuData[$i]['menuList'][$j]['menuChild'][$k]['menuLink']); } else { echo $menuData[$i]['menuList'][$j]['menuChild'][$k]['menuLink']; }?>"><i class="<?php echo $menuData[$i]['menuList'][$j]['menuChild'][$k]['menuIcon']; ?>"></i> <?php echo $menuData[$i]['menuList'][$j]['menuChild'][$k]['menuName']; ?></a></li>
                      <?php } ?>
                    <?php } ?>
                  <?php } ?>
                </ul>
              </li>   
              <?php } else {?>
              <li class="<?php echo $menuData[$i]['menuList'][$j]['menuActive']; ?>">
                <a href="<?php if(strripos($menuData[$i]['menuList'][$j]['menuLink'], 'http') === FALSE) { echo site_url($menuData[$i]['menuList'][$j]['menuLink']); } else { echo $menuData[$i]['menuList'][$j]['menuLink']; } ?>">
                  <i class="<?php echo $menuData[$i]['menuList'][$j]['menuIcon']; ?>"></i> <span><?php echo $menuData[$i]['menuList'][$j]['menuName']; ?></span> 
                  
                  <?php if($menuData[$i]['menuList'][$j]['menuNotif'] > 0 || !empty($menuData[$i]['menuList'][$j]['menuNotif'])) {?>
                    <small class="label pull-right <?php echo $menuData[$i]['menuList'][$j]['menuNotifColor']; ?>"><?php echo $menuData[$i]['menuList'][$j]['menuNotif']; ?></small>
                  <?php } ?>
                </a>
              </li>
              <?php } ?>
            <?php } ?>            
          <?php } ?>
        <?php } ?>
      <?php } ?>               
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
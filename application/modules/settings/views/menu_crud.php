<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Menu Management
    <small>Manage your backend menu</small>
  </h1>
  <ol class="breadcrumb">
    <?php for($i=0,$n=count($breadcrumb);$i<$n;$i++) { ?>
      <?php if($i != $n-1) { ?>
        <li><a href="<?php echo $breadcrumb[$i]['link'];?>"><i class="<?php if(isset($breadcrumb[$i]['icon'])) { echo $breadcrumb[$i]['icon']; } ?>"></i> <?php echo $breadcrumb[$i]['name'];?></a></li>
      <?php } else { ?>
        <li class="active"><?php echo $breadcrumb[$i]['name'];?></li>
      <?php } ?>
    <?php } ?>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-6 col-lg-6 col-xs-12">
      <?php if(isset($addFlag)){
          $boxClass = 'box-success';
          $boxTitle = 'New Details';
        }
        else
        {
          $boxClass = 'box-warning';
          $boxTitle =  'Edit Details';
        }
        ?>
      <div class="box <?php echo $boxClass; ?>">
        <div class="box-header with-border">
          <i class="fa fa-text-width"></i>
          <h3 class="box-title"><?php echo $boxTitle; ?></h3>

        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <!--<form role="form">-->
        <?php 
          if(isset($addFlag))
          {
            if(!empty($menuDetails['menuId']))
            {
              echo form_open('settings/menu/save/'.$menuDetails['menuId'].'/'.$menuDetails['parentId'].'/new',array('role'=>'form'));     
            }
            else
            {
              echo form_open('settings/menu/save/new',array('role'=>'form'));      
            }
          }
          else
          {
            echo form_open('settings/menu/save/'.$menuDetails['menuId'].'/'.$menuDetails['parentId'],array('role'=>'form'));     
          }
          ?>
          <div class="box-body">
            <div class="form-group">
              <label for="NameLabel">Name</label>
              <input type="text" class="form-control" id="mnuName" name="mnuName" placeholder="Enter menu name" value="<?php echo $menuDetails['name']; ?>" required>
            </div>
            <?php if(isset($menuDetails['details'])) { ?>
              <div class="form-group">
                <label for="LinkLabel">Link</label>
                <input type="text" class="form-control" id="mnuLink" name="mnuLink" placeholder="Link" value="<?php echo $menuDetails['details']['menuLink']; ?>" required>
                <p class="help-block">Please provide <b><i>'http://'</i></b> for outside link or system will treat it using <b><i>site_url()</i></b> method.</p>
              </div>
              <div class="form-group">
                <label for="IconLabel">Icon</label>
                <input type="text" class="form-control" id="mnuIcon" name="mnuIcon" placeholder="Icon name. Ex: fa fa-gears" value="<?php echo $menuDetails['details']['menuIcon']; ?>" required>
                <p class="help-block">See <b><i><a href="<?php echo site_url('ui/icons'); ?>" target="_blank">this page</a></i></b> for icon lists.</p>
              </div>
              <div class="form-group">
                <label>Notification Color</label>
                <select class="form-control" name="mnuNotifColor" id="mnuNotifColor">
                  <option value=''>No Color</option>
                  <option value='1' <?php if(!empty($menuDetails['details']['menuNotifColor']) && $menuDetails['details']['menuNotifColor'] == 'bg-green') { echo 'selected'; } ?>>bg-green</option>
                  <option value='2' <?php if(!empty($menuDetails['details']['menuNotifColor']) && $menuDetails['details']['menuNotifColor'] == 'bg-red') { echo 'selected'; } ?>>bg-reg</option>
                  <option value='3' <?php if(!empty($menuDetails['details']['menuNotifColor']) && $menuDetails['details']['menuNotifColor'] == 'bg-yellow') { echo 'selected'; } ?>>bg-yellow</option>
                  <option value='4' <?php if(!empty($menuDetails['details']['menuNotifColor']) && $menuDetails['details']['menuNotifColor'] == 'label-primary') { echo 'selected'; } ?>>label-primary</option>
                </select>
              </div>
            <?php } ?>
          </div>
          <!-- /.box-body -->

          <div class="box-footer">
            <a href="<?php echo site_url('settings/menu/details/'.$menuDetails['menuId'].'/'.$menuDetails['parentId']);?>"><button class="btn btn-default" type="button"><i class="fa fa-caret-left"></i> Cancel</button></a>
            <button type="submit" class="btn btn-primary pull-right">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->
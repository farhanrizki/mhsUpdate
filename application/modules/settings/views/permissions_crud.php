<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Permissions Management
    <small>Manage your backend permissions</small>
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
    <div class="col-md-12 col-lg-12 col-xs-12">
      <?php
        if(isset($alertData)) {
          for($i=0,$n=count($alertData);$i<$n;$i++){ ?>
            <div class="alert <?php echo $alertData[$i]['alertType']; ?> alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="icon <?php echo $alertData[$i]['alertIcon']; ?>"></i> <?php echo $alertData[$i]['alertCaption']; ?></h4>
              <?php echo $alertData[$i]['alertContent']; ?>
            </div>
      <?php
          }
        }
      ?>      
    </div>
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
        <?php if(isset($addFlag))
          {
            echo form_open('settings/permissions/save/new',array('role'=>'form')); 
          }
          else
          {
            echo form_open('settings/permissions/save/'.$permissionDetails['permissionId'],array('role'=>'form'));
          }
          ?>
          <div class="box-body">
            <div class="form-group">
              <label for="NameLabel">Permissions Name</label>
              <input type="text" class="form-control" id="pName" name="pName" value="<?php if(isset($permissionDetails)) echo $permissionDetails['name']; ?>" required>
            </div>
            <div class="form-group">
              <label for="PassLabel">Description</label>
              <input type="text" class="form-control" id="pDesc" name="pDesc" value="<?php if(isset($permissionDetails)) echo $permissionDetails['desc']; ?>" required>
            </div>
          </div>
          <!-- /.box-body -->

          <div class="box-footer">
            <a href="<?php echo site_url('settings/permissions/');?>"><button class="btn btn-default" type="button"><i class="fa fa-caret-left"></i> Cancel</button></a>
            <button type="submit" class="btn btn-primary pull-right">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->
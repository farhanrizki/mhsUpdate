<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Groups Management
    <small>Manage your backend groups</small>
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
            echo form_open('settings/groups/save/new',array('role'=>'form')); 
          }
          else
          {
            echo form_open('settings/groups/save/'.$groupDetails['groupId'],array('role'=>'form'));
          }
          ?>
          <div class="box-body">
            <div class="form-group">
              <label for="NameLabel">Group Name</label>
              <input type="text" class="form-control" id="gName" name="gName" value="<?php if(isset($groupDetails)) echo $groupDetails['name']; ?>" required>
            </div>
            <div class="form-group">
              <label for="PassLabel">Description</label>
              <input type="text" class="form-control" id="gDesc" name="gDesc" value="<?php if(isset($groupDetails)) echo $groupDetails['desc']; ?>" required>
            </div>
            <div class="form-group">
                <label>Permission</label>
                
                <select class="form-control select2" multiple="multiple" style="width: 100%;" name="gPermission[]">
                <?php foreach($permissionList as $pId => $pVal) { ?>
                  <option value="<?php echo $pId; ?>" <?php if(in_array($pId, $groupPermission) !== FALSE ) { echo 'selected="selected"'; }?>><?php echo $pVal; ?></option>
                <?php } ?>
                </select>
                <p class="help-block"><i>Please note that all user inside the same group will be affected.</i></p>
                
              </div>
          </div>
          <!-- /.box-body -->

          <div class="box-footer">
            <?php if(isset($groupId)){ ?>
              <input type="hidden" id="gId" name="gId" value="<?php echo $groupId; ?>" required>
            <?php } ?>
            <a href="<?php echo site_url('settings/groups/');?>"><button class="btn btn-default" type="button"><i class="fa fa-caret-left"></i> Cancel</button></a>
            <button type="submit" class="btn btn-primary pull-right">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->
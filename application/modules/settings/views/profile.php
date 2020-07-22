<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    User Profile
  </h1>
  <ol class="breadcrumb">
    <?php if($longBreadcrumb){?>
      <li><a href="#"><i class="fa fa-cogs"></i> Settings</a></li>
      <li><a href="<?php echo site_url('settings/users'); ?>">Users</a></li>
      <li class="active">Profile</li>
    <?php } else { ?>
      <li class="active"><i class="fa fa-user"></i> Profile</li>
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
    <div class="col-md-3">

      <!-- Profile Image -->
      <div class="box box-primary">
        <div class="box-body box-profile">
          <img class="profile-user-img img-responsive img-circle" src="<?php echo $profilePic; ?>" alt="<?php echo $profileName; ?>">

          <h3 class="profile-username text-center"><?php echo $profileName; ?></h3>

          <p class="text-muted text-center"><?php echo $profileJob; ?></p>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
    <div class="col-md-9">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <?php if($this->aauth->is_allowed('user_log')) { 
            $activeSettings = '';
          ?>
            <li class="active"><a href="#activity" data-toggle="tab">Activity</a></li>
          <?php } else { 
            $activeSettings = 'class="active"';
          } ?>
          <li <?php echo $activeSettings; ?>><a href="#settings" data-toggle="tab">Settings</a></li>
          <?php if($this->aauth->is_allowed('user_password')){?>
            <li><a href="#cp" data-toggle="tab">Change Password</a></li>
          <?php } ?>
        </ul>
        <div class="tab-content">
          <?php if($this->aauth->is_allowed('user_log')) { 
            $activeSettings = '';
          ?>
            <div class="active tab-pane" id="activity">
              <h3>Activity</h3>
              <!-- The timeline -->
              <ul class="timeline timeline-inverse">
                <!-- timeline time label -->
                <li class="time-label">
                      <span class="bg-red">
                        No Activity
                      </span>
                </li>
               
                <li>
                  <i class="fa fa-clock-o bg-gray"></i>
                </li>
              </ul>
            </div>
            <!-- /.tab-pane -->
          <?php } else { 
            $activeSettings = 'active';
          } ?>
          <div class="<?php echo $activeSettings; ?> tab-pane" id="settings">
            <!--<form class="form-horizontal">-->
            <?php echo form_open_multipart('settings/users/save/profile',array("class"=>'form-horizontal')) ; ?>
              <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputName" name="pName" placeholder="Name" value="<?php echo $profileName; ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                  <input type="email" class="form-control" id="inputEmail" name="pEmail" placeholder="Email" value="<?php echo $profileEmail; ?>" disabled="disabled">
                </div>
              </div>
              <div class="form-group">
                <label for="inputJob" class="col-sm-2 control-label">Job Title</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputName" name="pJob" placeholder="Job Title" value="<?php echo $profileJob; ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="profPicture" class="col-sm-2 control-label">Profile Picture</label>
                <div class="col-sm-10">
                  <input type="file" id="profPicture" name="userfile">
                  <p class="help-block"><i>Choose profile picture.</i></p>                  
                </div>
              </div>
              <?php if($this->aauth->is_allowed('user_group')) { ?>
              <div class="form-group">
                <label class="col-sm-2 control-label">Groups</label>
                <div class="col-sm-10">
                  <select class="form-control select2" multiple="multiple" data-placeholder="Choose Group" style="width: 100%;" name="pGroups[]">
                  <?php foreach($groupList as $gId => $gVal) { ?>
                    <option value="<?php echo $gId; ?>" <?php if(in_array($gId, $userGroup) !== FALSE ) { echo 'selected="selected"'; }?>><?php echo $gVal; ?></option>
                  <?php } ?>
                  </select>
                </div>
              </div>
              <?php } ?>
              <?php if($this->aauth->is_allowed('user_permission')){?>
              <div class="form-group">
                <label class="col-sm-2 control-label">Permission</label>
                <div class="col-sm-10">
                  <select class="form-control select2" multiple="multiple" style="width: 100%;" name="pPermission[]">
                  <?php foreach($permissionList as $pId => $pVal) { ?>
                    <option value="<?php echo $pId; ?>" <?php if(in_array($pId, $userPermission) !== FALSE ) { echo 'selected="selected"'; }?>><?php echo $pVal; ?></option>
                  <?php } ?>
                  </select>
                  <p class="help-block"><i>Please note that user will also have group permissions.</i></p>
                </div>
              </div>
              <?php } ?>
              <?php if($this->aauth->is_allowed('user_edit')){?>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <input type="hidden" name="pId" value="<?php echo $profileId; ?>"/>
                  <button type="submit" class="btn btn-info">Submit</button>
                </div>
              </div>
              <?php } ?>
            </form>
          </div>
          <!-- /.tab-pane -->
          <?php if($this->aauth->is_allowed('user_password')){?>
            <div class="tab-pane" id="cp">
              <!--<form class="form-horizontal">-->
              <?php echo form_open('settings/users/save/password',array("class"=>'form-horizontal')) ; ?>
                <div class="form-group">
                  <label for="inputPass" class="col-sm-2 control-label">New Password</label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control" id="inputPass" name="pPass" placeholder="New Password" value="">
                  </div>
                </div>
                <div class="form-group">
                  <label for="confPass" class="col-sm-2 control-label">Re-type New Password</label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control" id="confPass" name="cpPass" placeholder="Re-type New Password" value="">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <input type="hidden" name="pId" value="<?php echo $profileId; ?>"/>
                    <button type="submit" class="btn btn-danger">Change</button>
                  </div>
                </div>
              </form>
            </div>
            <!-- /.tab-pane -->
          <?php } ?>
        </div>
        <!-- /.tab-content -->
      </div>
      <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->
    <?php if($this->aauth->is_allowed('user_log')) { ?>
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">User Log</h3>
        </div>
        <div class="box-body">
          <table id="userLog" class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
              <th>No. </th>
              <th>Activity</th>
              <th>URL</th>
              <th>IP</th>
              <th>Log Date</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
             
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="modal fade" id="showDetails" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Log Details</h4>
          </div>
          <div class="modal-body">
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
    </div>
    <?php } ?>
  </div>
  <!-- /.row -->

</section>
<!-- /.content -->
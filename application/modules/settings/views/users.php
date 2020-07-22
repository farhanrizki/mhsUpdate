<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Users Management
    <small>Manage your backend users</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-gears"></i> Settings</a></li>
    <li class="active">Users</li>
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
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Segment</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
              <th>No. </th>
              <th>Email</th>
              <th>Username</th>
              <th>Group</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
              <?php for($i=0,$n=count($userData);$i<$n;$i++) { ?>
              <tr>
                <td><?php echo $i+1;?></td>
                <td><?php echo $userData[$i]['email']; ?></td>
                <td><?php echo $userData[$i]['username']; ?></td>
                <td><?php echo $userData[$i]['group']; ?></td>
                <td>
                  <?php if($userData[$i]['bannedState']) { echo 'Banned'; } else { echo 'Active'; } ?>
                </td>
                <td>
                  <?php if($this->aauth->is_allowed('user_common')){?>
                    <a href="<?php echo site_url('settings/users/profile/'.$userData[$i]['id']); ?>" class="fa fa-user" alt="Profile" title="Profile"></a>
                  <?php } ?>
                  <?php if($this->aauth->is_allowed('user_ban') || $this->aauth->is_allowed('user_unban')){?>
                    <?php if(empty($userData[$i]['bannedState'])) {?>
                      <?php if($this->aauth->is_allowed('user_ban')){?>
                        <a href="<?php echo site_url('settings/users/ban/'.$userData[$i]['id']); ?>" class="fa fa-ban" alt="Ban" title="Ban"></a>
                      <?php } ?>
                    <?php } else { ?>
                      <?php if($this->aauth->is_allowed('user_unban')){?>
                        <a href="<?php echo site_url('settings/users/unban/'.$userData[$i]['id']); ?>" class="fa fa-retweet" alt="Unban" title="Unban"></a>
                      <?php } ?>
                    <?php } ?>
                  <?php } ?>
                </td>
              </tr>
              <?php } ?>
            </tbody>
            <tfoot>
            <tr>
              <th>No. </th>
              <th>Email</th>
              <th>Username</th>
              <th>Group</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.box-body -->
        <?php if($this->aauth->is_allowed('user_add')){?>
          <div class="box-footer">
            <a href="<?php echo site_url('settings/users/add/'); ?>"><button class="btn btn-info pull-right"><i class="fa fa-plus"></i> Add</button></a>
          </div>
        <?php } ?>
      </div>
      <!-- /.box -->
    </div>
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->

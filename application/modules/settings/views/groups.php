<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Groups Management
    <small>Manage your backend groups</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-gears"></i> Settings</a></li>
    <li class="active">Groups</li>
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
              <th>Name</th>
              <th>Description</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
              <?php for($i=0,$n=count($groupList);$i<$n;$i++) { ?>
              <tr>
                <td><?php echo $i+1;?></td>
                <td><?php echo $groupList[$i]->name; ?></td>
                <td><?php echo $groupList[$i]->definition; ?></td>
                <td>
                  <?php if($this->aauth->is_allowed('group_edit')){?>
                    <a href="<?php echo site_url('settings/groups/edit/'.$groupList[$i]->id); ?>" class="fa fa-edit" alt="Edit" title="Edit"></a>
                  <?php } ?>
                  <?php if($this->aauth->is_allowed('group_common')){?>
                    <a href="<?php echo site_url('settings/groups/details/'.$groupList[$i]->id); ?>" class="fa fa-navicon" alt="Show Content" title="Show Content"></a>
                  <?php } ?>
                  <?php if($this->aauth->is_allowed('group_delete')){?>
                    <a href="<?php echo site_url('settings/groups/delete/'.$groupList[$i]->id); ?>" class="fa fa-remove" alt="Delete" title="Delete"></a>
                  <?php } ?>
                </td>
              </tr>
              <?php } ?>
            </tbody>
            <tfoot>
            <tr>
              <th>No. </th>
              <th>Name</th>
              <th>Description</th>
              <th>Action</th>
            </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.box-body -->
        <?php if($this->aauth->is_allowed('group_add')){?>
          <div class="box-footer">
            <a href="<?php echo site_url('settings/groups/add/'); ?>"><button class="btn btn-info pull-right"><i class="fa fa-plus"></i> Add</button></a>
          </div>
        <?php } ?>
      </div>
      <!-- /.box -->
    </div>
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->

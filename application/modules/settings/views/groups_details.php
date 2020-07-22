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
      <div class="box box-primary">
        <div class="box-header with-border">
          <i class="fa fa-text-width"></i>
          <h3 class="box-title">Details</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <dl class="dl-horizontal">
            <dt>Name</dt>
            <dd><?php echo $groupDetails['name']; ?></dd>
            <dt>Description</dt>
            <dd><?php echo $groupDetails['desc']; ?></dd>
          </dl>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <?php if($this->aauth->is_allowed('group_delete')){?>
            <a href="<?php echo site_url('settings/groups/delete/'.$groupDetails['groupId']); ?>"><button class="btn btn-danger pull-right"><i class="fa fa-remove"></i> Delete</button></a>
          <?php } ?>
          <?php if($this->aauth->is_allowed('group_edit')){?>
            <a href="<?php echo site_url('settings/groups/edit/'.$groupDetails['groupId']); ?>"><button class="btn btn-warning"><i class="fa fa-edit"></i> Edit</button></a>
          <?php } ?>
        </div>
      </div>
    </div>
    <div class="col-xs-12 col-md-6 col-lg-6">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Child Group ( Subgroups ) List</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
          
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
              <th>Name</th>
              <th>Description</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
             <?php for($i=0,$n=count($groupChild);$i<$n;$i++) { ?>
              <tr>
                <td><?php echo $groupChild[$i]['name']; ?></td>
                <td><?php echo $groupChild[$i]['definition']; ?></td>
                <td>
                  <?php if($this->aauth->is_allowed('group_edit')){?>
                    <a href="<?php echo site_url('settings/groups/edit/'.$groupChild[$i]['id']); ?>" class="fa fa-edit" alt="Edit" title="Edit"></a> 
                  <?php } ?>
                  <?php if($this->aauth->is_allowed('group_common')){?>
                    <a href="<?php echo site_url('settings/groups/details/'.$groupChild[$i]['id']); ?>" class="fa fa-navicon" alt="Show Content" title="Show Content"></a>
                  <?php } ?>
                  <?php if($this->aauth->is_allowed('group_delete')){?>
                    <a href="<?php echo site_url('settings/groups/delete/'.$groupChild[$i]['id']); ?>" class="fa fa-remove" alt="Delete" title="Delete"></a>
                  <?php } ?>
                </td>
              </tr>
              <?php } ?>
            </tbody>
            <tfoot>
            <tr>
              <th>Name</th>
              <th>Order</th>
              <th>Action</th>
            </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.box-body -->
        <?php if($this->aauth->is_allowed('group_add')){?>
          <div class="box-footer">
            <a href="<?php echo site_url('settings/groups/add/'.$groupDetails['groupId']); ?>"><button class="btn btn-info pull-right"><i class="fa fa-plus"></i> Add</button></a>
          </div>
        <?php } ?>
      </div>
      <!-- /.box -->
    </div>
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->
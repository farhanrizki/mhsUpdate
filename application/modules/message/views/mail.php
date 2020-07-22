<!-- EXTERNAL IMPLEMENTATION SINCE WE DO NOT SUPPORT MEDIA ON CSS -->
<link rel="stylesheet" href="<?php echo site_url(); ?>assets/skin/plugins/fullcalendar/fullcalendar.print.css" media="print">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Mailbox
    <?php if($unreadPm > 0){ ?>
      <small><font class="unreadMessageCountLong"></font></small>
    <?php } else { ?>
      <small><font class="unreadMessageCountLong">No new message</font></small>
    <?php } ?>
  </h1>
  <ol class="breadcrumb">
    <li class="active"><i class="fa fa-envelope"></i> Mailbox</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-3">
      <button class="btn btn-primary btn-block margin-bottom" id="compose">Compose</button>

      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Folders</h3>

          <div class="box-tools">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="box-body no-padding">
          <ul class="nav nav-pills nav-stacked" id="mailNav">
            <li class="active" id="inbox"><a href="#"><i class="fa fa-inbox"></i> Inbox <span class="label label-primary pull-right unreadMessageCount"></span></a></li>
            <li id="sent"><a href="#"><i class="fa fa-envelope-o"></i> Sent</a></li>
            <!--<li id="drafts"><a href="#"><i class="fa fa-file-text-o"></i> Drafts</a></li>
            <li id="junk"><a href="#"><i class="fa fa-filter"></i> Junk <span class="label label-warning pull-right">65</span></a>
            </li>-->
            <li id="trash"><a href="#"><i class="fa fa-trash-o"></i> Trash</a></li>
          </ul>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /. box -->
      <!--<div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Labels</h3>

          <div class="box-tools">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="box-body no-padding">
          <ul class="nav nav-pills nav-stacked">
            <li><a href="#"><i class="fa fa-circle-o text-red"></i> Important</a></li>
            <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> Promotions</a></li>
            <li><a href="#"><i class="fa fa-circle-o text-light-blue"></i> Social</a></li>
          </ul>
        </div>
      </div>-->
      <!-- /.box -->
    </div>
    <!-- /.col -->
    <div class="col-md-9">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title" id="mailboxTitle">Inbox</h3>

          <div class="box-tools pull-right">
            <div class="has-feedback">
              <input type="text" class="form-control input-sm" placeholder="Search">
              <span class="glyphicon glyphicon-search form-control-feedback"></span>
            </div>
          </div>
          <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body" id="composeView">
          <div class="form-group">
            <select id="pmDest" class="form-control select2" multiple="multiple" style="width: 100%;" name="pPermission[]" data-placeholder="To:">
              <?php for($i=0,$n=count($availableDest);$i<$n;$i++) {?>
                <option value="<?php echo $availableDest[$i]['id']; ?>"><?php echo $availableDest[$i]['name']; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <input type="text" id="pmTitle" class="form-control" placeholder="Subject:">
          </div>
          <div class="form-group">
                <textarea id="pmContent" class="form-control" style="height: 300px"></textarea>
          </div>
        </div>
        <div class="box-body no-padding" id="messageList">
          <div class="mailbox-controls">
            <!-- Check all button -->
            <button type="button" class="btn btn-default btn-sm checkbox-toggle" data-toggle="tooltip" data-container="body" title="Check All"><i class="fa fa-square-o"></i>
            </button>
            <div class="btn-group">
              <button type="button" class="btn btn-default btn-sm deleteBox" data-toggle="tooltip" data-container="body" title="Delete"><i class="fa fa-trash-o"></i></button>
              <!--<button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
              <button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>-->
            </div>
            <!-- /.btn-group -->
            <button type="button" class="btn btn-default btn-sm refreshBox" data-toggle="tooltip" data-container="body" title="Refresh"><i class="fa fa-refresh"></i></button>
            <div class="pull-right">
              <!--<?php if(isset($totalOffset)) { $starting = 10*$totalOffset; echo $starting; } else { $starting=0; echo '1'; } ?>-<?php echo $starting+10; ?>/<?php echo $totalPm; ?>-->
              <div class="btn-group">
                <button type="button" class="btn btn-default btn-sm prevPage" data-toggle="tooltip" data-container="body" title="Previous"><i class="fa fa-chevron-left"></i></button>
                <button type="button" class="btn btn-default btn-sm nextPage" data-toggle="tooltip" data-container="body" title="Next"><i class="fa fa-chevron-right"></i></button>
              </div>
              <!-- /.btn-group -->
            </div>
            <!-- /.pull-right -->
          </div>
          <div class="table-responsive mailbox-messages">
            <table class="table table-hover table-striped">
              <tbody id="boxContent">
              
              </tbody>
            </table>
            <!-- /.table -->
          </div>
          <!-- /.mail-box-messages -->
        </div>
        <div class="box-body no-padding" id="readingView">
          <div class="mailbox-read-info">
            <h3 id="messageTitle"></h3>
            <h5>From: <font id="messageSender"></font>
              <span class="mailbox-read-time pull-right" id="messageTime"></span></h5>
          </div>
          <!-- /.mailbox-read-info -->
          <div class="mailbox-controls with-border text-center">
            <div class="btn-group">
              <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Delete">
                <i class="fa fa-trash-o"></i></button>
              <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Reply">
                <i class="fa fa-reply"></i></button>
            </div>
            <!-- /.btn-group -->
          </div>
          <!-- /.mailbox-controls -->
          <div class="mailbox-read-message" id="messageContent">
            
          </div>
          <!-- /.mailbox-read-message -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer no-padding">
          <div class="mailbox-controls">
            <!-- Check all button -->
            <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
            </button>
            <div class="btn-group">
              <button type="button" class="btn btn-default btn-sm deleteBox"><i class="fa fa-trash-o"></i></button>
              <!--<button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
              <button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>-->
            </div>
            <!-- /.btn-group -->
            <button type="button" class="btn btn-default btn-sm refreshBox"><i class="fa fa-refresh"></i></button>
            <div class="pull-right">
              <!--<?php if(isset($totalOffset)) { $starting = 10*$totalOffset; echo $starting; } else { $starting=0; echo '1'; } ?>-<?php echo $starting+10; ?>/<?php echo $totalPm; ?>-->
              <div class="btn-group ">
                <button type="button" class="btn btn-default btn-sm prevPage" data-toggle="tooltip" data-container="body" title="Previous"><i class="fa fa-chevron-left prevPage"></i></button>
                <button type="button" class="btn btn-default btn-sm nextPage" data-toggle="tooltip" data-container="body" title="Next"><i class="fa fa-chevron-right nextPage"></i></button>
              </div>
              <!-- /.btn-group -->
            </div>
            <!-- /.pull-right -->
          </div>
          <div id="composeControls">
            <div class="pull-right">
              <button type="submit" class="btn btn-primary" id="sendMessage"><i class="fa fa-envelope-o"></i> Send</button>
            </div>
            <button type="reset" class="btn btn-default" id="discardMessage"><i class="fa fa-times"></i> Discard</button>
          </div>
        </div>
        <div class="overlay" id="loadingState">
          <i class="fa fa-refresh fa-spin"></i>
        </div>
      </div>
      <!-- /. box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->
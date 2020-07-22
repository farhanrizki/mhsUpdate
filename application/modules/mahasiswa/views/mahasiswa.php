<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Mahasiswa
    <small>Tabel Mahasiswa</small>
  </h1>
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
            <table id="tablemhs" class="table table-bordered table-striped table-hover display">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Nama</th>
                  <th>Alamat</th>
                  <th>Agama</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                
              </tbody>
            </table>
          </div>
          <!-- /.box-body -->
          <?php if($this->aauth->is_allowed('user_add')){?>
            <div class="box-footer">
              <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#add"><i class="fa fa-plus"></i> Add</button>
            </div>
          <?php } ?>

          <!-- Modal -->
          <div class="modal fade" id="add" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header bg-primary">
                  <h4 class="modal-title" id="exampleModalLabel">Tambah Mahasiswa</h4>
                </div>
                <div class="modal-body">
                  <form action="<?php echo site_url('mahasiswa/saveDataMHS');?>" method="post">
                    <div class="form-group">
                      <label>Nama</label>
                      <input type="text" class="form-control" name="nama" required>
                    </div>
                    <div class="form-group">
                      <label>Alamat</label>
                      <textarea class="form-control" name="alamat" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                      <label>Agama</label>
                      <select class="form-control" id="getAgama" name="agama" style="width: 565px;" required>
                        <option value="Islam">Islam</option>
                        <option value="Kristen">Kristen</option>
                        <option value="Protestan">Protestan</option>
                        <option value="Hindu">Hindu</option>
                        <option value="Buddha">Buddha</option>
                      </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
      </div>
      <!-- /.box -->
    </div>
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->
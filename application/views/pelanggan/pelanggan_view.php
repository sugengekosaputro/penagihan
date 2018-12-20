<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
    </div>
    <div class="clearfix"></div>
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Data Pelanggan<small>UD.BBB</small></h2>
              <ul class="nav navbar-right panel_toolbox">
                
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <p class="text-muted font-13 m-b-30">
                  <a href="<?php echo site_url()?>pelanggan/tambah" class="btn btn-primary"><span class="fa fa-plus">&nbsp</span>Tambah</a>
              </p>
              
              <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>Nama Pelanggan</th>
                    <th>Alamat</th>
                    <th>Telpon</th>
                    <th>Email</th>
                    <th>Harga Pelanggan</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach($data as $data){ ?>
                  <tr>
                    <td><?php echo $data->nama_pelanggan; ?></td>
                    <td><?php echo $data->alamat; ?></td>
                    <td><?php echo $data->nomor_telepon ?></td>
                    <td><?php echo $data->email; ?></td>
                    <td><?php echo $data->harga_pelanggan; ?></td>
                    <td>
                    <a href="<?php echo site_url('pelanggan/edit/'.$data->id_pelanggan) ?>" class="btn btn-warning"><span class="fa fa-edit">&nbsp</span>Update</a>
                      <a href="<?php echo site_url('pelanggan/hapus/'.$data->id_pelanggan) ?>" class="btn btn-danger"><span class="fa fa-trash">&nbsp</span>Hapus</a></td>
                  </tr>
                <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
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
              <h2>Cv. Fabi Nur Cahyo<small>UD.BBB</small></h2>
              <ul class="nav navbar-right panel_toolbox">
                
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <p class="text-muted font-13 m-b-30">
                  <a href="<?php echo site_url('pelanggan/tambah_harga/').$this->uri->segment(3)?>" class="btn btn-primary"><span class="fa fa-plus">&nbsp</span>Tambah</a>
              </p>
              <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>Nama Barang</th>
                    <th>Harga Barang</th>
                    <th>Laba Pelanggan</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach($data as $data){ ?>
                  <tr>
                    <td><?php echo $data->nama_barang ?></td>
                    <td><?php echo $data->harga_beli ?></td>
                    <td>
                        <form class="form-horizontal form-label-left input_mask" enctype="multipart/form-data" action="<?php echo site_url('pelanggan/update_harga_jual')?>" method="POST"> 
                        Rp.
                        <input type="text" name="id_master_jual" value="<?php echo $data->id_master_jual ?>" hidden>
                        <input type="text" name="id_pelanggan" value="<?php echo $data->id_pelanggan ?>" hidden>
                        <input type="text" name="laba" id="laba" value="<?php echo $data->laba ?>">
                        <input type="submit" value="Edit"/>
                        </form>
                    </td>
                    <td>
                    <a href="<?php echo site_url('pelanggan/hapus_harga_jual/'.$data->id_master_jual.'/'.$data->id_pelanggan) ?>" class="btn btn-danger"><span class="fa fa-trash">&nbsp</span>Hapus</a></td>
                  </tr>
                <?php } ?>
                </tbody>
              </table>
              <p class="text-muted font-13 m-b-30">
                  <a href="<?php echo site_url()?>pelanggan" class="btn btn-primary"><span class="fa fa-arrow-left">&nbsp</span>Kembali</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
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
                  <a href="<?php echo site_url()?>pelanggan/tambah_harga" class="btn btn-primary"><span class="fa fa-plus">&nbsp</span>Tambah</a>
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
                  <tr>
                    <td>Klonal 21</td>
                    <td>Rp.4500</td>
                    <td>
                        <form class="form-horizontal form-label-left input_mask" enctype="multipart/form-data" action="<?php echo site_url('pelanggan/simpan')?>" method="POST"> 
                        Rp.
                        <input type="text" name="nama_barang" id="namabarang" value="200">
                        <input type="submit" value="Edit"/>
                        </form>
                    </td>
                    <td>
                    <a href="<?php echo site_url('pelanggan/hapus/') ?>" class="btn btn-danger"><span class="fa fa-trash">&nbsp</span>Hapus</a></td>
                  </tr>
                  <tr>
                    <td>Plastik</td>
                    <td>Rp.2500</td>
                    <td>Rp.500</td>
                    <td>
                     <a href="<?php echo site_url('pelanggan/hapus/') ?>" class="btn btn-danger"><span class="fa fa-trash">&nbsp</span>Hapus</a></td>
                  </tr>
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
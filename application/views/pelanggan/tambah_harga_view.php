<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
    </div>
    <div class="clearfix"></div>
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Form Tambah Harga Pelanggan <small>Billy Box Bangil</small></h2>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <br />
              <form class="form-horizontal form-label-left input_mask" enctype="multipart/form-data" action="<?php echo site_url('pelanggan/simpan')?>" method="POST">
                <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                  <input type="text" name="nama_barang" class="form-control has-feedback-left" id="namabarang" placeholder="Nama Barang">
                  <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                </div>

                <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                  <input type="number" name="harga_pelanggan" class="form-control has-feedback-left" id="inputSuccess3" placeholder="Harga Pelanggan">
                  <span class="fa fa-money form-control-feedback left" aria-hidden="true"></span>
                </div>

                <div class="form-group">
                </div>
                
                <div class="ln_solid"></div>
                <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <a class="btn btn-primary" href="<?php echo base_url('pelanggan/harga'); ?>" type="button">Kembali</a>
                    <input type="submit" class="btn btn-success" value="Simpan"/>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>      

<div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Form Select Suggest View <small>Billy Box Bangil</small></h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <br />
          <form class="form-horizontal form-label-left input_mask" action="<?php echo site_url('master/simpan')?>" method="POST">
                <!-- hidden input -->
                <input type="text" name="id_pelanggan" id="id_pelanggan" hidden>
                <input type="text" name="id_barang" id="id_barang" hidden>
                <input type="text" name="tanggal_order" value="<?php echo date("Y-m-h");?>" hidden>
                <!-- -->
              <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                <input type="text" name="nama_pelanggan" class="form-control has-feedback-left" id="namapelanggan" placeholder="Nama Pelanggan">
                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
              </div>

              <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                <input type="text" name="nama_barang" class="form-control has-feedback-left" id="namabarang" placeholder="Nama Barang">
                <span class="fa fa-archive form-control-feedback left" aria-hidden="true"></span>
              </div>

              <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                <input type="number" name="jumlah_order" class="form-control has-feedback-left" id="inputSuccess3" placeholder="Jumlah Order">
                <span class="fa fa-sort-numeric-asc form-control-feedback left" aria-hidden="true"></span>
              </div>

              <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                <input type="text" name="dibayarAwal" class="form-control has-feedback-left" id="inputSuccess3" placeholder="Dibayar">
                <span class="fa fa-sort-numeric-asc form-control-feedback left" aria-hidden="true"></span>
              </div>

              <div class="form-group">
              </div>
              
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <a class="btn btn-primary" href="<?php echo base_url('master'); ?>" type="button">Kembali</a>
                  <input type="submit" class="btn btn-success" value="Simpan"/>
                </div>
              </div>

          </form>
        </div>
      </div>
    </div>
  </div>
            
            
            
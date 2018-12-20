<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
    </div>
    <div class="clearfix"></div>
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Form Edit Barang <small>Billy Box Bangil</small></h2>
              <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <br />
              <form class="form-horizontal form-label-left input_mask" enctype="multipart/form-data" action="<?php echo site_url('barang/update')?>" method="POST">
              <?php foreach ($data as $data) ?>
              
              <div class="form-group">
                  <!--Hidden Input-->
                <input type="hidden" name="id_barang" value="<?php echo $data->id_barang ?>">
                <input type="hidden" name="foto_lama" value="<?php echo $data->foto_barang ?>">
                  <!-- -->
                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                  <input type="text" disabled class="form-control has-feedback-left" value="<?php echo $data->id_barang ?>" id="inputSuccess2" placeholder="Id Barang">
                  <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                </div>

                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                  <input type="text" name="nama_barang" class="form-control has-feedback-left" id="inputSuccess5" value="<?php echo $data->nama_barang ?>" placeholder="Nama Barang">
                  <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                </div>
                
                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                  <input type="text" name="ukuran" class="form-control has-feedback-left" value="<?php echo $data->ukuran ?>" placeholder="Ukuran">
                  <span class="fa fa-eye-slash form-control-feedback left" aria-hidden="true"></span>
                </div>

                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                  <input type="text" name="gramatur" class="form-control has-feedback-left" value="<?php echo $data->gramatur ?>" placeholder="Gramatur">
                  <span class="fa fa-eye-slash form-control-feedback left" aria-hidden="true"></span>
                </div>

                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                  <input type="text" name="harga_beli" class="form-control has-feedback-left" value="<?php echo $data->harga_beli ?>" placeholder="Harga Beli">
                  <span class="fa fa-eye-slash form-control-feedback left" aria-hidden="true"></span>
                </div>

                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                  <input type="text" name="harga_jual" class="form-control has-feedback-left" value="<?php echo $data->harga_jual ?>" id="inputSuccess3" placeholder="Harga Jual">
                  <span class="fa fa-eye-slash form-control-feedback left" aria-hidden="true"></span>
                </div>

                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback" style="margin-top:2%">
                  <input type="file" name="foto_barang" class="form-control has-feedback-left" id="foto_barang">
                  <span class="fa fa-image form-control-feedback left" aria-hidden="true"></span>
                </div>

                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                  <img height="100px" src="<?php echo $data->foto_barang ?>" weight="100px" id="viewfoto">
                </div>

                <div class="form-group">

                </div>

                <div class="form-group">
                </div>
                <div class="ln_solid"></div>
                <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <a class="btn btn-primary" href="<?php echo base_url('barang'); ?>" type="button">Kembali</a>
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
<script>
  document.getElementById("foto_barang").onchange = function () {
    var reader = new FileReader();

    reader.onload = function (e) {
        // get loaded data and render thumbnail.
        document.getElementById("viewfoto").src = e.target.result;
    };

    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
  };
</script>
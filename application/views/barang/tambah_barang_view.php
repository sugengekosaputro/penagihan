<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
    </div>
    <div class="clearfix"></div>
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Form Tambah Barang <small>Billy Box Bangil</small></h2>
              <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <br />
              <form class="form-horizontal form-label-left input_mask" enctype="multipart/form-data" action="<?php echo site_url('barang/simpan')?>" method="POST">
                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                  <input type="text" name="id_barang" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Id Barang">
                  <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                </div>

                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                  <input type="text" name="nama_barang" class="form-control has-feedback-left" id="inputSuccess5" placeholder="Nama Barang">
                  <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                </div>

                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                  <input type="text" name="ukuran" class="form-control has-feedback-left" id="inputSuccess3" placeholder="Ukuran">
                  <span class="fa fa-eye-slash form-control-feedback left" aria-hidden="true"></span>
                </div>
              
                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                  <input type="text" name="gramatur" class="form-control has-feedback-left" id="inputSuccess3" placeholder="Gramatur">
                  <span class="fa fa-eye-slash form-control-feedback left" aria-hidden="true"></span>
                </div>

                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                  <input type="text" name="harga_beli" class="form-control has-feedback-left" id="inputSuccess3" placeholder="Harga Beli">
                  <span class="fa fa-eye-slash form-control-feedback left" aria-hidden="true"></span>
                </div>

                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                  <input type="text" name="harga_jual" class="form-control has-feedback-left" id="inputSuccess3" placeholder="Harga Jual">
                  <span class="fa fa-eye-slash form-control-feedback left" aria-hidden="true"></span>
                </div>

                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                  <select name="jenis_barang" class="form-control has-feedback-left">
                      <option>Pilih Jenis Kategori Barang</option>
                      <?php 
                      foreach ($kategori as $kategori) {
                      echo "<option value='$kategori->id_kategori'>$kategori->jenis_barang</option>";
                      }
                      ?>
                    </select>
                  <span class="fa fa-eye-slash form-control-feedback left" aria-hidden="true"></span>
                </div>

                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback" style="margin-top:2%">
                  <input type="file" name="foto_barang" class="form-control has-feedback-left" id="foto_barang" placeholder="Email">
                  <span class="fa fa-image form-control-feedback left" aria-hidden="true"></span>
                </div>

                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                  <img height="100px" src="" weight="100px" id="viewfoto">
                  <span class="fa fa-picture-o fa-5x" id="preview">
                </div>

                <div class="form-group">
                </div>
                
                <div class="ln_solid"></div>
                <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <a class="btn btn-primary" href="<?php echo base_URL('barang'); ?>" type="button">Kembali</a>
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
  document.getElementById("viewfoto").style.display= "none";
  document.getElementById("foto_barang").onchange = function () {
    var reader = new FileReader();

    reader.onload = function (e) {
        // get loaded data and render thumbnail.
        document.getElementById("viewfoto").src = e.target.result;
        document.getElementById("viewfoto").style.display= "block";
        document.getElementById("preview").style.visibility= "hidden";
    };

    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
  };
</script>
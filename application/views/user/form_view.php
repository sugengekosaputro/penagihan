<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Form User <small>Billy Box Bangil</small></h2>
              <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <br />
              <?php echo form_open_multipart('user/simpan');?>
              <!-- <form class="form-horizontal form-label-left input_mask" enctype="multipart/form-data" action="<?php //echo site_url('user/simpan')?>" method="POST"> -->
                <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                    <input type="text" name="username" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Username">
                    <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                  </div>
                  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                    <input type="text" name="nama" class="form-control has-feedback-left" id="inputSuccess5" placeholder="Nama">
                    <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                  </div>
                  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                    <input type="password" name="password" class="form-control has-feedback-left" id="inputSuccess3" placeholder="Password">
                    <span class="fa fa-eye-slash form-control-feedback left" aria-hidden="true"></span>
                  </div>
                  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                    <input type="file" name="foto" class="form-control has-feedback-left" id="foto" placeholder="Email">
                    <span class="fa fa-image form-control-feedback left" aria-hidden="true"></span>
                  </div>
                  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                      <select name="role" class="form-control has-feedback-left">
                        <option>Pilih Role</option>
                        <option value="administrator">Administrator</option>
                        <option value="pegawai">Pegawai</option>
                      </select>
                    <span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
                  </div>
                  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback" style="padding-left:20%">
                    <img height="100px" src="" weight="100px" id="viewfoto">
                    <span class="fa fa-picture-o fa-5x" id="preview">
                  </div>
                </div>
                <div class="ln_solid"></div>
                <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button class="btn btn-primary" type="button">Kembali</button>
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
document.getElementById("foto").onchange = function () {
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
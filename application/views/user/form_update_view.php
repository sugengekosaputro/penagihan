<div class="right_col" role="main">
  <div class="">
        <div class="page-title">
        </div>
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
              <?php echo form_open_multipart('user/update');?>
                <?php foreach($data as $dt) ?>
                <div class="form-group">
                <input type="hidden" name="id_user" value="<?php echo $dt->id_user ?>">
                <input type="hidden" name="foto_path" value="<?php echo $dt->foto ?>">
                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                    <input type="text" name="username" class="form-control has-feedback-left" value="<?php echo $dt->username ?>">
                    <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                </div>

                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                    <input type="text" name="nama" class="form-control has-feedback-left" value="<?php echo $dt->nama ?>">
                    <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                </div>
                
                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                    <input type="password" name="password" class="form-control has-feedback-left" value="<?php echo $dt->password ?>">
                    <span class="fa fa-eye-slash form-control-feedback left" aria-hidden="true"></span>
                </div>

                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                    <input type="file" name="foto" class="form-control has-feedback-left" id="foto" placeholder="Email">
                    <span class="fa fa-image form-control-feedback left" aria-hidden="true"></span>
                </div>

                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                    <select name="role" class="form-control has-feedback-left">
                        <option>Pilih Role</option>
                        <?php
                            $role = $dt->role;
                            $array_opt = array('administrator','pegawai');
                            for($i=0;$i < sizeof($array_opt); $i++){
                                if($array_opt[$i] == $role){
                                    echo "<option selected value='".$array_opt[$i]."'>".$array_opt[$i]."</option>";
                                }else {
                                    echo "<option value='".$array_opt[$i]."'>".$array_opt[$i]."</option>";
                                }
                            }
                        ?>
                    </select>
                    <span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
                </div>

                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback" style="padding-left:20%">
                    <img height="100px" src="<?php echo $dt->foto ?>" weight="100px" id="viewfoto">
                </div>

                </div>
                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <a class="btn btn-primary" href="<?php echo base_URL(); ?>user" type="button">Kembali</a>
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
  document.getElementById("foto").onchange = function () {
    var reader = new FileReader();

    reader.onload = function (e) {
        // get loaded data and render thumbnail.
        document.getElementById("viewfoto").src = e.target.result;
    };

    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
  };
</script>
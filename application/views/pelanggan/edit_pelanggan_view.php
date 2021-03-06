<div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Form Edit Pelanggan <small>Billy Box Bangil</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                  <form class="form-horizontal form-label-left input_mask" enctype="multipart/form-data" action="<?php echo site_url('pelanggan/update')?>" method="POST">
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                      <?php foreach ($data as $data) ?>
                        <!--Hidden Input-->
                        <input type="hidden" name="id_pelanggan" value="<?php echo $data->id_pelanggan ?>">
                         <!-- -->
                        <input type="text" name="nama_pelanggan" value="<?php echo $data->nama_pelanggan ?>" class="form-control has-feedback-left" id="" placeholder="Nama Pelanggan">
                        <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input type="text" name="alamat" value="<?php echo $data->alamat ?>" class="form-control has-feedback-left" id="" placeholder="Alamat">
                        <span class="fa fa-home form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input type="text" name="nomor_telepon" value="<?php echo $data->nomor_telepon ?>" class="form-control has-feedback-left" id="inputSuccess3" placeholder="Nomor Telpon">
                        <span class="fa fa-phone-square form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input type="text" name="email" value="<?php echo $data->email ?>" class="form-control has-feedback-left" id="inputSuccess3" placeholder="Email">
                        <span class="fa fa-mail-forward form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input type="number" name="harga_pelanggan" value="<?php echo $data->harga_pelanggan ?>" class="form-control has-feedback-left" id="inputSuccess3" placeholder="Harga Pelanggan">
                        <span class="fa fa-money form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="form-group">
                      </div>
                      
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <a class="btn btn-primary" href="<?php echo base_url('pelanggan'); ?>" type="button">Kembali</a>
                          <input type="submit" class="btn btn-success" value="Simpan"/>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>
            
            
            
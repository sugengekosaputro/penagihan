<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
    </div>
    <div class="clearfix"></div>
      <div class="row">
        <div class="col-md-7 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Form Surat Jalan <small>Billy Box Bangil</small></h2>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <br />
              <form class="form-horizontal form-label-left input_mask" id="form">
                  <!-- hidden input -->
                  <input type="text" name="id_order" id="id_order" hidden>
                  <input type="text" name="id_pelanggan" id="id_pelanggan" hidden>
                  <!-- <input type="text" name="id_barang[]" id="id_barang1" hidden>  -->
                  <!-- -->
                <div id="dynamicField">
                  <div class="form-group">
                    <div class="col-md-7 col-sm-7 col-xs-12 form-group has-feedback">
                      <input type="text" name="surat_jalan" class="form-control has-feedback-left" id="suratjalan" placeholder="Nomor surat jalan">
                      <span class="fa fa-pencil-square-o form-control-feedback left" aria-hidden="true"></span>
                    </div>                   
                  </div>
                  <!--foreach-->
                  <div class="form-group">
                    <div class="col-md-8 col-sm-8 col-xs-12 form-group has-feedback">
                      <div class="checkbox">
                         <label>
                                <input type="checkbox" value="" class="flat"> MANGGA ONLINE KLONAL 21(MANGGA ONLINE KL
                          </label>
                      </div>  
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">  
                          <input type="number" name="jumlah[]" class="form-control has-feedback-left" id="jumlah" placeholder="jumlah">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-md-8 col-sm-8 col-xs-12 form-group has-feedback">
                      <div class="checkbox">
                         <label>
                                <input type="checkbox" value="0" class="flat"> MANGGA ONLINE KLONAL 21(MANGGA ONLINE KL
                          </label>
                      </div>  
                    </div>  
                    <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">  
                          <input type="number" name="jumlah[]" class="form-control has-feedback-left" id="jumlah" placeholder="jumlah">
                    </div>
                  </div>
                  <!---->
                </div>  

                <div class="ln_solid"></div>
                <div class="form-group">
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <a class="btn btn-primary" href="<?php echo base_url('pemesanan'); ?>" type="button">Kembali</a>
                    <input type="submit" class="btn btn-success" id="simpan" value="Simpan"/>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="col-md-5 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
              <h2>Rincian <small>Billy Box Bangil</small></h2>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <br />
              <form class="form-horizontal form-label-left input_mask" id="form">
                <div class="form-group">
                  <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                    <h2 id="cv"></h2>
                  </div>
                </div>
                <div id="dynamicRincian">
                
                </div>

                <div class="ln_solid"></div>
                <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-6 text-left">
                    <h3>Total</h3>
                  </div>
                  <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                    <h3 id="total"></h3>
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

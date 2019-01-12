<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
    </div>
    <div class="clearfix"></div>
      <div class="row">
        <div class="col-md-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Form Surat Jalan <small>Billy Box Bangil</small></h2>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <form class="form-horizontal form-label-left input_mask" id="form" method="post">
                <div class="form-group">
                  <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                    <input type="text" name="surat_jalan" class="form-control has-feedback-left" id="suratjalan" placeholder="Nomor surat jalan">
                    <span class="fa fa-pencil-square-o form-control-feedback left" aria-hidden="true"></span>
                  </div>                   
                </div>
                <?php foreach($data as $dt){ ?>
                <div class="form-group">
                  <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                    <label><?php echo $dt->nama_barang ?><label>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-md-2 col-sm-2 col-xs-12 form-group">
                    <input class="form-check-input" name="checkbox" id="cek1" type="checkbox" value="checkedValue" aria-label="Text for screen reader">&nbsp Dikirim
                  </div>
                  <input type="text" name="id_detail_order[]" id="id_order1" value="<?php echo $dt->id_detail_order ?>">
                </div>

                <div class="form-group">
                  <div class="col-md-4 col-sm-4 col-xs-12 form-group">
                    <input type="number" name="pesanan[]" class="form-control pesanan1" id="pesanan" value="<?php echo $dt->jumlah ?>" readonly>  
                    <label>Jumlah Pesanan<label>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12 form-group">  
                    <input type="number" name="dikirm[]" class="form-control jum1" id="dikirim" placeholder="Masukkan Jumlah Dikirim">
                    <label>Jumlah Dikirim<label>
                  </div>
                </div>
                
                <div class="ln_solid"></div>
                <?php }?>

                <div class="form-group">
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <a class="btn btn-primary" href="<?php echo base_url('pemesanan'); ?>" type="button">Kembali</a>
                    <input type="button" class="btn btn-success" id="simpan" value="Simpan"/>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
  $(function(){
    $("#simpan").on("click", function () {
      var fav = [];
      $.each($("input[name=checkbox]:checked"), function () { 
         fav.push($(".jum2").val());
      });
//      var data = $("#form").serialize();
      console.log(fav.join(", "));
    });
  });
</script>
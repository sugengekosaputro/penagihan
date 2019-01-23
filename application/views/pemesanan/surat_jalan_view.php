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
                    <input type="text" name="no_sj" class="form-control has-feedback-left" id="no_sj" placeholder="Nomor surat jalan">
                    <span class="fa fa-pencil-square-o form-control-feedback left" aria-hidden="true" required></span>
                  </div>
                </div>
                <?php foreach($order_list as $key => $val){ ?>
                <div class="form-group">
                  <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                    <label><?php  echo $val->nama_barang?><label>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-md-2 col-sm-2 col-xs-12 form-group">
                    <input class="form-check-input" key="<?php echo $key;?>" id="<?php echo 'checkbox'.$key;?>" type="checkbox" aria-label="Text for screen reader">
                      <label class="kirim<?php echo $key;?>" style="color:red">Pending</label>
                  </div>
                  <input type="text" name="id_detail_order[]" id="id_order<?php echo $key;?>" value="<?php echo $val->id_detail_order ?>" hidden disabled>
                </div>

                <div class="form-group">
                  <div class="col-md-4 col-sm-4 col-xs-12 form-group">
                    <input type="number" name="pesanan[]" class="form-control" id="pesanan<?php echo $key;?>" value="<?php echo $val->jumlah ?>" readonly disabled>  
                    <label>Jumlah Pesanan<label>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12 form-group">
                    <input type="number" name="dikirim[]" class="form-control" id="dikirim<?php echo $key;?>" placeholder="Masukkan Jumlah Dikirim" disabled>
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
    $('input[type=checkbox]').on('click',function () {
      const key = $(this).attr('key');
      let checked = $(this).prop('checked');

      if(checked){
        $('#id_order'+key+'').attr('disabled', false);
        $('#pesanan'+key+'').attr('disabled', false);
        $('#dikirim'+key+'').attr('disabled', false);
        $('.kirim'+key+'').html('Dikirim').css('color','green');
      }else{
        $('#id_order'+key+'').attr('disabled', 'disabled');
        $('#pesanan'+key+'').attr('disabled', 'disabled');
        $('#dikirim'+key+'').attr('disabled', 'disabled');
        $('.kirim'+key+'').html('Pending').css('color','red');
      }
    });
    $("#simpan").on("click", function () {
      var data = $("#form").serialize();
      $.ajax({
        type: 'ajax',
        method: 'post',
        url: '<?php echo site_url('penagihan/simpan_sj') ?>',
        data: data,
        async: true,
        dataType: 'json',
        success: function (res){
          if(res.status){
           window.location.href = "<?php echo site_url('pemesanan') ?>"
            alert(res.message);
            console.log(res);
          }
        },
        error: function (err) {
          console.log(err);
        }
      });
    });
  });
</script>
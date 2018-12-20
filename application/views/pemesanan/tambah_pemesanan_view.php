<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
    </div>
    <div class="clearfix"></div>
      <div class="row">
        <div class="col-md-7 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Form Tambah Pesanan <small>Billy Box Bangil</small></h2>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <br />
              <form class="form-horizontal form-label-left input_mask" id="form">
                  <!-- hidden input -->
                  <input type="text" name="id_order" id="id_order" hidden>
                  <input type="text" name="id_pelanggan" id="id_pelanggan" hidden>
                  <input type="text" name="id_barang[]" id="id_barang1" hidden> 
                  <!-- -->
                <div id="dynamicField">
                  <div class="form-group">
                    <div class="col-md-7 col-sm-7 col-xs-12 form-group has-feedback">
                      <input type="text" name="nama_pelanggan" class="form-control has-feedback-left" id="namapelanggan" placeholder="Nama Pelanggan">
                      <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                    </div>
                  </div>
                  <div class="col-md-7 col-sm-7 col-xs-12 form-group has-feedback">
                    <input type="text" name="nama_barang[]" class="form-control has-feedback-left nm_barang1" id="namabarang" placeholder="Nama Barang">
                    <span class="fa fa-archive form-control-feedback left" aria-hidden="true"></span>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                    <input type="number" name="jumlah_order[]" class="form-control has-feedback-left" id="inputSuccess3" placeholder="Jumlah Order">
                    <span class="fa fa-sort-numeric-asc form-control-feedback left" aria-hidden="true"></span>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-md-9 col-sm-9 col-xs-12">
                  <button type="button" class="btn btn-warning" id="tambahLagi"><span class="fa fa-plus">&nbsp</span>Tambah Lagi</button>
                  </div>
                </div>

                <div class="ln_solid"></div>
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

        <div class="col-md-5 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Form Rincian <small>Billy Box Bangil</small></h2>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <br />
              <form class="form-horizontal form-label-left input_mask" id="form">
                  <!-- hidden input -->
                  <!-- -->
                <div id="dynamicField">
                  <div class="form-group">
                    <div class="col-md-7 col-sm-7 col-xs-12 form-group has-feedback">
                    
                  </div>
                  <div class="col-md-7 col-sm-7 col-xs-12 form-group has-feedback">
                    <input type="text" name="nama_barang[]" class="form-control has-feedback-left nm_barang1" id="namabarang" placeholder="Nama Barang">
                    <span class="fa fa-archive form-control-feedback left" aria-hidden="true"></span>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                    <input type="number" name="jumlah_order[]" class="form-control has-feedback-left" id="inputSuccess3" placeholder="Jumlah Order">
                    <span class="fa fa-sort-numeric-asc form-control-feedback left" aria-hidden="true"></span>
                  </div>
                </div>

                <div class="form-group">
                </div>

                <div class="ln_solid"></div>
                <div class="form-group">
                  <h4>Total</h4>
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
    getIdOrder();
    let i = 1;
    var site = "<?php echo site_url();?>";
    $('#namapelanggan').autocomplete({
        serviceUrl: site+'/pemesanan/cari_pelanggan',
        onSelect: function (suggestion) {
            $('#id_pelanggan').val(''+suggestion.id);
        }
    });
    $('.nm_barang1').autocomplete({
      serviceUrl: site+'/pemesanan/cari_barang',
        onSelect: function (suggestion) {
            $('#id_barang1').val(''+suggestion.id);
        }
    });

    $('#tambahLagi').on('click', function () {
      i++;
      $('#dynamicField').append(
        "<div id='row"+i+"'>"+
          "<input type='text' name='id_barang[]' id='id_barang"+i+"' hidden>"+ 
          "<div class='col-md-7 col-sm-7 col-xs-12 form-group has-feedback'>"+
            "<input type='text' idrow='"+i+"' name='nama_barang[]' class='form-control has-feedback-left nm_barang"+i+"' id='namabarang' placeholder='Nama Barang'>"+
            "<span class='fa fa-archive form-control-feedback left' aria-hidden='true'></span>"+
          "</div>"+
          "<div class='col-md-4 col-sm-4 col-xs-12 form-group has-feedback'>"+
            "<input type='number' name='jumlah_order[]' class='form-control has-feedback-left' id='inputSuccess3' placeholder='Jumlah Order'>"+
            "<span class='fa fa-sort-numeric-asc form-control-feedback left' aria-hidden='true'></span>"+
          "</div>"+
          "<div class='col-md-1 col-sm-1 col-xs-12 form-group'>"+
            "<button type='button' id='"+i+"' class='btn btn-danger btn-sm btn-remove'><span class='fa fa-close'></span></button>"+
          "</div>"+
        "</div>"
      );
    });

    $(document).on('click','#namabarang',function () {
      let id = $(this).attr('idrow');
      
      var site = "<?php echo site_url();?>";
      $('.nm_barang'+i+'').autocomplete({
        serviceUrl: site+'/pemesanan/cari_barang',
          onSelect: function (suggestion) {
              $('#id_barang'+i+'').val(''+suggestion.id);
          }
      });
    });

    $(document).on('click','.btn-remove', function () {
      let button_id = $(this).attr('id');
      $('#row'+button_id+'').remove();
    });

    $('#simpan').on('click', function () {
      let data = $('#form').serialize();
      $.ajax({
        type: 'ajax',
        method: 'post',
        url: '<?php echo site_url('pemesanan/simpan') ?>',
        data: data,
        async: true,
        dataType: 'json',
        success: function (res){
          //if(res.status){
//            window.location.href = "<?php //echo site_url('pemesanan') ?>"
            alert(res.message);
            console.log(res);
          //}
        },
        error: function (err) {console.log(err);}
      });
    });

    function getIdOrder() {
      $.ajax({
        type: "ajax",
        method: "get",
        url: "<?php echo site_url('api/pemesanan/getId') ?>",
        async: true,
        dataType: "json",
        success: function (res) {
          $('#id_order').val(res);
          console.log(res);
        },
        error: function(res){
          console.log(res);
        }
      });
    }
  });
</script>
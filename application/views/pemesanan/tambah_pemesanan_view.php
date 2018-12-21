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
                    <input type="text" name="nama_barang[]" class="form-control has-feedback-left nm_barang1" id="namabarang1" placeholder="Nama Barang">
                    <span class="fa fa-archive form-control-feedback left" aria-hidden="true"></span>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                    <input type="number" name="jumlah_order[]" class="form-control has-feedback-left jumlah_barang1" id="jumlahBarang" placeholder="Jumlah Order">
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
              <h2>Rincian Order <small>Billy Box Bangil</small></h2>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <br />
              <form class="form-horizontal form-label-left input_mask" id="form">
                <div class="form-group">
                  <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                    <h4 id="cv"></h4>
                  </div>
                </div>
                <div id="dynamicRincian">
                  <div class="form-group">
                    <div class="col-md-4 col-sm-7 col-xs-4 form-group has-feedback">
                      <h4 id="harga_beli"></h4>
                    </div>
                    <div class="col-md-2 col-sm-7 col-xs-2 form-group has-feedback">
                      <h4 id="laba"></h4>
                    </div>
                    <div class="col-md-6 col-sm-7 col-xs-6 form-group has-feedback text-right">
                      <h4 id="harga"></h4>
                    </div>
                  </div>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
  $(function(){
    getIdOrder();
    let i = 1;
    let total;

    var site = "<?php echo site_url();?>";
    $('#namapelanggan').autocomplete({
        serviceUrl: site+'/pemesanan/cari_pelanggan',
        onSelect: function (suggestion) {
          $('#id_pelanggan').val(''+suggestion.id);
          $('#cv').text(suggestion.value);
        }
    });
    $('.nm_barang1').autocomplete({
      serviceUrl: site+'/pemesanan/cari_barang',
        onSelect: function (suggestion) {
          let idbarang = $('#id_pelanggan').val();
          $('#id_barang1').val(''+suggestion.id);
          $('#harga_beli').text(suggestion.harga_beli);
          $('#laba').text(idbarang);
        }
    });

    $('.jumlah_barang1').on('change', function () {
      let jumlah = $(this).val();
      let hrg_beli = $('#harga_beli').text();
      let harga = jumlah * parseInt(hrg_beli);
      total = harga;
      $('#harga').text(harga);
      $('#total').text(total);
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
            "<input type='number' name='jumlah_order[]' class='form-control has-feedback-left jumlah_barang"+i+"' id='jumlahBarang' placeholder='Jumlah Order'>"+
            "<span class='fa fa-sort-numeric-asc form-control-feedback left' aria-hidden='true'></span>"+
          "</div>"+
          "<div class='col-md-1 col-sm-1 col-xs-12 form-group'>"+
            "<button type='button' id='"+i+"' class='btn btn-danger btn-sm btn-remove'><span class='fa fa-close'></span></button>"+
          "</div>"+
        "</div>"
      );
      $('#dynamicRincian').append(
        '<div id="rowRincian'+i+'">'+
          '<div class="form-group">'+
            '<div class="col-md-4 col-sm-7 col-xs-4 form-group has-feedback">'+
              '<h4 id="harga_beli'+i+'"></h4>'+
            '</div>'+
            '<div class="col-md-2 col-sm-7 col-xs-2 form-group has-feedback">'+
              '<h4 id="laba'+i+'"></h4>'+
            '</div>'+
            '<div class="col-md-6 col-sm-7 col-xs-6 form-group has-feedback text-right">'+
              '<h4 id="harga'+i+'"></h4>'+
            '</div>'+
          '</div>'+
        '</div>'
      );

      let id = $(this).attr('idrow');
      
      var site = "<?php echo site_url();?>";
      $('.nm_barang'+i+'').autocomplete({
        serviceUrl: site+'/pemesanan/cari_barang',
          onSelect: function (suggestion) {
              $('#id_barang'+i+'').val(''+suggestion.id);
              $('#harga_beli'+i+'').text(suggestion.harga_beli);
          }
      });

      $('.jumlah_barang'+i+'').on('change', function () {
        let jumlah = $(this).val();
        let hrg_beli = $('#harga_beli'+i+'').text();
        let harga = jumlah * parseInt(hrg_beli);
        total += harga;
        $('#harga'+i+'').text(harga);
        console.log(jumlah);
        $('#total').text(total);
      });
    });

    $(document).on('click','.btn-remove', function () {
      let button_id = $(this).attr('id');
      $('#row'+button_id+'').remove();
      $('#rowRincian'+button_id+'').remove();
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
          if(res.status){
           window.location.href = "<?php echo site_url('pemesanan') ?>"
            alert(res.message);
            console.log(res);
          }
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
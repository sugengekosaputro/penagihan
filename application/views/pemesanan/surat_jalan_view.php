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
                      <input type="text" name="nama_pelanggan" class="form-control has-feedback-left" id="namapelanggan" placeholder="Nomor surat jalan">
                      <span class="fa fa-pencil-square-o form-control-feedback left" aria-hidden="true"></span>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-md-9 col-sm-9 col-xs-12">
                  <button type="button" class="btn btn-warning" id="tambahPesanan"><span class="fa fa-plus">&nbsp</span>Tambah Pesanan</button>
                  </div>
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
              <h2>Rincian Bayar <small>Billy Box Bangil</small></h2>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
  $(function(){
    getIdOrder();
    countHarga(200,3);
    let i = 0;
    let total;
    let id_plg,id_brg;

    var site = "<?php echo site_url();?>";
    $('#namapelanggan').autocomplete({
        serviceUrl: site+'/pemesanan/cari_pelanggan',
        onSelect: function (suggestion) {
          $('#id_pelanggan').val(''+suggestion.id);
          $('#cv').text(suggestion.value);
          id_plg = suggestion.id;
        }
    });

    $('#tambahPesanan').on('click', function () {
      i++;
      $('#dynamicField').append(
        "<div id='row' class='row"+i+"' index='"+i+"'>"+
          "<input type='text' name='id_barang[]' id='id_barang"+i+"' hidden>"+ 
          "<div class='col-md-7 col-sm-7 col-xs-12 form-group has-feedback'>"+
            "<input type='text' idrow='"+i+"' name='nama_barang[]' class='form-control has-feedback-left nm_barang"+i+"' id='namabarang' placeholder='Nama Barang'>"+
            "<span class='fa fa-archive form-control-feedback left' aria-hidden='true'></span>"+
            "<a href='#' class='alert-link link"+i+"'>ganti</a>"+
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
            '<div class="col-md-6 col-sm-4 col-xs-4 form-group has-feedback">'+
              '<h4 id="harga_beli'+i+'"></h4>'+'<h6 id="satuan'+i+'"></h6>'+
            '</div>'+
            '<div class="col-md-1 col-sm-2 col-xs-2 form-group has-feedback">'+
              '<h4 id="laba'+i+'"></h4>'+'<h6 id="laba_error'+i+'"></h6>'+
            '</div>'+
            '<div class="col-md-5 col-sm-6 col-xs-6 form-group has-feedback text-right">'+
              '<h4 id="harga'+i+'"></h4>'+
            '</div>'+
          '</div>'+
        '</div>'
      );
      $('#tambahPesanan').html('<span class="fa fa-plus">&nbsp</span>Tambah Lagi');
    });

    $(document).on('click','#row', function () {
      const id = $(this).attr('index');
      var site = "<?php echo site_url();?>";
      $('.nm_barang'+id+'').autocomplete({
        serviceUrl: site+'/pemesanan/cari_barang',
          onSelect: function (suggestion) {
            const ktg = getKategori(id,suggestion.id_kategori);
            $('#id_barang'+id+'').val(''+suggestion.id);
            $('#harga_beli'+id+'').text(suggestion.harga_beli);
            id_brg = suggestion.id;
          }
      });

      $('.link'+id+'').on('click', function () {
        $('.nm_barang'+id+'').val('').focus();
        $('.jumlah_barang'+id+'').val('');
      });

      $('.row'+id+'').on('change',function(){
        let jumlah = $('.jumlah_barang'+id+'').val();
        let hrg_beli = $('#harga_beli'+id+'').text();
        let harga = countHarga(jumlah,hrg_beli);
        $('#harga'+id+'').text(harga);
        getLaba(id,id_plg,id_brg);
      });
    });

    $(document).on('click','.btn-remove', function () {
      let button_id = $(this).attr('id');
      $('.row'+button_id+'').remove();
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
//      alert(data);
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

    function getKategori(id,id_kategori) {
      $.ajax({
        type: "ajax",
        method: "get",
        url: "<?php echo site_url() ?>api/kategori/"+id_kategori+"",
        async: true,
        dataType: "json",
        success: function (res) {
          $('#satuan'+id+'').text('/'+res[0].satuan);
        },
        error: function(res){
          console.log(res);
        }
      });
    }

    function getLaba(id,id_plg,id_brg) {
      $.ajax({
        type: "get",
        url: "<?php echo site_url() ?>api/pemesanan/getLaba",
        data: {
          'id_barang' : id_brg,
          'id_pelanggan' : id_plg,
        },
        async: true,
        dataType: "json",
        success: function (res) {
          $('#laba'+id+'').text('Rp.'+res[0].laba);
        },
        error: function (res) {
          $('#laba_error'+id+'').html(
            'Harga Belum Ditentukan<br><a href="<?php echo site_url()?>pelanggan/harga/'+id_plg+'" style="text-decoration:underline">Tentukan Disini</a>');
          console.log(res);
        }
      });
    }

    function countHarga(jumlah,harga_beli){
      const total = jumlah * harga_beli;
      return total;
    }


  });
</script>
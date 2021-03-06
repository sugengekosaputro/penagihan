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
              <form class="form-horizontal form-label-left input_mask" method="post" id="form">
                  <!-- hidden input -->
                  <input type="text" name="id_order" id="id_order" hidden>
                  <input type="text" name="id_pelanggan" id="id_pelanggan" hidden>
                  <!-- <input type="text" name="id_barang[]" id="id_barang1" hidden>  -->
                  <!-- -->
                <div id="dynamicField">
                  <div class="form-group">
                    <div class="col-md-7 col-sm-7 col-xs-12 form-group has-feedback validasi_pelanggan">
                      <input type="text" name="nama_pelanggan" class="form-control has-feedback-left" id="namapelanggan" placeholder="Nama Pelanggan">
                      <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
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
                    <input type="submit" class="btn btn-success disabled" id="simpan" value="Simpan"/>
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
                <div class="ln_solid"></div>
                <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-6 text-left">
                    <h5>DP 50%</h5>
                  </div>
                  <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                    <h5 id="dp"></h5>
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
    let arrTotal = [];
    let i = 0;
    let id_plg,id_brg,harga;

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
      let validate = '';
      let nama_pelanggan = $('#namapelanggan').val();
      if(nama_pelanggan == ''){
        $('#dynamicField').find('.validasi_pelanggan').addClass('has-error');
      }else{
        $('#dynamicField').find('.validasi_pelanggan').removeClass('has-error').addClass('has-success');
        validate += '1';
      }

      if(validate == '1'){
        $('#dynamicField').append(
          "<div id='row' class='row"+i+"' index='"+i+"'>"+
            "<input type='text' name='id_barang[]' id='id_barang"+i+"' hidden>"+ 
            "<div class='col-md-7 col-sm-7 col-xs-12 form-group has-feedback'>"+
              "<input type='text' idrow='"+i+"' name='nama_barang[]' class='form-control has-feedback-left nm_barang"+i+"' id='namabarang' placeholder='Nama Barang'>"+
              "<span class='fa fa-archive form-control-feedback left' aria-hidden='true'></span>"+
              "<a href='#' class='alert-link link_ganti"+i+"'>ganti</a>"+
            "</div>"+
            "<div class='col-md-4 col-sm-4 col-xs-12 form-group has-feedback'>"+
              "<input type='number' name='jumlah_order[]' class='form-control has-feedback-left jumlah_barang"+i+"' id='jumlahBarang' nomor='"+i+"' placeholder='Jumlah Order'>"+
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
        $('#tambahPesanan').addClass('tambahLagi');

        console.log('tambah row ke - '+i);
      }
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

      $('.link_ganti'+id+'').on('click', function () {
        $('.nm_barang'+id+'').val('').focus();
        $('.jumlah_barang'+id+'').val('');
      });

      $('.row'+id+'').on('change',function(){
        getLaba(id,id_plg,id_brg);
        let laba = $('#laba'+id+'').text();
        let jumlah = $('.jumlah_barang'+id+'').val();
        let hrg_beli = $('#harga_beli'+id+'').text();
        const hrg_jual = parseInt(hrg_beli) + parseInt(laba);
        harga = countHarga(jumlah,hrg_jual);

        $('#harga'+id+'').html('Rp. '+formatRupiah(harga));
        console.log(harga);
      });
    });

    $(document).on('change','#jumlahBarang', function () {
      let button_id = $(this).attr('nomor');
      arrTotal.push(harga);
      console.log(arrTotal);
      let tot = arrTotal.reduce((a, b) => a + b, 0);
      let dp = tot * 0.5;
      console.log(tot);
      
      $('#total').html('Rp.'+formatRupiah(tot));
      $('#dp').html('Rp.'+formatRupiah(dp));
    });


    $(document).on('click','.btn-remove', function () {
      let button_id = $(this).attr('id');
      let h = $('#harga'+button_id+'').text();

      arrTotal = arrTotal.filter(e => e !== parseInt(h));
      console.log(arrTotal);

      let tot = arrTotal.reduce((a, b) => a + b, 0);
      console.log(tot);
      $('#total').html('Rp.'+tot);

      $('.row'+button_id+'').remove();
      $('#rowRincian'+button_id+'').remove();

      console.log('hapus row ke - '+i);
    });

    $('#simpan').on('submit', function () {
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
          $('#laba'+id+'').text(+res[0].laba);
          return res[0].laba;
        },
        error: function (res) {
          $('#laba_error'+id+'').html(
            'Harga Belum Ditentukan<br><a href="<?php echo site_url()?>pelanggan/harga/'+id_plg+'" style="text-decoration:underline">Tentukan Disini</a>');
        }
      });
    }

    function countHarga(jumlah,harga_beli){
      const totalHarga = jumlah * harga_beli;
      return totalHarga;
    }

    function formatRupiah(angka){
      var reverse = angka.toString().split('').reverse().join(''),
      ribuan = reverse.match(/\d{1,3}/g);
      ribuan = ribuan.join('.').split('').reverse().join('');
      return ribuan;
    }

  });
</script>
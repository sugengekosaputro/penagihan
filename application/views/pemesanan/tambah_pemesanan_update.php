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
                  <!-- -->
                <div id="dynamicForm">
                  <div class="form-group">
                    <div class="col-md-7 col-sm-7 col-xs-12 form-group has-feedback validasi_pelanggan">
                      <input type="text" name="nama_pelanggan" class="form-control has-feedback-left" id="namaPelanggan" placeholder="Nama Pelanggan">
                      <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                      <h5 class="warningPelanggan" hidden><span class="fa fa-warning text-danger"> Harus Diisi</span></h5>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-md-9 col-sm-9 col-xs-12">
                  <button type="button" class="btn btn-warning" id="tambahPesanan"><span class="fa fa-plus">&nbsp</span>Tambah Pesanan</button>
                  <button type="button" class="btn btn-default" id="reset"><span class="fa fa-trash">&nbsp</span>Reset</button>
                  </div>
                </div>
                <!-- <div class="form-group">
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <div class="form-check form-check-inline">
                      <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="cekdp" id="cekdp"> DP Sudah Dibayar
                      </label>
                    </div>
                  </div>
                </div> -->

                <div class="ln_solid"></div>
                <div class="form-group">
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <a class="btn btn-primary" href="<?php echo base_url('pemesanan'); ?>" type="button">Kembali</a>
                    <input type="click" class="btn btn-success" id="simpan" value="Simpan" disabled/>
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
    $('#namaPelanggan').focus();
    let arrTotal = [];
    var i = 0;
    let id_plg,id_brg,harga;

    var site = "<?php echo site_url();?>";
    $('#namaPelanggan').autocomplete({
        serviceUrl: site+'/pemesanan/cari_pelanggan',
        onSelect: function (suggestion) {
          $('#id_pelanggan').val(''+suggestion.id);
          $('#cv').text(suggestion.value);
          id_plg = suggestion.id;
        }
    });

    $('#tambahPesanan').on('click', function () {
      let validate = '';
      let nama_pelanggan = $('#namaPelanggan').val();

      if(nama_pelanggan == ''){
        $('#dynamicForm').find('.validasi_pelanggan').addClass('has-error');
        $('#dynamicForm').find('.warningPelanggan').removeAttr('hidden');
        $('#namaPelanggan').focus();
      }else{
        $('#dynamicForm').find('.validasi_pelanggan').removeClass('has-error');
        $('#dynamicForm').find('.warningPelanggan').attr('hidden',true);
        $('#namaPelanggan').attr('readonly', true);
        validate += '1';
      }

      if(validate == '1'){
        i++;
        $('#dynamicForm').append(
          "<div id='rowForm' class='rowForm"+i+"' index='"+i+"'>"+
            "<input type='text' name='id_barang[]' id='id_barang"+i+"' hidden>"+
            "<input type='text' name='harga_barang[]' id='harga_barang"+i+"' hidden>"+ 
            "<div class='col-md-8 col-sm-8 col-xs-12 form-group has-feedback'>"+
              "<input type='text' name='nama_barang[]' class='form-control nm_barang"+i+"' id='namaBarang'>"+
              "<label id='label"+i+"'>Nama Barang</label>"+
            "</div>"+
            "<div class='col-md-3 col-sm-3 col-xs-12 form-group has-feedback'>"+
              "<input type='number' name='jumlah_order[]' class='form-control jml_barang"+i+" jumlah' id='jumlahBarang' nomor='"+i+"' disabled>"+
              "<label>Jumlah Order</label>"+
            "</div>"+
            "<div class='col-md-1 col-sm-1 col-xs-12 form-group'>"+
              "<button type='button' id='"+i+"' class='btn btn-danger btn-sm btn-remove'><span class='fa fa-close'></span></button>"+
            "</div>"+
          "</div>"
        );
        
        $('#dynamicRincian').append(
          '<div id="rowRincian" class="rowRincian'+i+'" index="'+i+'">'+
            '<div class="form-group">'+
              '<div class="col-md-6 col-sm-4 col-xs-4 form-group has-feedback">'+
                '<h4 id="harga_beli'+i+'"></h4>'+'<h6 id="satuan'+i+'"></h6>'+
              '</div>'+
              '<div class="col-md-1 col-sm-2 col-xs-2 form-group has-feedback">'+
                '<h4 id="laba'+i+'"></h4>'+'<h6 id="laba_error'+i+'"></h6>'+
              '</div>'+
              '<div class="col-md-5 col-sm-6 col-xs-6 form-group has-feedback text-right">'+
                '<h4 id="harga'+i+'" class="hrg"></h4>'+
              '</div>'+
            '</div>'+
          '</div>'
        );
        $('#tambahPesanan').html('<span class="fa fa-plus">&nbsp</span>Tambah Lagi');
        $('#tambahPesanan').addClass('tambahLagi').attr('disabled',true);
      }
      $('#simpan').attr('disabled',true);
    });

    $(this).on('click','#rowForm', function () {
      let index = $(this).attr('index');
      let nama_barang = $('.nm_barang'+index+'').val();
      let jumlah_barang = $('.jml_barang'+index+'').val();

      $('.nm_barang'+index+'').autocomplete({
        serviceUrl: site+'/pemesanan/cari_barang',
          onSelect: function (suggestion) {
            const ktg = getKategori(index,suggestion.id_kategori);
            $('#id_barang'+index+'').val(''+suggestion.id);
            $('#harga_beli'+index+'').text(suggestion.harga_beli);
            id_brg = suggestion.id;
            getLaba(index,id_plg,id_brg);
            $('.rowForm'+index+'').find('.jml_barang'+index+'').removeAttr('disabled').focus();
            $('.rowForm'+index+'').find('.nm_barang'+index+'').attr('readonly','readonly');
          }
      });

      $('.jml_barang'+index+'').on('keyup', function () {
        let jumlah_barang = $('.jml_barang'+index+'').val();
        let hrg_beli = $('#harga_beli'+index+'').text();
        let laba = $('#laba'+index+'').text();

        if(jumlah_barang != ''){
          $('.tambahLagi').removeAttr('disabled');
          $('#simpan').removeAttr('disabled');
          const hrg_jual = parseInt(hrg_beli) + parseInt(laba);
          harga = countHarga(jumlah_barang,hrg_jual);
          $('#harga'+index+'').html(harga);
          $('#harga_barang'+index+'').val(hrg_jual);
          let hrg = $('#harga'+index+'').text();
          // let total = countTotal(index);
          // console.log(total);
        }else{
          $('.tambahLagi').attr('disabled',true);
          $('#simpan').attr('disabled',true);
          $('#harga'+index+'').text('0');
        }
      });

      // $(this).on('input','.form-group .jumlah',function(){
      //   let jumlah_barang = $('.jml_barang'+index+'').val();
      //   let hrg_beli = $('#harga_beli'+index+'').text();
      //   let laba = $('#laba'+index+'').text();

      //   if(jumlah_barang != ''){
      //     $('.tambahLagi').removeAttr('disabled');
      //     const hrg_jual = parseInt(hrg_beli) + parseInt(laba);
      //     harga = countHarga(jumlah_barang,hrg_jual);
      //     $('#harga'+index+'').html(harga);
      //     let hrg = $('#harga'+index+'').text();
      //     let total = countTotal();
      //     console.log(total);
      //   }else{
      //     $('.tambahLagi').attr('disabled',true);
      //     $('#harga'+index+'').text('0');
      //   }
      // });
    });

    $(this).on('click','.btn-remove', function () {
      let button_id = $(this).attr('id');
      let h = $('#harga'+button_id+'').text();
    
      $('.rowForm'+button_id+'').remove();
      $('.rowRincian'+button_id+'').remove();
      $('.tambahLagi').removeAttr('disabled');
    // countTotal();
    });

    $('#simpan').on('click', function () {
      let data = $('#form').serialize();
      console.log(data);
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
          $('#laba_error'+id+'').html('???');
            $('#label'+id+'').html(
            'Harga Belum Ditentukan<br><a href="<?php echo site_url()?>pelanggan/harga/'+id_plg+'" style="text-decoration:underline;color:blue;">Tentukan Disini</a>').css('color','red');
            $('.rowForm'+id+'').find('.jml_barang'+id+'').attr('disabled',true);
        }
      });
    }

    function countHarga(jumlah,harga_beli){
      const totalHarga = jumlah * harga_beli;
      return totalHarga;
    }

    // function countTotal(harga) {
    //   let totalSum = 0;
    //   $('.form-group .jumlah').each(function () {          
    //     if($.isNumeric(harga)){
    //       totalSum += parseFloat(harga);
    //     }
    //   });
    //   return totalSum;
    // }

    function countTotal(index) {
      var totalSum = 0;
      var harga = $('#harga'+index+'').text();
      var input = $('.jml_barang'+index+'').val();
      $('.jumlah').each(function () {
//        var input = $(this).val();

        var inputVal = harga * input;
//        if($.isNumeric(harga)){
          //totalSum += parseInt(inputVal);
          totalSum += parseFloat(harga);
// console.log('tambah kolom ke - '+col);
//      }
      });
      return totalSum+' gandengan '+harga;
    }

    function formatRupiah(angka){
      var reverse = angka.toString().split('').reverse().join(''),
      ribuan = reverse.match(/\d{1,3}/g);
      ribuan = ribuan.join('.').split('').reverse().join('');
      return ribuan;
    }

  });
</script>
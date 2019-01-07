<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
    </div>
    <div class="clearfix"></div>
      <div class="row">
        <div class="col-md-6 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Form Design <small>different form elements</small></h2>
              <div class="clearfix"></div>
            </div>
            <br />
            <div class="x_content">
              <form class="form-horizontal form-label-left input_mask" id="form">
                <div id="dynamicField">
                  <div class="col-md-5 col-sm-5 col-xs-12 form-group">
                    <input type="number" class="form-control barang1" id="idBarang" name="barang[]" placeholder="Barang">
                  </div>
                  <div class="col-md-3 col-sm-5 col-xs-12 form-group">
                    <input type="number" get="1" class="form-control angka1" id="idJumlah" name="jumlah[]" placeholder="Jumlah">
                  </div>
                </div>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <button type="button" class="btn btn-success" id="tambahLagi"><span class="fa fa-plus">&nbsp</span>Tambah Lagi</button>
                  <button type="button" class="btn btn-primary" id="simpan">Simpan</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Form Design <small>different form elements</small></h2>
              <div class="clearfix"></div>
            </div>
            <br />
            <div class="x_content">
              
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
    let i = 1;
    $('#tambahLagi').on('click', function () {
      i++;
      $('#dynamicField').append(
        "<div id='row"+i+"'>"+
          "<div class='col-md-5 col-sm-5 col-xs-12 form-group'>"+
            "<input type='number' class='form-control barang"+i+"' id='idBarang' name='barang[]' placeholder='Barang'>"+
          "</div>"+
          "<div class='col-md-3 col-sm-5 col-xs-12 form-group'>"+
            "<input type='number' get='"+i+"'class='form-control angka angka"+i+"' id='idJumlah' name='jumlah[]' placeholder='Jumlah'>"+
          "</div>"+
          "<div class='col-md-4 col-sm-2 col-xs-12 form-group'>"+
            "<button type='button' id='"+i+"' class='btn btn-danger btn-sm btn-remove'><span class='fa fa-close'></span></button>"+
          "</div>"+
        "</div>"
      );
    });

    $(document).on('click','.btn-remove', function () {
      let button_id = $(this).attr('id');
      $('#row'+button_id+'').remove();
      var totalSum = 0;
      $('.form-group .angka').each(function () {
        var inputVal = $(this).val();
        if($.isNumeric(inputVal)){
          totalSum += parseInt(inputVal);
        }
      });
      console.log(totalSum);
      //alert('ok');
    });

    $(document).on('input','.form-group .angka',function(){
      var totalSum = 0;
      let get = $(this).attr('get');
      let brg = $('.barang'+get+'').val();
      $('.form-group .angka').each(function () {
        var inputVal = $('.angka'+get+'').val();
        if($.isNumeric(inputVal)){
          totalSum += (parseInt(inputVal) * parseInt(brg));
        }
      });
      console.log('jumlah = '+totalSum+', barang = '+brg);
    });

    $('#simpan').on('click', function () {
      let data = $('#form').serialize();
      // $.ajax({
      //   type: 'ajax',
      //   method: 'post',
      //   url: '<?php //echo base_url('master/save') ?>',
      //   data: data,
      //   async: false,
      //   dataType: 'json',
      //   success: function (res){
      //     if(res.status){

      //       console.log(res.message);
      //     }
      //   },
      //   error: function () {
      //     console.log('errro');
      //   }
      // });
      alert(data);
    });
  });
</script>
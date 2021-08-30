@extends('layout.master')
@section('content')
<br>
<section class="content">
  <div class="row  container-fluid content1">
    <div class="card col-12">
      <div class="card-header row">
        <div class="col">
          <h4>
            <i class="fas fa-list-ol"> Thiết bị Công ty</i><br>
          </h4>
          <h5><i>(Bao gồm cả thiết bị đang cho thuê, tồn kho, đang sửa)</i></h5>
        </div>
        <div class="col text-right">
          <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#exampleModalLong">
            <i class="fas fa-plus"> Nhập Mua Mới Thiết bị</i>
          </button>
        </div>
        
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div>
          <table class="table table-bordered table-hover" id="table_thietbicongty">
            <thead class="thead-light">
              <tr class="text-center">
                <th><i class="fas fa-calendar-check"> Ngày nhập</i></th>
                <th><i class="fas fa-toolbox"> Chủng Loại</i></th>
                <th><i class="fas fa-server"> Hãng/Model</i></th>
                <th><i class="fas fa-server"> Cấu hình</i></th>
                <th><i class="fas fa-user-tag"> Chủ sử hữu </i></th>
                <th><i class="fas fa-signal"> Số lượng</i></th>
                </tr>
              </tr>
            </thead>
            <tbody>
              @foreach ($data_thietbicongty as $data1)
              <?php if ($data1->chusohuu == 1){ ?>
              <tr class="text-center">
                <td>{{\Carbon\Carbon::parse($data1->created_at)->format('d/m/Y')}}</td>
                <td>{{$data1->tenloaimay}}</td>
                <td>{{$data1->tenhang}}</td>
                <td>{{$data1->tencauhinh}}</td>
                <td>{{$data1->tenchusohuu}}</td>
                <td>{{$data1->soluong}}</td>
              </tr>
              <?php } ?>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
<!-- END CARD BODY -->
    </div>
<!-- END CARD1 -->
  </div>
<!-- END CONTENT1 -->
</section>

<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Nhập Mới Thiết Bị</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header row">
                <div class="col-8 offset-4 text-right row">
                  <div class="form-control col mr-1 text-center" id="1">
                    
                    <input class=""  type="checkbox" onchange="chonchungloai(this)" id="chonchungloai" name="chonchungloai" > <label for="">Chọn Chủng Loại</label>
                  </div>
                  <div class="form-control col mr-1 text-center" id="2">
                    <input type="checkbox" onchange="chonhang(this)" id="chonhang" name="chonhang" > <label for="">Chọn Hãng/Model</label>
                  </div>
                  <div class="form-control col  text-center" id="3">
                    <input type="checkbox" onchange="choncauhinh(this)" id="choncauhinh" name="choncauhinh" > <label for="">Chọn Cấu Hình</label>
                  </div>
                  <div class="form-control col  text-center" id="4">
                    <input type="checkbox" onchange="chonchusohuu(this)" id="chonchusohuu" name="chonchusohuu" checked> <label for="">Chọn Sở Hữu</label>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <form action="{{URL::to('/nhapmoithietbi')}}" method="POST">@csrf
              <input type="text" name="dichchuyen" value="1" hidden>        

              <div class="card-body row">
                <table class="table table-bordered">
                  <thead class="thead-light">
                    <tr>
                      <th class="col-2">Chủng Loại</th>
                      <th class="col-2">Hãng/Model</th>
                      <th class="col-4">Cấu hình</th>
                      <th class="col-2">Chủ sử hữu</th>
                      <th class="col-2">Số lượng</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <input type="text" name="id_loaimay" id="id_loaimay" placeholder="Loại Mới" value="" class="form-control">
                        <select name="sl_loaimay" id="sl_loaimay" onchange="chonhang_select()" hidden class="form-control"><?php echo $option_loaimay;  ?></select>
                      </td>
                      <td>
                        <input type="text" name="ip_hang" id="ip_hang" placeholder="Hãng Mới" value="" class="form-control">
                        <select name="sl_hang" id="sl_hang" onchange="choncauhinh_select()" hidden class="form-control"></select>
                      </td>
                      <td>
                        <input type="text" name="ip_cauhinh" id="ip_cauhinh" placeholder="Cấu hình Mới" value="" class="form-control">
                        <select name="sl_cauhinh" id="sl_cauhinh"  hidden class="form-control"></select>
                      </td>
                      <td>
                        <input type="text" name="ip_chusohuu" id="ip_chusohuu" placeholder="Chủ sở Hữu Mới" value="" class="form-control" hidden>
                        <select name="sl_chusohuu" id="sl_chusohuu"  class="form-control">
                          <?php echo $option_chusohuu ?>
                        </select>
                      </td>
                      <td><input type="number" name="soluong" id="soluong" class="form-control" min="0"></td>
                    </tr>
                    
                    <tr>
                      <td colspan="5" class="text-right">
                        <button type="submit" class="btn btn-primary">Thêm</button>
                        <input type="number" id="chungloaimoi" name="chungloaimoi" value="1" hidden>
                        <input type="number" id="hangmoi" name="hangmoi" value="1" hidden>
                        <input type="number" id="cauhinhmoi" name="cauhinhmoi" value="1" hidden>
                        <input type="number" id="chusohuumoi" name="chusohuumoi" value="0" hidden>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </form>
            </div>

          </div>

        </div>
  </div>
</section>
</div>
</div>
</div>
</div>





@endsection

@section('js')
<script src="{{URL::to('/')}}/admin/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{URL::to('/')}}/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{URL::to('/')}}/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{URL::to('/')}}/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{URL::to('/')}}/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{URL::to('/')}}/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{URL::to('/')}}/admin/plugins/jszip/jszip.min.js"></script>
<script src="{{URL::to('/')}}/admin/plugins/pdfmake/pdfmake.min.js"></script>
<script src="{{URL::to('/')}}/admin/plugins/pdfmake/vfs_fonts.js"></script>
<script src="{{URL::to('/')}}/admin/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{URL::to('/')}}/admin/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{URL::to('/')}}/admin/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script>
  $("#tag_khohang").addClass('menu-open');
  $("#khohang").addClass('active');
  $("#thietbicongty").addClass('active');
  $(document).ready(function(){
    $("#table_thietbicongty").DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
    });
  });

$('#sl_cauhinh').html('<option hidden>Chọn Loại</option>');
$('#sl_hang').html('<option hidden>Chọn Loại</option>');
$("#4").css({'background-color':'blue','color':'white'});
function chonchungloai(chonchungloai){
  if( chonchungloai.checked ) {
     $("#sl_loaimay").prop('hidden',false);
     $("#id_loaimay").prop('hidden',true);
     $("#chungloaimoi").prop('value','0');
     $("#1").css({'background-color':'blue','color':'white'});

  }else{
    $("#sl_loaimay").prop('hidden',true);
    $("#id_loaimay").prop('hidden',false);
    $("#chungloaimoi").prop('value','1');
    $("#chonhang").prop('checked',false);
    $("#choncauhinh").prop('checked',false);
    $("#sl_cauhinh").prop('hidden',true);
    $("#ip_cauhinh").prop('hidden',false);
    $("#cauhinhmoi").prop('value','1');
    $("#sl_hang").prop('hidden',true);
    $("#ip_hang").prop('hidden',false);
    $("#hangmoi").prop('value','1');
     $("#1").css({'background-color':'white','color':'black'});
     $("#2").css({'background-color':'white','color':'black'});
     $("#3").css({'background-color':'white','color':'black'});



  }
};
function chonhang(chonhang){
  if( chonhang.checked ) {
     $("#sl_hang").prop('hidden',false);
     $("#ip_hang").prop('hidden',true);
     $("#hangmoi").prop('value','0');
     $("#2").css({'background-color':'blue','color':'white'});

     var id_chungloaiselect = document.getElementById('sl_loaimay').value;
      $.ajax({
        url: "{{URL::to('/layhang')}}", //url xử lí data
        type: "POST", //kiểu đưa dữ liệu lên
        data: {
            idtruyenvao: id_chungloaiselect, //khai báo dữ liệu đưa vào
            _token: '{{csrf_token()}}' //token để sử dụng với hàm post
        },
        dataType: 'json', //Kiểu dữ liệu trả về
        success: function (result) { //Nếu dữ liệu trả về ok thì sẽ chạy tiếp ở đây
            $('#sl_hang').html('<option hidden>Chọn Loại</option>');
            $.each(result.layhang, function (key, value) {
                $('#sl_hang').append('<option value="' + value.id + '">' + value.tenhang + '</option>');
            });
        }
       });

  }else{
      $("#sl_hang").prop('hidden',true);
      $("#ip_hang").prop('hidden',false);
      $("#hangmoi").prop('value','1');
      $("#choncauhinh").prop('checked',false);
      $("#sl_cauhinh").prop('hidden',true);
      $("#ip_cauhinh").prop('hidden',false);
      $("#cauhinhmoi").prop('value','1');
     $("#2").css({'background-color':'white','color':'black'});
     $("#3").css({'background-color':'white','color':'black'});


  }
};
function choncauhinh(choncauhinh){
  if( choncauhinh.checked ) {
     $("#sl_cauhinh").prop('hidden',false);
     $("#ip_cauhinh").prop('hidden',true);
     $("#cauhinhmoi").prop('value','0');
     $("#3").css({'background-color':'blue','color':'white'});


  }else{
    $("#sl_cauhinh").prop('hidden',true);
    $("#ip_cauhinh").prop('hidden',false);
    $("#cauhinhmoi").prop('value','1');
     $("#3").css({'background-color':'white','color':'black'});

  }
};
function choncauhinh(choncauhinh){
  if( choncauhinh.checked ) {
     $("#sl_cauhinh").prop('hidden',false);
     $("#ip_cauhinh").prop('hidden',true);
     $("#cauhinhmoi").prop('value','0');
     $("#3").css({'background-color':'blue','color':'white'});


  }else{
    $("#sl_cauhinh").prop('hidden',true);
    $("#ip_cauhinh").prop('hidden',false);
    $("#cauhinhmoi").prop('value','1');
     $("#3").css({'background-color':'white','color':'black'});

  }
};
function chonchusohuu(chonchusohuu){
  if( chonchusohuu.checked ) {
    $("#sl_chusohuu").prop('hidden',false);
    $("#chusohuumoi").prop('value',0);
    $("#ip_chusohuu").prop('hidden',true);chusohuumoi
     $("#4").css({'background-color':'blue','color':'white'});


  }else{
    $("#sl_chusohuu").prop('hidden',true);
    $("#ip_chusohuu").prop('hidden',false);
    $("#chusohuumoi").prop('value',1);

     $("#4").css({'background-color':'white','color':'black'});

  }
};
function chonhang_select(){
  var id_chungloaiselect = document.getElementById('sl_loaimay').value;
  $("#sl_hang").html('');
  $.ajax({
    url: "{{URL::to('/layhang')}}", //url xử lí data
    type: "POST", //kiểu đưa dữ liệu lên
    data: {
        idtruyenvao: id_chungloaiselect, //khai báo dữ liệu đưa vào
        _token: '{{csrf_token()}}' //token để sử dụng với hàm post
    },
    dataType: 'json', //Kiểu dữ liệu trả về
    success: function (result) { //Nếu dữ liệu trả về ok thì sẽ chạy tiếp ở đây
        $('#sl_hang').html('<option hidden>Chọn Loại</option>');
        $.each(result.layhang, function (key, value) {
            $('#sl_hang').append('<option value="' + value.id + '">' + value.tenhang + '</option>');
        });
    }
   });
};


function  choncauhinh_select(){
  var id_hang = document.getElementById('sl_hang').value; //Lấy dữ liệu country
  $("#sl_cauhinh").html('<option hidden>Chọn Loại</option>'); //Khai báo tỉnh với giá trị mặc định là null
  $.ajax({
    url: "{{URL::to('/laycauhinh')}}", //url xử lí data
    type: "POST", //kiểu đưa dữ liệu lên
    data: {
        idtruyenvao: id_hang, //khai báo dữ liệu đưa vào
        _token: '{{csrf_token()}}' //token để sử dụng với hàm post
    },
    dataType: 'json', //Kiểu dữ liệu trả về
    success: function (result) { //Nếu dữ liệu trả về ok thì sẽ chạy tiếp ở đây
        $('#sl_cauhinh').html('<option hidden>Chọn Loại</option>');
        $.each(result.cauhinh, function (key, value) {
            $("#sl_cauhinh").append('<option value="' + value.id + '">' + value.tencauhinh + '</option>');
        });
    }
   });
};  



  
</script>
@endsection
@extends('layout.master')
@section('content')
<br>
<section class="content">
  <div class="row  container-fluid content1">
    <div class="card col-12">
      <div class="row card-header">
        <div class="col">
          <h4><i class="fas fa-list-ol"> Thiết bị Đối Tác </i></h4>
          <h5><i>(Bao gồm thiết bị hiện đang thuê lại của đối tác)</i></h5>
        </div>
        <div class="col text-right">
          <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#exampleModalLong">
            <i class="fas fa-plus"> Nhập Mới thiết bị</i>
          </button>
          <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#exampleModalLong2">
            <i class="fas fa-paper-plane"> Xuất trả thiết bị</i>
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
            </thead>
            <tbody>
              @foreach ($data_thietbidoitac as $data1)
              <?php if ($data1->chusohuu > 1){ ?>
              <tr class="text-center">
                <td>{{\Carbon\Carbon::parse($data1->created_at)->format('d/m/Y')}}</td>
                <td>{{$data1->tenchusohuu}}</td>
                <td>{{$data1->tenloaimay}}</td>
                <td>{{$data1->tenhang}}</td>
                <td>{{$data1->tencauhinh}}</td>
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

<ssection class="content">
  <div class="row  container-fluid content1">
    <div class="card col-12">
      <div class="row card-header">
        <div class="col"><h4><i class="fas fa-history"> Lịch sử trả thiết bị đối tác </i></h4></div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div>
          <table class="table table-bordered table-hover" id="table_lichsu">
            <thead class="thead-light">
              <tr class="text-center">
                <th><i class="fas fa-calendar-check"> Ngày trả</i></th>
                <th><i class="fas fa-user-tag"> Chủ sử hữu </i></th>
                <th><i class="fas fa-toolbox"> Chủng Loại</i></th>
                <th><i class="fas fa-server"> Hãng/Model</i></th>
                <th><i class="fas fa-server"> Cấu hình</i></th>
                <th><i class="fas fa-calendar-check"> Thuê Ngày</i></th>
                <th><i class="fas fa-signal"> Số lượng</i></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($data_lichsutrathietbidoitac as $data2)
              <?php if ($data2->chusohuu > 1){ ?>
              <tr class="text-center">
                <td>{{\Carbon\Carbon::parse($data2->created_at)->format('d/m/Y')}}</td>
                <td>{{$data2->tenchusohuu}}</td>
                <td>{{$data2->tenloaimay}}</td>
                <td>{{$data2->tenhang}}</td>
                <td>{{$data2->tencauhinh}}</td>
                <td>{{\Carbon\Carbon::parse($data2->ngaythue)->format('d/m/Y')}}</td>
                <td>{{$data2->soluong}}</td>
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



<!-- section 2 -->
<section> 
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

  <input class=""  type="checkbox" onchange="chonchungloai(this)" id="chonchungloai"> <label for="">Chọn Chủng Loại</label>
  </div>
  <div class="form-control col mr-1 text-center" id="2">
  <input type="checkbox" onchange="chonhang(this)" id="chonhang"> <label for="">Chọn Hãng/Model</label>
  </div>
  <div class="form-control col  text-center" id="3">
  <input type="checkbox" onchange="choncauhinh(this)" id="choncauhinh" > <label for="">Chọn Cấu Hình</label>
  </div>
  <div class="form-control col  text-center" id="4">
  <input type="checkbox" onchange="chonchusohuu(this)" id="chonchusohuu" checked> <label for="">Chọn Sở Hữu</label>
  </div>
  </div>
  </div>
  <!-- /.card-header -->
  <form action="{{URL::to('/nhapmoithietbi')}}" method="POST">@csrf
  <input type="text" name="dichchuyen" value="2" hidden>        
  <input type="date" value="{{\Carbon\Carbon::parse(today())->format('Y-m-d')}}" name="ngaynhap" hidden>        

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
  <button type="submit" class="btn btn-primary">Xác nhận</button>
  <input type="number" id="chungloaimoi" name="chungloaimoi" value="1" hidden>
  <input type="number" id="hangmoi" name="hangmoi" value="1" hidden>
  <input type="number" id="cauhinhmoi" name="cauhinhmoi" value="1" hidden>
  <input type="number" id="chusohuumoi" name="chusohuumoi" value="0" hidden>
  </td>
  </tr>
  </tbody>
  </table>
  </div>
  </div>
  </div>
  </div>
  </div>
    </form>
  </section>
  </div>
  </div>
  </div>
  </div>
</section>
<!-- end section 2 -->

<!-- Button trigger modal -->

<!-- Modal -->
<form action="{{URL::to('/xuattrathietbi')}}" method="POST">@csrf
<div class="modal fade" id="exampleModalLong2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" >
  <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Xuất trả thiết bị</h5>
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
          <div class="card-body row">
            <table class="table table-bordered">
              <thead class="thead-light">
                <tr>
                  <th class="col-2">Chủng Loại</th>
                  <th class="col-2">Hãng/Model</th>
                  <th class="col-4">Cấu hình</th>
                  <th class="col-2">Chủ sử hữu</th>
                  <th class="col-2">Số lượng Trả</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <select name="sl_loaimay" id="sl_loaimay2" onchange="chonhang_select2()" class="form-control">
                    <?php echo $option_loaimay;  ?></select>
                  </td>
                  <td>
                    <select name="sl_hang" id="sl_hang2" onchange="choncauhinh_select2()" class="form-control"></select>
                  </td>
                  <td>
                    <select name="sl_cauhinh" id="sl_cauhinh2"  class="form-control"></select>
                  </td>
                  <td>
                    <select name="sl_chusohuu" id="sl_chusohuu2"  class="form-control">
                      <?php echo $option_chusohuu ?>
                  </select>
                  </td>
                  <td>
                    <input type="number" name="soluong" id="soluong" class="form-control" min="0"></td>
                </tr>
                <tr>
                    <td colspan="3"></td>  
                    <td>Chọn ngày nhập</td>  
                    <td><input class="form-control" name="ngaynhap" type="date" id="ngaynhapthietbi"></td>  
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        </div>
        </div>
        </div>
        </section>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal">Đóng</button>
        <button type="submit" class="btn btn-info">Xác nhận</button>
      </div>
    </div>
  </div>
</div>
</form>




@endsection

@section('js')
<script>
  $("#tag_thietbidoitac").addClass('menu-open');
  $("#doitac").addClass('active');
  $("#thietbidoitac").addClass('active');
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
    $("#table_lichsu").DataTable({
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
function chonhang_select2(){
  var id_chungloaiselect = document.getElementById('sl_loaimay2').value;
  $("#sl_hang2").html('');
  $.ajax({
    url: "{{URL::to('/layhang')}}", //url xử lí data
    type: "POST", //kiểu đưa dữ liệu lên
    data: {
        idtruyenvao: id_chungloaiselect, //khai báo dữ liệu đưa vào
        _token: '{{csrf_token()}}' //token để sử dụng với hàm post
    },
    dataType: 'json', //Kiểu dữ liệu trả về
    success: function (result) { //Nếu dữ liệu trả về ok thì sẽ chạy tiếp ở đây
        $('#sl_hang2').html('<option hidden>Chọn Loại</option>');
        $.each(result.layhang, function (key, value) {
            $('#sl_hang2').append('<option value="' + value.id + '">' + value.tenhang + '</option>');
        });
    }
   });
};


function  choncauhinh_select2(){
  var id_hang = document.getElementById('sl_hang2').value; //Lấy dữ liệu country
  $("#sl_cauhinh2").html('<option hidden>Chọn Loại</option>'); //Khai báo tỉnh với giá trị mặc định là null
  $.ajax({
    url: "{{URL::to('/laycauhinh')}}", //url xử lí data
    type: "POST", //kiểu đưa dữ liệu lên
    data: {
        idtruyenvao: id_hang, //khai báo dữ liệu đưa vào
        _token: '{{csrf_token()}}' //token để sử dụng với hàm post
    },
    dataType: 'json', //Kiểu dữ liệu trả về
    success: function (result) { //Nếu dữ liệu trả về ok thì sẽ chạy tiếp ở đây
        $('#sl_cauhinh2').html('<option hidden>Chọn Loại</option>');
        $.each(result.cauhinh, function (key, value) {
            $("#sl_cauhinh2").append('<option value="' + value.id + '">' + value.tencauhinh + '</option>');
        });
    }
   });
};  


</script>
@endsection
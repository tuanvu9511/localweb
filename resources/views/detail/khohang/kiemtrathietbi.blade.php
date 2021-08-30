@extends('layout.master')
@section('content')
<?php 
$option_loaimay='<option value="" hidden>Chọn</option>';
foreach ($datachungloai as $data2){
  $option_loaimay .= '<option value="'.$data2->id.'">'.$data2->tenloaimay.'</option>';
};
$option_chusohuu = "";
        foreach ($chusohuu as $key) {
        $option_chusohuu .= '<option value="'.$key->id.'">'.$key->tenchusohuu.'</option>';};
 ?>
<br>
<form action="{{URL::to('/kiemtrathietbi/thietbi')}}" method="POST">@csrf
<section class="content">
  <div class="container-fluid">
  <div class="row">
  <div class="col-10 offset-1">
  <div class="card">
  <div class="card-header row">
  <div class="col"><h5 class=""> Kiểm tra thiết bị </h5></div>
  <div class="col text-right " id="btn11"><button type="submit" class="btn btn-info" onclick="laydulieudonhang()">Tìm Kiếm</button></div>
  <div class="col text-right  " hidden id="btn12"><button class="btn btn-info" onclick="window.location.reload()" >Làm Mới</button></div>
  <p id="test"></p>

  </div>
  <!-- /.card-header -->
  <div class="card-body row">
  <div class="col-12 row">
  <div class="col-12">
  <table class="table table-bordered">
  <thead class="thead-light">
  <tr>
    <th class="col-2"><i class="fas fa-toolbox"> Chủng Loại</th>
    <th class="col-2"><i class="fas fa-server"> Hãng/Model</i></th>
    <th class="col-4"><i class="fas fa-server"> Cấu hình</i></th>
    <th class="col-2"><i class="fas fa-user-tag"> Chủ sử hữu </i></th>
  </tr>
  </thead>
  <tbody>
  <tr onchange="lay{{URL::to('/')}}/()">
  <td>
  <select name="sl_loaimay" id="sl_loaimay" onchange="chonhang_select()"  class="form-control" required><?php echo $option_loaimay;  ?></select>
  </td>
  <td>
  <select name="sl_hang" id="sl_hang" onchange="choncauhinh_select()"  class="form-control" required></select>
  </td>
  <td>
  <select name="sl_cauhinh" id="sl_cauhinh"  class="form-control" required></select>
  </td>
  <td>
  <select name="sl_chusohuu" id="sl_chusohuu" class="form-control" required><?php echo $option_chusohuu ?></select>
  </td>
  </tr>
  </tbody>
  </table>
  </div>
  </div>
  </div>
  </div>
  </div>
  </div>
  </div>
</section>
</form>

@endsection

@section('js')
<script>
$("#tag_khohang").addClass('menu-open');
$("#khohang").addClass('active');
$("#kiemtrathietbi").addClass('active');

function chonhang_select(){
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
        $('#sl_hang').html('<option value="0" hidden>Chọn Loại</option>');
        $.each(result.layhang, function (key, value) {
            $('#sl_hang').append('<option value="' + value.id + '">' + value.tenhang + '</option>');
        });
    }
   });
};


function  choncauhinh_select(){
  var id_hang = document.getElementById('sl_hang').value; //Lấy dữ liệu country
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
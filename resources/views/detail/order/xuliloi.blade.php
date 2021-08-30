@extends('layout.master')
@section('content')
<?php 
$loaimay='<option value="" hidden>Chọn</option>';
foreach ($datachungloai as $data2){
  $loaimay .= '<option value="'.$data2->id.'">'.$data2->tenloaimay.'</option>';
};
$option_chusohuu='';
foreach ($chusohuu as $data3){
  $option_chusohuu .= '<option value="'.$data3->id.'">'.$data3->tenchusohuu.'</option>';
};
 ?>
<br>

@if ($errors->any())
    <div class="alert alert-info">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{URL::to('/capnhatxuliloi')}}" method="POST">@csrf
  <input type="number" value="{{$id}}" name="id" hidden>
  <input type="number" value="<?php echo $id_yeucau ?>" name="id_yeucau" hidden>

<section class="content">
 <div class="container-fluid">
  <div class="row">
   <div class="col-12">
    <div class="card">
     <div class="card-header row">
      <div class="col"><h4 class=""> Lỗi đơn hàng số <b><?php echo $id_yeucau ?></b> </h4></div>
  <div class="col text-right"><button class="btn btn-info" type="submit">Cập nhật</button></div>
      
     </div>
<!-- /.card-header -->
     <div class="card-body">
      <div class="row">  
  <div class="col-10 offset-1">
    <div class="card">
      <div class="card-body">
          <table class="table table-bordered">
            <thead class="thead-light">
              <tr class="text-center">
                <th class="col-2"><i class="fas fa-calendar"></i> Ngày Báo</th>
                <th class="col-3"><i class="fas fa-bars"></i> Nội dung lỗi</th>
                <th class="col-4"><i class="fas fa-id-badge"></i> Phương án xử lí</th>
                <th class="col-2">Trạng Thái</th>
              </tr>
            </thead>
            <tbody>
              @foreach($dt_thongbaoloi as $dataloi)
              <tr>
                <td class="text-center">{{\Carbon\Carbon::parse($dataloi->created_at)->format('d/m/Y')}}</td>
                <td>{{$dataloi->noidungloi}}</td>
                <td>{{$dataloi->cachxuliloi}}</td>
                <td><?php if($dataloi->tinhtrangloi == 1){ echo 'Chưa xử lí'; }
                          elseif($dataloi->tinhtrangloi == 2){ echo 'Đã xử lí xong lúc'; }
                 ?></td>
              </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                
              </tr>
            </tfoot>
          </table>
      </div>
    </div>
    <div class="text-center row" onchange="">
      <div class="col-3">Phương án khắc phục</div>
      <input type="text" class="form-control col-6 " name="phuonganxuli" id="phuonganxuli" list="thongtinloi" placeholder="Lựa chọn" required>
      <div class="col-3">
        <input type="checkbox" onchange="kiemtradoimay(this)" name="doimay">
        <input type="number" value="0"  id="doimay" name="doimay" hidden>
        <label >Thay đổi thiết bị</label>
      </div>
      
    </div>
  </div>


<datalist id="thongtinloi">
  <option value="Lỗi từ phía người dùng, khắc phục từ xa">
  <option value="Lỗi máy, đổi máy">
  <option value="Không có lỗi, đã xử lí">
</datalist>


     </div>
    </div>
   </div>
  </div>
 </div>
</section>

<section>
<div class="col-12" id="1" hidden>
  <div class="card">
  <div class="card-header row"> 
      <div class="card-title row col-12">
        <div class="col-6"><h5><i class="fa fa-book"> Số lượng thiết bị hiện tại</i></h5></div>
        <div class="col-6 row">
          <div class="col"><input class="float-left" id="check_ntb" onchange="ntb(this)" type="checkbox"> <label for="check_ntb">Nhận lại thiết bị</label></div>
          <div class="col"><input class="float-left" id="check_xtb" onchange="xtb(this)" type="checkbox"><label for="check_xtb">Bổ sung thiết bị</label></div>
        </div>
      </div>
  </div>
<div class="card-body">
  <div class="row">
    <div class="col-12">
    <table class="table table-hover table-bordered" id="table_thietbibangiao">
    <thead class="thead-light">
      <tr>
        <th width="2%" >
        <th width="10%">Chủng loại</th>
        <th width="10%">Hãng</th>
        <th width="20%">Cấu hình</th>
        <th width="10%">Chủ sở hữu</th>
        <th width="10%">Số lượng</th>
      </tr>
    </thead>
    <tbody>
      <?php $i=1 ?>
     @foreach ($data_donhang as $data)
      <tr>
        <td>{{$i}}</td>
        <td>{{$data->tenloaimay}}</td>
        <td>{{$data->tenhang}}</td>
        <td>({{$data->tencauhinh}})</td>
        <td>{{$data->tenchusohuu}}</td>
        <td>{{$data->soluong}}</td>
      </tr>
     <?php $i = $i +1 ?>
      @endforeach
    </tbody>
    </table>
    </div>
  </div>
</div>

</div><!--end card so luong thiet bi hien tai-->

<div class="container-fluid" id="2" >
  <div class="row nhanthietbi" id="nhanthietbi" hidden>
    <div class="card col-12">
      <div class="card-header">
        <h5>Nhận lại Thiết Bị Hỏng <i>(Nhận lại số thiết bị cần đổi)</i></h5>
        <input type="number" name="thietbihong" id="thietbihong" value="0" hidden>
      </div>
      <div class="card-body">
        <table class="table table-bordered" id="table_nhanthietbi">
        <thead class="thead-light">
          <tr>
            <th width="2%" >
            <a onclick="themdong3()"><i class="fas fa-plus"></i></a><br>
            <a onclick="xoadong3()"><i class="fa fa-minus"></i></a>
            <input type="number" id="sltb_nhan" name="sltb_nhan" value="1" hidden>
            </th>
            <th width="10%">Chủng loại</th>
            <th width="10%">Hãng</th>
            <th width="20%">Cấu hình</th>
            <th width="10%">Chủ sở hữu</th>
            <th width="10%">Số lượng</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><div>1</div></td>
            <td><select onchange="chonhang_nhap(1)" id="chungloai_nhap1" name="chungloai_nhap1"><?php echo $loaimay ?></select></td>
            <td><select onchange="choncauhinh_nhap(1)" id="hang_nhap1" name="hang_nhap1"></select></td>
            <td><select name="cauhinh_nhap1" id="cauhinh_nhap1"></select></td>
            <td><select name="chusohuu_nhap1"><?php echo $option_chusohuu?></select></td>
            <td><input type="number" name="soluong_nhap1" ></td>
          </tr>
        </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="row xuatthietbi" id="xuatthietbi" hidden>
    <div class="card col-12">
      <div class="card-header">
        <h5>Xuất thêm thiết bị mới</h5>
        <input type="text" name="thietbimoi" id="thietbimoi" value="0" hidden>
      </div>
      <div class="card-body">
        <table class="table table-bordered" id="table_xuatthietbi">
        <thead class="thead-light">
          <tr>
            <th width="2%" >
            <a onclick="themdong4()"><i class="fas fa-plus"></i></a><br>
            <a onclick="xoadong4()"><i class="fa fa-minus"></i></a>
            <input type="number" id="sltb_xuat" name="sltb_xuat" value="1" hidden>
            </th>
            <th width="10%">Chủng loại</th>
            <th width="10%">Hãng</th>
            <th width="20%">Cấu hình</th>
            <th width="10%">Chủ sở hữu</th>
            <th width="10%">Số lượng</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><div>1</div></td>
            <td><select onchange="chonhang_xuat(1)" id="chungloai_xuat1" name="chungloai_xuat1"><?php echo $loaimay ?></select></td>
            <td><select onchange="choncauhinh_xuat(1)" id="hang_xuat1" name="hang_xuat1"></select></td>
            <td><select name="cauhinh_xuat1" id="cauhinh_xuat1"></select></td>
            <td><select name="chusohuu_xuat1"><?php echo $option_chusohuu?></select></td>
            <td><input type="number" name="soluong_xuat1" ></td>
          </tr>
        </tbody>
        </table>
      </div>

    </div>

    </div>
    </div>
    
  </div>  
</div><!--end container fluid-->
</div><!--end-col-12-->
</section>
<div class="card">
  
</div>
</form>
@endsection

@section('js')
<script>
  $('table input').addClass('form-control');
  $('table select').addClass('form-control');
  function  kiemtradoimay(kiemtra){
  if(kiemtra.checked){
    $("#1").prop('hidden',false);
    $("#doimay").prop('value',1);

  }else{
    $("#1").prop('hidden',true);
    $("#doimay").prop('value',0);

  }
  }
   function  ntb(kiemtra){
  if(kiemtra.checked){
    $("#nhanthietbi").prop('hidden',false);
    $("#thietbihong").prop('value',1);

  }else{
    $("#thietbihong").prop('value',0);
     $("#nhanthietbi").prop('hidden',true);
  }
  }
   function  xtb(kiemtra){
  if(kiemtra.checked){
    $("#thietbimoi").prop('value',1);
    $("#xuatthietbi").prop('hidden',false);
  }else{
    $("#thietbimoi").prop('value',0);
    $("#xuatthietbi").prop('hidden',true);
  }
  }
function themdong3(){
  $mm = parseInt(document.getElementById('sltb_nhan').value)+1;
  $("#table_nhanthietbi").append('<tr>'+
            '<td><div>'+$mm+'</div></td>'+
            '<td><select onchange="chonhang_nhap('+$mm+')" id="chungloai_nhap'+$mm+'" name="chungloai_nhap'+$mm+'"><?php echo $loaimay ?></select></td>'+
            '<td><select onchange="choncauhinh_nhap('+$mm+')" id="hang_nhap'+$mm+'" name="hang_nhap'+$mm+'"></select></td>'+
            '<td><select name="cauhinh_nhap'+$mm+'" id="cauhinh_nhap'+$mm+'"></select></td>'+
            '<td><select name="chusohuu_nhap'+$mm+'"><?php echo $option_chusohuu?></select></td>'+
            '<td><input type="number" name="soluong_nhap'+$mm+'" ></td>'+
          '</tr>');
  document.getElementById('sltb_nhan').value = $mm;
  $('table input').addClass('form-control');
  $('table select').addClass('form-control');
};
function xoadong3(){
  if(parseInt(document.getElementById('sltb_nhan').value) > 1 ){
    document.getElementById('table_nhanthietbi').deleteRow(-1);
    document.getElementById('sltb_nhan').value = document.getElementById('sltb_nhan').value - 1 ;
  };
};
function themdong4(){
  $mm = parseInt(document.getElementById('sltb_xuat').value)+1;
  $("#table_xuatthietbi").append('<tr>'+
            '<td><div>'+$mm+'</div></td>'+
            '<td><select onchange="chonhang_xuat('+$mm+')" id="chungloai_xuat'+$mm+'" name="chungloai_xuat'+$mm+'"><?php echo $loaimay ?></select></td>'+
            '<td><select onchange="choncauhinh_xuat('+$mm+')" id="hang_xuat'+$mm+'" name="hang_xuat'+$mm+'"></select></td>'+
            '<td><select name="cauhinh_xuat'+$mm+'" id="cauhinh_xuat'+$mm+'"></select></td>'+
            '<td><select name="chusohuu_xuat'+$mm+'"><?php echo $option_chusohuu?></select></td>'+
            '<td><input type="number" name="soluong_xuat'+$mm+'" ></td>'+
          '</tr>');
  document.getElementById('sltb_xuat').value = $mm;
  $('table input').addClass('form-control');
  $('table select').addClass('form-control');
};
function xoadong4(){
  if(parseInt(document.getElementById('sltb_xuat').value) > 1 ){
    document.getElementById('table_xuatthietbi').deleteRow(-1);
    document.getElementById('sltb_xuat').value = document.getElementById('sltb_xuat').value - 1 ;
  };
};



</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
function chonhang_nhap(i) {
  var id_chungloai = document.getElementById('chungloai_nhap'+i).value; //Lấy dữ liệu country
  $("#hang_nhap"+i).html(''); //Khai báo tỉnh với giá trị mặc định là null
  $.ajax({
    url: "{{URL::to('/layhang')}}", //url xử lí data
    type: "POST", //kiểu đưa dữ liệu lên
    data: {
        idtruyenvao: id_chungloai, //khai báo dữ liệu đưa vào
        _token: '{{csrf_token()}}' //token để sử dụng với hàm post
    },
    dataType: 'json', //Kiểu dữ liệu trả về
    success: function (result) { //Nếu dữ liệu trả về ok thì sẽ chạy tiếp ở đây
        $('#hang_nhap'+i).html('<option value="123">Chọn cấu hình</option>');
        $.each(result.layhang, function (key, value) {
            $("#hang_nhap"+i).append('<option value="' + value.id + '">' + value.tenhang + '</option>');
        });
    }
   });
};
</script>
<script type="text/javascript">
function  choncauhinh_nhap(i){
  var id_hang = document.getElementById('hang_nhap'+i).value; //Lấy dữ liệu country
  $("#cauhinh_nhap"+i).html(''); //Khai báo tỉnh với giá trị mặc định là null
  $.ajax({
    url: "{{URL::to('/laycauhinh')}}", //url xử lí data
    type: "POST", //kiểu đưa dữ liệu lên
    data: {
        idtruyenvao: id_hang, //khai báo dữ liệu đưa vào
        _token: '{{csrf_token()}}' //token để sử dụng với hàm post
    },
    dataType: 'json', //Kiểu dữ liệu trả về
    success: function (result) { //Nếu dữ liệu trả về ok thì sẽ chạy tiếp ở đây
        $('#cauhinh_nhap'+i).html('<option value="123">Chọn cấu hình</option>');
        $.each(result.cauhinh, function (key, value) {
            $("#cauhinh_nhap"+i).append('<option value="' + value.id + '">' + value.tencauhinh + '</option>');
        });
    }
   });
};
function chonhang_xuat(i) {
  var id_chungloai = document.getElementById('chungloai_xuat'+i).value; //Lấy dữ liệu country
  $("#hang_xuat"+i).html(''); //Khai báo tỉnh với giá trị mặc định là null
  $.ajax({
    url: "{{URL::to('/layhang')}}", //url xử lí data
    type: "POST", //kiểu đưa dữ liệu lên
    data: {
        idtruyenvao: id_chungloai, //khai báo dữ liệu đưa vào
        _token: '{{csrf_token()}}' //token để sử dụng với hàm post
    },
    dataType: 'json', //Kiểu dữ liệu trả về
    success: function (result) { //Nếu dữ liệu trả về ok thì sẽ chạy tiếp ở đây
        $('#hang_xuat'+i).html('<option value="123">Chọn cấu hình</option>');
        $.each(result.layhang, function (key, value) {
            $("#hang_xuat"+i).append('<option value="' + value.id + '">' + value.tenhang + '</option>');
        });
    }
   });
};
</script>
<script type="text/javascript">
function  choncauhinh_xuat(i){
  var id_hang = document.getElementById('hang_xuat'+i).value; //Lấy dữ liệu country
  $("#cauhinh_xuat"+i).html(''); //Khai báo tỉnh với giá trị mặc định là null
  $.ajax({
    url: "{{URL::to('/laycauhinh')}}", //url xử lí data
    type: "POST", //kiểu đưa dữ liệu lên
    data: {
        idtruyenvao: id_hang, //khai báo dữ liệu đưa vào
        _token: '{{csrf_token()}}' //token để sử dụng với hàm post
    },
    dataType: 'json', //Kiểu dữ liệu trả về
    success: function (result) { //Nếu dữ liệu trả về ok thì sẽ chạy tiếp ở đây
        $('#cauhinh_xuat'+i).html('<option value="123">Chọn cấu hình</option>');
        $.each(result.cauhinh, function (key, value) {
            $("#cauhinh_xuat"+i).append('<option value="' + value.id + '">' + value.tencauhinh + '</option>');
        });
    }
   });
};

</script>

@endsection
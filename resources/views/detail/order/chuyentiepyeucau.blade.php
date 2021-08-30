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
$option_donvithoigian = "";
$thoigian = array('Ngày', 'Tuần', 'Tháng','Năm');
for ($i=0; $i < 4 ; $i++) { 
  $option_donvithoigian .= '<option value="'.$thoigian[$i].'"">'.$thoigian[$i].'</option>';
};
?>



<form method="POST" action="{{URL::to('/taodonhang')}}">@csrf
@foreach ($data_yeucau as $data)
<section class="content">




<br>
  <div class="container-fluid">
    <!-- Content here -->
 <div class="row  px-3"> 	
   <div class="col-12">
     <div class="card">
       <div class="card-header row">
		    <div class="col"><h3 class="card-title">
          <h5><i class="fas fa-edit">Thông tin yêu cầu</i></h5></h3>
        </div>
		    <div class="col" id="tag_nutchucnang">
          <div style="text-align:right;" > 
              <a class="btn btn-outline-info" href="{{URL::to('/xoayeucau1/'.$data->id_yeucau)}}">
                <i class="fas fa-times"> Xóa Yêu Cầu</i> 
              </a>
              <a class="btn btn-outline-info" href="{{URL::to('/xuliyeucau/'.$data->id_yeucau)}}">
                <i class="fas fa-pencil-alt"> Sửa thông tin</i> 
              </a>
            <button class="btn btn-outline-info" type="submit" id="btn_sua">
              <i class="fas fa-cart-plus"> Tạo Đơn Hàng</i> 
            </button>
          </div>
		    </div>
			 </div>
              <!-- /.card-header -->
<input type="text" name="id_yeucau" value="{{$data->id_yeucau}}" hidden>
<input type="text" name="ghichepdonhang" value="{{$data->ghichepdonhang}}" hidden>
<div class="card-body">
	<div class="row">
    <div class="col-4">
      <p>Mã Đơn: <b>{{$data->id_yeucau}}</b> | Mã Số Thuế: <b>{{$data->masothue}}</b></p>
      <p>Tên Doanh Nghiệp: <b>{{$data->tencongty}}</b></p>
      <p>Đại diện: <b>{{$data->daidien}}</b></p> 
      <p>Điện thoại: <b>{{$data->dienthoai}}</b></p>
      <p>Địa chỉ: <b>{{$data->diachi}}</b></p>
      <p style="color:blue"><b>  Loại hình thuê: <?php   switch ($data->loaithue) {
                            case '1':
                              echo 'Biên bản xác nhận/ Có đặt cọc';
                            break;
                            case '2':
                              echo 'Kí hợp đồng, có đặt cọc';
                            break;
                            case '3':
                            echo 'Biên bản xác nhận/ Không đặt cọc';
                            break;
                            case '4':
                              echo 'Kí hợp đồng, không đặt cọc, thanh toán sau';
                            break;
                            case '5':
                              echo 'Kí hợp đồng, không đặt cọc, thanh toán trước';
                            break;
                          } ?>
                            </b> </p>
      <p style="color:red"><b>Đặt cọc: {{$data->tiencoc}}đ</b></p>
    </div>
    <div class="col-8">
      <div class="col-12 row">
      Ghi Chú:
      <textarea class="w-100" readonly>{{$data->ghichu}}</textarea>
      </div>
      <table class="table table-bordered">
      <thead class="thead-light">
        <tr><p><h5>Yêu cầu thiết bị</h5><p></tr>
        <tr>
          <th>#</th>
          <th>Thiết bị</th>
          <th>Số Lượng</th>
          <th>Thời gian</th>
          <th>Đơn giá</th>
        </tr>
      </thead>
      <tbody>
        <?php $thongtinthietbi = array(json_decode($data->thongtinthietbi, true));
        $gioihan = $thongtinthietbi[0]['gioihan']+1;
        for ($i=1; $i < $gioihan; $i++) { ?>
        <tr>
        <td>{{$i}}</td>
        <td>{{$thongtinthietbi[0][$i]['loaithietbi'.$i]}}</td>
        <td>{{$thongtinthietbi[0][$i]['soluong'.$i]}}</td>
        <td>{{$thongtinthietbi[0][$i]['sothoigian'.$i].' '.$thongtinthietbi[0][$i]['donvithoigian'.$i]}}</td>
        <td>{{$thongtinthietbi[0][$i]['dongia'.$i]}}</td>
        </tr><?php } ?>
      </tbody>
      </table>
    </div>
 </div>
</div> 
<!-- end card 1 -->
</div>
</div>


<div class="col-12">
  <div class="card">
    <div class="container-fluid">
    <div class="row">
      <div class="card-header col-12">
        <h5><i class="fas fa-anchor"> Đặt lịch nhắc</i></h5>
      </div>
    <div class="card-body col-12 row text-center" onchange="tinhngayketthuc()">
      <div class="col">
        <b>Thời gian giao máy: </b><input type="date" name="ngay_giaomay" id="ngay_giaomay" value="{{\Carbon\Carbon::parse($data->thoigiangiaomay)->format('Y-m-d')}}" class="">
      </div>
      <div class="col">
        <b>Thời gian thuê: </b><input type="number" id="so_thoigian" class="w-25 h-100" min="0" placeholder="chọn" required>
        <select id="donvi_thoigian" class="w-25 h-100">
        <?php echo $option_donvithoigian ?>
        </select></div>
      <div class="col">
        <b>Ngày hết hạn: </b><input type="date" class="" id="ngay_ketthuc" name="ngay_ketthuc" required>
      </div>
    </div>
  </div>
  </div>
  </div>
</div>

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModalLong1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Thiết bị tồn kho</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="col-12 tag_bangnoidung">
                  <table class="table table-bordered table-hover" id="table_danhsachtongthietbi">
                    <thead class="thead-light">
                      <tr class="text-center">
                        <th class="col-2"><i class="fas fa-toolbox"> Chủng Loại</i></th>
                        <th class="col-2"><i class="fas fa-server"> Hãng/Model</i></th>
                        <th class="col-4"><i class="fas fa-server"> Cấu hình</i></th>
                        <th class="col-2"><i class="fas fa-user-tag"> Chủ sử hữu </i></th>
                        <th class="col-2"><i class="fas fa-signal"> Số lượng</i></th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($data_danhsachtongthietbi as $data)
                      <tr class="text-center">
                        <td>{{$data->tenloaimay}}</td>
                        <td>{{$data->tenhang}}</td>
                        <td>{{$data->tencauhinh}}</td>
                        <td>{{$data->tenchusohuu}}</td>
                        <td>{{$data->soluong}} Chiếc</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal">Đóng</button>
      </div>
    </div>
  </div>
</div>
<!-- start card 2 -->
<div class="col-12" onchange="tinhngayketthuc()">
<div class="card">
  <div class="card-header col-12 row"> 
        <div class="col"><h5><i class="fa fa-book"> Thiết bị bàn giao thực tế</i></h5></div>
        <div class="col text-right"><button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModalLong1">
            Kiểm tra thiết bị trong kho
          </button></div>
  </div>
  <div class="card-body">
<!--2.  Bảng thông tin thiết bị -->
  <div class="row">
    <div class="col-12">
    <table class="table table-hover table-bordered" id="table_thietbibangiao" onchange="tinhtien()">
    <thead class="thead-light">
    <tr>
    <th width="2%" >
    <a onclick="themdong2()" class="btn-outline-primary" id="btn_them"><i class="fas fa-plus"></i></a><br>
    <a onclick="xoadong2()" class="btn-outline-primary" id="btn_xoa" ><i class="fa fa-minus"></i></a>
    <input type="number" id="soluongchungloai" onchange="abc()" name="soluongchungloai" value="1" hidden>
    </th>
    <th width="10%" >Chủng loại</th>
    <th width="10%" >Hãng</th>
    <th width="20%" >Cấu hình</th>
    <th width="10%" >Chủ sở hữu</th>
    <th width="10%" >Số lượng</th>
    </tr>
    </thead>
    <tbody>
    <tr>
    <td><div>1</div></td>
    <td><select onchange="chonhang(1)" name="chung_loai1" id="chung_loai1" required><?php echo $loaimay ?></select></td>
    <td><select id="ten_hang1" onchange="choncauhinh(1)" name="ten_hang1" required></select></td>
    <td><select id="cau_hinh1"  name="cau_hinh1" required></select></td>
    <td><select id="chu_sohuu1"  name="chu_sohuu1" required><?php echo $option_chusohuu; ?></select></td>
    <td><input type="number"  id="soluong_giao1" name="soluong_giao1" required></td>
    </tr>
    </tbody>
    </table>
    </div>
  </div>


 </div> 
</div><!-- End Card 2 -->
</div>

</section>
</form>
@endforeach
@endsection

@section('js')
<script src="https://momentjs.com/downloads/moment-with-locales.js"></script>
<script>
	$("#tag_donhang").addClass('menu-open');
	$("#donhang").addClass('active');
	$("#chuyentiepyeucau").addClass('active');
  $("#chuyentiepyeucau").prop('hidden',false);
  $("#table_thietbibangiao tbody td select").css({'width':'100%','height':'25px'});
  $("#table_thietbibangiao tbody td input").css({'width':'100%','height':'25px'});
	$("#table_thietbibangiao thead tr th").css('text-align','center');
  
function tinhngayketthuc(){
    var d = document.getElementById('ngay_giaomay').valueAsDate;
    var t1 = document.getElementById('so_thoigian').value;
    var t2 = document.getElementById('donvi_thoigian').value;
switch(t2) {
  case 'Ngày':
    document.getElementById('ngay_ketthuc').value = moment(d).add(t1, 'days').format('YYYY-MM-DD'); 
    break;
  case 'Tuần':
    document.getElementById('ngay_ketthuc').value = moment(d).add(t1, 'weeks').format('YYYY-MM-DD');  
    break;
    case 'Tháng':
    document.getElementById('ngay_ketthuc').value = moment(d).add(t1, 'months').format('YYYY-MM-DD');  
    break;
    case 'Năm':
    document.getElementById('ngay_ketthuc').value = moment(d).add(t1, 'years').format('YYYY-MM-DD'); 
    break;
}

}

function themdong2(){

	$mm = parseInt(document.getElementById('soluongchungloai').value)+1;
	$("#table_thietbibangiao").append('<tr><td><div>'+$mm+'</div></td>'+
				'<td><select onchange="chonhang('+$mm+')" name="chung_loai'+$mm+'" id="chung_loai'+$mm+'" required><?php echo $loaimay; ?></select></td>'+
        '<td><select id="ten_hang'+$mm+'" onchange="choncauhinh('+$mm+')" name="ten_hang'+$mm+'" required></select></td>'+
  			'<td><select id="cau_hinh'+$mm+'"  name="cau_hinh'+$mm+'" required></select></td>'+
        '<td><select id="chu_sohuu'+$mm+'"  name="chu_sohuu'+$mm+'" required><?php echo $option_chusohuu; ?></select></td>'+

  			'<td><input type="number" id="soluong_giao'+$mm+'" name="soluong_giao'+$mm+'" required></td>);</tr>');
	document.getElementById('soluongchungloai').value = $mm;
  $("#table_thietbibangiao tbody td select").css('width','100%');
  $("#table_thietbibangiao tbody td input").css('width','100%');
  $("#table_thietbibangiao tbody td select").css('height','25px');
  $("#table_thietbibangiao tbody td input").css('height','25px');

};
function xoadong2(){
	if(parseInt(document.getElementById('soluongchungloai').value) > 1 ){
		document.getElementById('table_thietbibangiao').deleteRow(-1);
		document.getElementById('soluongchungloai').value = document.getElementById('soluongchungloai').value - 1 ;
	};
};
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
function chonhang(i) {
	var id_chungloai = document.getElementById('chung_loai'+i).value; //Lấy dữ liệu country
	$("#ten_hang"+i).html(''); //Khai báo tỉnh với giá trị mặc định là null
	$.ajax({
    url: "{{URL::to('/layhang')}}", //url xử lí data
    type: "POST", //kiểu đưa dữ liệu lên
    data: {
        idtruyenvao: id_chungloai, //khai báo dữ liệu đưa vào
        _token: '{{csrf_token()}}' //token để sử dụng với hàm post
    },
    dataType: 'json', //Kiểu dữ liệu trả về
    success: function (result) { //Nếu dữ liệu trả về ok thì sẽ chạy tiếp ở đây
        $('#ten_hang'+i).html('<option value="123">Chọn cấu hình</option>');
        $.each(result.layhang, function (key, value) {
            $("#ten_hang"+i).append('<option value="' + value.id + '">' + value.tenhang + '</option>');
        });
    }
   });
};
</script>
<script type="text/javascript">
function  choncauhinh(i){
  var id_hang = document.getElementById('ten_hang'+i).value; //Lấy dữ liệu country
  $("#cau_hinh"+i).html(''); //Khai báo tỉnh với giá trị mặc định là null
  $.ajax({
    url: "{{URL::to('/laycauhinh')}}", //url xử lí data
    type: "POST", //kiểu đưa dữ liệu lên
    data: {
        idtruyenvao: id_hang, //khai báo dữ liệu đưa vào
        _token: '{{csrf_token()}}' //token để sử dụng với hàm post
    },
    dataType: 'json', //Kiểu dữ liệu trả về
    success: function (result) { //Nếu dữ liệu trả về ok thì sẽ chạy tiếp ở đây
        $('#cau_hinh'+i).html('<option value="123">Chọn cấu hình</option>');
        $.each(result.cauhinh, function (key, value) {
            $("#cau_hinh"+i).append('<option value="' + value.id + '">' + value.tencauhinh + '</option>');
        });
    }
   });
};



</script>


@endsection
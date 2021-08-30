@extends('layout.master')
@section('content')
<?php 
$option_donvithoigian = "";
$thoigian = array('Ngày', 'Tuần', 'Tháng','Năm');
for ($i=0; $i < 4 ; $i++) { 
$option_donvithoigian .= '<option value="'.$thoigian[$i].'"">'.$thoigian[$i].'</option>';
};
?>

@foreach ($data_yeucau as $data)



<form action="{{URL::to('/post_suayeucau1')}}" method="POST">@csrf
<input type="text" name="ghichepdonhang" hidden value="{{$data->ghichepdonhang}}">
  
<br>
<section class="content" onmousemove="tinhtien()" onchange="thaydoi()">
<div class="container-fluid">
  <div class="row px-3">
    <div class="col-12">
      <div class="card">
        <div class="card-header row">
          <div class="col-4">
          <h3 class="card-title"> Sửa/Chuyển Tiếp Yêu Cầu </h3>
          </div>
          <div class="col-8" id="tag_nutchucnang">
          <div style="text-align:right;" > 
          <a href="{{URL::to('/danhsachyeucau')}}" class="btn btn-outline-primary"  id="btn_danhsach">Quay lại</a>
          <a href="{{URL::to('/xoayeucau/'.$data->id_yeucau)}}" class="btn btn-danger" id="btn_xoa" hidden>Xóa Yêu Cầu</a>
          <button class="btn btn-dark" type="submit" id="btn_luu">Lưu</button>
          <a href="{{URL::to('/chitietdonhang/'.$data->id_yeucau)}}"><button class="btn btn-primary" type="button" id="btn_chuyentiep">Chuyển tiếp</button></a>
          </div>
          </div>
        </div>
      <!-- /.card-header -->
        <div class="card-body" >
          <input type="text" name="loaikhachhang" value="{{$data->loaikhachhang}}" hidden>
          <div class="row">
          <div class="col-2">
          <label><i class="fas fa-id-badge"> Mã Đơn Hàng</i></label>
          <input type="text" id="makhachhang" name="makhachhang" value="{{$data->id_yeucau}}" class="form-control" readonly>
          </div>
          <div class="col-2">
          Mã số thuế
          <input type="text" class="form-control" id="masothue" name="masothue" value="{{$data->masothue}}">
          </div>
          <div class="col-8">
          Tên công ty
          <input type="text" class="form-control" id="tencongty" name="tencongty" value="{{$data->tencongty}}">
          </div>
          </div>
          <br>
          <div class="row">
          <div class="col">
          Đại diện:
          <input type="text" class="form-control" id="daidien" name="daidien" value="{{$data->daidien}}">
          </div>
          <div class="col">
          Điện Thoại:
          <input type="text" class="form-control" id="dienthoai" name='dienthoai' value="{{$data->dienthoai}}">
          </div>
          <div class="col">
          Email:
          <input type="email" class="form-control" id="email" name="email" value="123@gmail.com" readonly>
          </div>
          </div><br>
          <div class="row">
          <div class="col-2">
          Thời gian giao máy
          <input type="date" id="thoigiangiaomay" name="thoigiangiaomay" class="form-control" value="{{$data->thoigiangiaomay}}">
          </div>  
          <div class="col-10">
          Địa chỉ:
          <input type="text" class="form-control" id="diachi" name="diachi" value="{{$data->diachi}}">
          </div>
          </div>
          <div class="row">
          <div class="col">
          Yêu cầu khác
          <textarea name="ghichu" class="form-control" placeholder="Nhập yêu cầu">{{$data->ghichu}}</textarea>
          </div>
          </div>
          <br>  

          <div class="row">
          <div class="col">
          <table class="table table-hover table-bordered" id="table_taoyeucau" onchange="tinhtien()">
          <thead class="thead-dark">
          <tr>
          <th class="col-1">
          <a onclick="themdong()" id="btn_them" hidden><i class="fas fa-plus"></i></a>
          <a onclick="xoadong()" id="btn_xoa"  hidden><i class="fa fa-minus"></i></a>
          </th>
          <th class="col-3">Loại Thiết Bị</th>
          <th class="col-1">Số lượng</th>
          <th class="col-3">Thời gian thuê</th>
          <th class="col-2">Đơn giá</th>
          <th class="col-2">Thành tiền</th>
          </tr>
          </thead>
          <tbody>
          <?php 
          $i = 1;
          $thongtinthietbi = array(json_decode($data->thongtinthietbi, true));
          $thongtinthietbi = $thongtinthietbi[0];
          $gioihan = $thongtinthietbi['gioihan'];
          for ($i=1; $i <= $gioihan; $i++) {
          ?>        
          <input type="number" value="{{$gioihan}}" id="gioihan" hidden>
          <input type="number" value="{{$data->id_yeucau}}" id="id_yeucau" name="id_yeucau" hidden>
          <tr>
          <th scope="row"><?php echo $i; ?></th>
          <td><input list="loaithietbi" name="loaithietbi{{$i}}" value="{{$thongtinthietbi[$i]['loaithietbi'.$i]}}" id="loaithietbi{{$i}}"></td>
          <td><input type="number" id="soluong{{$i}}" name="soluong{{$i}}" value="{{$thongtinthietbi[$i]['soluong'.$i]}}" min="0"></td>
          <td >
          <input style="width: 50%; float: left; " type="number" id="sothoigian{{$i}}" name="sothoigian{{$i}}" min="0" value="{{$thongtinthietbi[$i]['sothoigian'.$i]}}">
          <select style="width: 50%; border: none;" id="donvithoigian{{$i}}" name="donvithoigian{{$i}}">
          <option value="{{$thongtinthietbi[$i]['donvithoigian'.$i]}}" hidden>{{$thongtinthietbi[$i]['donvithoigian'.$i]}}</option>
          <?php echo $option_donvithoigian ?>
          </select>               
          </td>
          <td><input id="dongia{{$i}}" name="dongia{{$i}}" value="{{$thongtinthietbi[$i]['dongia'.$i]}}" ></td>
          <td><input type="text" readonly="" id="thanhtien{{$i}}"></td>
          </tr> 
          <?php  } ?>                     
          </tbody>
          <tfoot>
          <input type="text" name="sochungloaithietbi" id="sochungloaithietbi" value="{{$gioihan}}" hidden>

          </tfoot>                      
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
@endforeach



<datalist id="loaithietbi">
<option value="Laptop">
<option value="PC + Màn Hình">
<option value="PC">
<option value="Máy In">
<option value="Máy Chiếu">
<option value="Switch">
<option value="UPS">
<option value="Máy Scan">
<option value="Webcam">
<option value="Camera">
<option value="Core I5, Ram 8gb, SSD 120">
<option value="Core I5, Ram 4gb, SSD 120">
<option value="Core I3, Ram 4gb, SSD 120">
<option value="Pentium, Ram 4gb, SSD 120">
</datalist>

@endsection
<style>
tbody input{
width: 100%;
border: none;
}
#sothoigian, #donvithoigian{
width: 50%;
float: left;
border: none;
}
#khachhangmoi ,#khachhangcu{
border: 1px solid black;
}
</style>
@section('js')
<script>
$("#tag_donhang").addClass('menu-open');
$("#donhang").addClass('active');
$("#xuliyeucau").addClass('active');
$("#xuliyeucau").prop('hidden',false);

$("#daidien").prop('readonly',false);
$("#dienthoai").prop('readonly',false);
$("#diachi").prop('readonly',false);
$("#tencongtymoi").prop('readonly',false);
$("#masothuemoi").prop('readonly',false);
$("#thoigiangiaomay").prop('readonly',false);
$("#ghichu").prop('readonly',false);
$("#btn_chuyentiep").prop('hidden',false);
$("#btn_sua").prop('hidden',true);
$("#tag_loaikhachhang").prop('hidden',false);
$("#table_taoyeucau tbody tr td input").prop('disabled',false);
$("#table_taoyeucau tbody tr td select").prop('disabled',false);
$("#btn_them").prop('hidden',false);
$("#btn_xoa").prop('hidden',true);






var $i = parseInt(document.getElementById('gioihan').value)+1;
function themdong(){    
$('#table_taoyeucau').append('<tr>'+
'<th scope="row">'+$i+'</th>'+
'<td><input list="loaithietbi" name="loaithietbi'+$i+'" id="loaithietbi'+$i+'"></td>'+
'<td><input type="number" id="soluong'+$i+'" name="soluong'+$i+'" min="0"></td>'+
'<td>'+
'<input style="width: 50%; float: left;" type="number" id="sothoigian'+$i+'" name="sothoigian'+$i+'" min="0">'+
'<select style="width: 50%; border:none;" id="donvithoigian'+$i+'" name="donvithoigian'+$i+'">'+
'<?php echo $option_donvithoigian ?></select>'+               
'</td>'+
'<td><input id="dongia'+$i+'" name="dongia'+$i+'" ></td>'+
'<td><input type="text" id="thanhtien'+$i+'" readonly value="0"></td>'+
'</tr>');
$i = $i + 1;
document.getElementById('sochungloaithietbi').value = $i - 1; 
$("#table_taoyeucau tbody td input").addClass('form-control');
$("#table_taoyeucau tbody td select").addClass('form-control');
$("#table_taoyeucau tbody td select").css('border','none');
$("#table_taoyeucau tbody td input").css('border','none');
};
$("#table_taoyeucau tbody td input").addClass('form-control');
$("#table_taoyeucau tbody td select").addClass('form-control');
$("#table_taoyeucau tbody td select").css('border','none');
$("#table_taoyeucau tbody td input").css('border','none');
$("#btn_luu").prop('hidden',true);
function  thaydoi(){
$("#btn_chuyentiep").prop('hidden',true);
$("#btn_luu").prop('hidden',false);
$("#btn_xoa").prop('hidden',false);
}


function chonkhachmoi(){
$('#khachhangcu').removeClass('btn-primary');
$('#khachhangmoi').addClass('btn-primary');
$("#daidien").prop('readonly',false);
$("#dienthoai").prop('readonly',false);
$("#diachi").prop('readonly',false);
$("#tag_chonkhachhang").prop('hidden',true);
$("#tag_loaikhachhang").prop('hidden',false);
$("#tencongtymoi").prop('readonly',false);
$("#masothuemoi").prop('readonly',false);

};
function chonkhachcu(){
$('#khachhangmoi').removeClass('btn-primary');
$('#khachhangcu').addClass('btn-primary');
$("#daidien").prop('readonly',true);
$("#dienthoai").prop('readonly',true);
$("#diachi").prop('readonly',true);
$("#tag_chonkhachhang").prop('hidden',false);
$("#tag_loaikhachhang").prop('hidden',true);
$( "#masothuemoi" ).prop("readOnly",'true');
$( "#tencongtymoi" ).prop("readOnly",'true');





};
function khachhangcanhan(){
$( "#tencongtymoi" ).attr('value','Cá Nhân');
$( "#tencongtymoi" ).prop("readOnly",true);
$( "#masothuemoi" ).prop("readOnly",true);
$( "#doanhnghiep" ).prop("checked",false);
$( "#loaikhachhang" ).prop("value",'0');
$( "#masothuemoi" ).prop("value",'0');


};
function khachhangdoanhnghiep(){
$( "#masothuemoi" ).prop("readOnly",false);
$( "#tencongtymoi" ).attr('value','');
$( "#tencongtymoi" ).prop("readOnly",false);
$( "#canhan" ).prop("checked",false);
$( "#loaikhachhang" ).prop("value",'1');

};


function tinhtien(){
for (let i = 1; i < $i; i++) {
document.getElementById("thanhtien"+i).value = currency(document.getElementById("soluong"+i).value*document.getElementById("sothoigian"+i).value*parseInt(document.getElementById("dongia"+i).value.replace(/,/g, '')), { precision: 0, symbol:'đ', pattern: `# !`}).format();
$("#dongia"+i).on('blur', function() {
const value = this.value.replace(/,/g, '');
this.value = parseFloat(value).toLocaleString('en-US', {
style: 'decimal',
maximumFractionDigits: 0,
minimumFractionDigits: 0
});
});
}
};
function xoadong(){
if(parseInt(document.getElementById('sochungloaithietbi').value) > 1 ){
document.getElementById('table_taoyeucau').deleteRow(-1);
document.getElementById('sochungloaithietbi').value = document.getElementById('sochungloaithietbi').value - 1 ;
};
};

</script>
<script src="https://unpkg.com/currency.js@2.0.4/dist/currency.min.js">
const JPY = value => currency(value, { precision: 0, symbol: '¥' });
</script>

@endsection

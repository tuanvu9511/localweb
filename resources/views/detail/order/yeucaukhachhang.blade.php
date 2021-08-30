@extends('layout.master')
@section('content')
<?php 
$option_donvithoigian = "";
$thoigian = array('Ngày', 'Tuần', 'Tháng','Năm');
for ($i=0; $i < 4 ; $i++) { 
  $option_donvithoigian .= '<option value="'.$thoigian[$i].'"">'.$thoigian[$i].'</option>';
};
 ?>
<div class="  bd-example-modal-xl" tabindex="1" role="dialog">
  <div class="modal-dialog modal-xl col-12">
    <div class="modal-content" onmousemove="tinhtien()">
      <form action="{{URL::to('/post_taoyeucau')}}" method="POST">@csrf
      <div class="card">
      

        @foreach ($datakhachhang as $data)
      <div class="col-10 offset-1"><br>
        <h4><i class="far fa-sticky-note"> Tạo yêu cầu mới</i></h4>
        <hr>
      <div class="row">
        <div class="col-2 inline">
          <i class="fas fa-id-badge"> Mã KH</i>
          <input type="text" id="makhachhang" name="makhachhang" value="{{$data->makhachhang}}" class="form-control" readonly>
          </div>

        <div class="col-2">
          <i class="fas fa-percentage"> Mã số thuế</i>
          <input type="text" class="form-control" id="masothue" name="masothue" value="{{$data->masothue}}">
        </div>
        <div class="col-5">
          <i class="fas fa-building"> Tên công ty</i>
          <input type="text" class="form-control" id="tencongty" name="tencongty" value="{{$data->tencongty}}">
        </div>
        <div class="col-3">
          <i class="fas fa-user-tag"> Đại diện:</i>
          <input type="text" class="form-control" id="daidien" name="daidien" placeholder="" value="{{$data->daidien}}" required>
        </div>
      </div>

      <div class="row">
           <div class="col">
            <i class="fas fa-phone-alt"> Điện Thoại:</i>
            <input type="text" class="form-control" id="dienthoai" name='dienthoai' value="{{$data->dienthoai}}" readonly>
          </div>
          <div class="col">
            <i class="far fa-envelope"><b> Email:</b></i>
            <input type="email" class="form-control" id="email" name="email" value="{{$data->email}}" readonly>
          </div>
          <div class="col-3">
            <i class="far fa-calendar-check"> Thời gian giao máy</i>
            <input type="date" id="thoigiangiaomay" name="thoigiangiaomay" class="form-control" value="" required>
          </div> 
      </div>

      <div class="row">
         <div class="col-3">
          <i class="fas fa-file-signature"> Đặt cọc/Hợp Đồng </i>
          <select type="text" class="form-control" id="loaithue" name="loaithue" required>
            <option value="1">Biên bản xác nhận/ Có đặt cọc</option>
            <option value="2">Kí hợp đồng, có đặt cọc</option>
            <option value="3">Biên bản xác nhận/ Không đặt cọc</option>
            <option value="4">Kí hợp đồng, không đặt cọc, thanh toán sau</option>
            <option value="5">Kí hợp đồng, không đặt cọc, thanh toán trước</option>
          </select>
        </div>
        <div class="col-2">
          <i class="fas fa-money-bill-alt"> Giá trị đặt cọc </i> 
          <input type="text" id="tiencoc" name="tiencoc" value="0" class="form-control" >
        </div>

        <div class="col-7">
          <i class="fas fa-map-marker"> Địa chỉ lắp máy: </i>
          <input type="text" class="form-control" id="diachi" name="diachi" >
        </div>
      </div>
@endforeach
      <div class="row">
        <div class="col">
          <i class="fas fa-sticky-note"> Yêu cầu khác:</i>
          <textarea name="ghichu" class="form-control" placeholder="Nhập yêu cầu"></textarea>
        </div>
      </div><br>

      <div class="row">
<!--  table -->
<table class="table table-hover table-bordered" id="table_taoyeucau">
  <thead class="thead-light text-center">
    <tr>
      <th width="3%">
          <a onclick="add_table()"><i class="fas fa-plus"></i></a><a onclick="delete_table()"><i class="fas fa-minus"></i></a></th>
      <th width="25%">Thiết bị yêu cầu</th>
      <th width="10%">Số lượng</th>
      <th width="15%">TG thuê</th>
      <th width="15%">Đơn giá</th>
      <th width="15%">Thành tiền</th>
    </tr>
  </thead>
  <tbody>
    <tr>
        <td class="text-center">{{$i=1}}</td>
        <td><input list="loaithietbi" name="loaithietbi1" id="loaithietbi1"></td>
        <td><input type="number" id="soluong1" name="soluong1" ></td>
        <td>
            <input class="w-50 float-left" type="text" id="sothoigian1" name="sothoigian1" min="0">
            <select class="w-50" id="donvithoigian1" name="donvithoigian1">
              <?php echo $option_donvithoigian ?>
            </select></td>
        <td><input id="dongia1" name="dongia1"></td>
        <td><input type="text" readonly value="0" id="thanhtien1"></td>
      </tr>  
  </tbody>
   <tfoot>
      <input type="text" name="sochungloaithietbi" id="sochungloaithietbi" value="1" hidden>
    </tfoot>   
</table>
      </div>
      <div class="row">
        <div class="col" style="text-align:center">
          <button class="btn btn-info" type="submit">Tạo yêu cầu</button>
        </div>
      </div>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>
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

<datalist id="loaithietbi">
  <option value="Laptop I3, Ram 4gb, SSD">
  <option value="Laptop Core I5, Ram 4gb, SSD">
  <option value="Laptop Core I5, Ram 8gb, SSD">
  <option value="Laptop Core I5(CPU thế hệ 4) , Ram 8gb, SSD">
  <option value="Laptop Core I5(CPU thế hệ 4) , Ram 8gb, SSD">
  <option value="Case PC I5, Ram 8gb, SSD">
  <option value="Case PC I5, Ram 8gb, SSD, VGA rời">
  <option value="Case PC I5, Ram 8gb, SSD, VGA rời + Màn Hình 19inch">
  <option value="Case PC I5, Ram 8gb, SSD, VGA rời + Màn Hình 24inch">
  <option value="Màn Hình 24inch + Phụ Kiện">
  <option value="Màn Hình 19inch + Phụ kiện">
</datalist>

</datalist>

@section('js')
<script src="https://unpkg.com/currency.js@2.0.4/dist/currency.min.js">
const JPY = value => currency(value, { precision: 0, symbol: '¥' });
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script>



  $("#tag_donhang").addClass('menu-open');
  $("#donhang").addClass('active');
  $("#taoyeucau").addClass('active');
  $("#taoyeucau").prop('hidden',false);

  function suanoidung(){
    $("#daidien").prop('readonly',false);
    $("#dienthoai").prop('readonly',false);
    $("#diachi").prop('readonly',false);
    $("#tencongtymoi").prop('readonly',false);
    $("#masothuemoi").prop('readonly',false);
  };


function luachonkhachhang(){
if(document.getElementById('khachhangcanhan').checked == true){
    $("#masothue").prop('readonly',true);
    $("#tencongty").prop('readonly',true);
    $("#masothue").prop('value',0);
    $("#tencongty").prop('value','Cá Nhân');
}
if(document.getElementById('khachhangdoanhnghiep').checked == true){
    $("#masothue").prop('readonly',false);
    $("#tencongty").prop('readonly',false);
    $("#masothue").prop('value',"");
    $("#tencongty").prop('value',"");
}

};

  var $i = 2;
  function add_table(){    
    $('#table_taoyeucau').append('<tr>'+
          '<th scope="row">'+$i+'</th>'+
          '<td><input list="loaithietbi" name="loaithietbi'+$i+'" id="loaithietbi'+$i+'"></td>'+
          '<td><input class="CurrencyInput" id="soluong'+$i+'" name="soluong'+$i+'" min="0"></td>'+
          '<td>'+
              '<input style="width: 50%; float: left;" type="number" id="sothoigian'+$i+'" name="sothoigian'+$i+'" min="0">'+
              '<select style="width: 50%; border:none;" id="donvithoigian'+$i+'" name="donvithoigian'+$i+'"><?php echo $option_donvithoigian ?></select>'+               
          '</td>'+
          '<td><input id="dongia'+$i+'" name="dongia'+$i+'"  ></td>'+
          '<td><input type="text" id="thanhtien'+$i+'" readonly="" value="0"></td>'+
        '</tr>');
    $i = $i +1;
    document.getElementById('sochungloaithietbi').value = $i-1;
  };
$("#tag_loaikhachhang").prop('hidden',false);
$("#tag_chonkhachhang").prop('hidden',true);
function khach_hangmoi(){
  $('#khach_hangcu').removeClass('btn-primary');
  $('#khach_hangmoi').removeClass('btn-outline-primary');
  $('#khach_hangmoi').addClass('btn-primary');
  $('#khach_hangcu').addClass('btn-outline-primary');
  $("#daidien").prop('readonly',false);
  $("#dienthoai").prop('readonly',false);
  $("#diachi").prop('readonly',false);
  $("#tag_chonkhachhang").prop('hidden',true);
  $("#tag_loaikhachhang").prop('hidden',false);
  $("#tencongty").prop('readonly',false);
  $("#masothue").prop('readonly',false);
  $("#email").prop('readonly',false);
  $("#chonkhachhang").prop('hidden',true);
  $("#doituongkhachhang").prop('hidden',false);
};
  function khach_hangcu(){
    $('#khach_hangmoi').removeClass('btn-primary');
    $('#khach_hangmoi').addClass('btn-outline-primary');
    $('#khach_hangcu').addClass('btn-primary');
    $('#khach_hangcu').removeClass('btn-outline-primary');
    $("#daidien").prop('readonly',true);
    $("#dienthoai").prop('readonly',true);
    $("#email").prop('readonly',true);
    $("#tag_chonkhachhang").prop('hidden',false);
    $("#tag_loaikhachhang").prop('hidden',true);
    $( "#masothue" ).prop("readOnly",true);
    $( "#tencongty" ).prop("readOnly",true);
    $("#chonkhachhang").prop('hidden',false);
    $("#doituongkhachhang").prop('hidden',true);





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
}

function timkiemkhachhang() {
  var x = document.getElementById("fname");
  x.value = x.value.toUpperCase();
}
</script>


@endsection

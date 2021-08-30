@extends('layout.master')
@section('content')


<br>
<section class="content" onmousemove="tinhtien()">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12 px-5">
            <div class="card">
  <div class="card-header row">
    <div class="col-4">
      <h3 class="card-title"> Tạo yêu cầu </h3>
    </div>
    <div class="col-8">
      <nav class="row">
        <a class="btn col" onclick="khach_hangcu()" id="khach_hangcu">Khách hàng cũ</a>
        <a class="btn col" onclick="khach_hangmoi()" id="khach_hangmoi">Khách hàng mới</a>
        <input type="text" name="khachhangcu0moi1" id="khachhangcu0moi1" value="1" hidden>
      </nav>
    </div>
    
  </div>
              <!-- /.card-header -->
<div class="card-body">
  <div class="col-12 row form-check-inline" id="doituongkhachhang">
  <div class="col-10 offset-1 text-center" onchange="luachonkhachhang()">
    <div class="form-check form-check-inline">
      <label for="">Đối tượng khách hàng: </label>
    </div>
    <div class="form-check form-check-inline" >
      <input class="form-check-input" type="radio" name="loaikhachhang" checked id="khachhangdoanhnghiep" value="1">
      <label class="form-check-label" for="inlineRadio2"><i class="fas fa-industry"> Doanh nghiệp</i></label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="loaikhachhang" id="khachhangcanhan"  value="0">
       <label class="form-check-label" for="inlineRadio1"><i class="fas fa-user"> Cá nhân</i></label>
    </div>
  </div>
</div>
<div class="row" id="chonkhachhang">
  <label for="" class="col-3 text-right">Chọn khách hàng: </label>
  <select class="form-control col-7" onchange="laythongtinkhachhang()" name="chon_khachhang" id="chon_khachhang"><?php echo $option_khachhang ?></select>
</div>

<br>

<div class="row">
    <div class="col-2 inline">
      <i class="fas fa-id-badge"> Mã KH</i>
      <input type="text" id="makhachhang" name="makhachhang" value="{{$idmax}}" class="form-control" disabled>
      </div>
    <div class="col-3">
      <i class="fas fa-percentage"> Mã số thuế</i>
      <input type="text" class="form-control" id="masothue" name="masothue" placeholder="" required>
    </div>
    <div class="col-7">
      <i class="fas fa-building"> Tên công ty</i>
      <input type="text" class="form-control" id="tencongty" name="tencongty" placeholder="" required>
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col">
      <i class="fas fa-user-tag"> Đại diện:</i>
      <input type="text" class="form-control" id="daidien" name="daidien" placeholder="" required>
    </div>
     <div class="col">
      <i class="fas fa-phone-alt"> Điện Thoại:</i>
      <input type="text" class="form-control" id="dienthoai" name='dienthoai' placeholder="" required>
    </div>
    <div class="col">
      <i class="far fa-envelope"> Email:</i>
      <input type="email" class="form-control" id="email" name="email" placeholder="" required>
    </div>
  </div>
<br>
  <div class="row">
     <div class="col">
      <i class="fas fa-map-marker-alt"> Địa chỉ:</i>
      <input type="text" class="form-control" id="diachi" name="diachi" placeholder="" required>
    </div>
  </div>

<br>
<div class="row">
   <div class="col-2">
      Thời gian giao máy
      <input type="date" id="thoigiangiaomay" name="thoigiangiaomay" class="form-control">
    </div>  
   <div class="col-10">
    Địa chỉ:
    <input type="text" class="form-control" id="diachi" name="diachi" placeholder="">
  </div>
</div>
<div class="row">
  <div class="col">
    Yêu cầu khác
    <textarea name="ghichu" class="form-control" placeholder="Nhập yêu cầu"></textarea>
  </div>
</div>
<br>
  <div class="col row">
    <table class="table table-hover table-bordered" id="table_taoyeucau" >
      <thead class="thead-dark text-center">
        <tr>
          <th style="width:3%" scope="col">
            <a onclick="add_table()"><i class="fas fa-plus"></i></a>
            <a onclick="delete_table()"><i class="fas fa-minus"></i></a>
          </th>
          <th class="col-3" scope="col">Loại Thiết Bị</th>
          <th style="width:12%" scope="col">Số lượng</th>
          <th class="col-3" scope="col">Thời gian thuê</th>
          <th class="col-2" scope="col">Đơn giá</th>
          <th class="col-2" scope="col">Thành tiền</th>
        </tr>
      </thead>
      <tbody onchange="tinhtien()">
        <tr>
          <th scope="row" class="text-center"><?php echo $i=1; ?></th>
          <td><input list="loaithietbi" name="loaithietbi1" id="loaithietbi1"></td>
          <td><input type="number" id="soluong1" name="soluong1" min="0"></td>
          <td >
              <input style="width: 50%; float: left; " type="number" id="sothoigian1" name="sothoigian1" min="0">
              <select style="width: 50%; border: none;" id="donvithoigian1" name="donvithoigian1"><?php echo $option_donvithoigian ?></select>               
          </td>
          <td><input id="dongia1" onchange="doitien({{$i}})" name="dongia1"></td>
          <td><input type="text" readonly="" value="0" id="thanhtien1"></td>
        </tr>                      
      </tbody>
      <tfoot>
        <input type="text" name="sochungloaithietbi" id="sochungloaithietbi" value="1" hidden>
      </tfoot>                      
    </table>
  </div>
</div>
<div class="row">
  <div class="col" style="text-align:center">
    <button class="btn btn-primary" type="submit">Tạo yêu cầu</button>
  </div>
</div>

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

</section>
</form>
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

<div class="col" >
        <a onclick="suanoidung()" id="suanoidung"><i class="fas fa-edit"></i></a>
      </div>

@section('js')
<script src="https://unpkg.com/currency.js@2.0.4/dist/currency.min.js"></script>
<script>
  $("#tag_donhang").addClass('menu-open');
  $("#donhang").addClass('active');
  $("#taoyeucau").addClass('active');

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
    $("#tencongty").prop('value',"");}
};

  var $i = 2;
  function add_table(){    
    $('#table_taoyeucau').append('<tr>'+
          '<th scope="row" class="text-center">'+$i+'</th>'+
          '<td><input list="loaithietbi" name="loaithietbi'+$i+'" id="loaithietbi'+$i+'"></td>'+
          '<td><input type="number" id="soluong'+$i+'" name="soluong'+$i+'" min="0"></td>'+
          '<td>'+
              '<input style="width: 50%; float: left;" type="number" id="sothoigian'+$i+'" name="sothoigian'+$i+'" min="0">'+
              '<select style="width: 50%; border:none;" id="donvithoigian'+$i+'" name="donvithoigian'+$i+'"><?php echo $option_donvithoigian ?></select>'+               
          '</td>'+
          '<td><input type="number"  onchange="doitien(+'$i'+)" id="dongia'+$i+'" name="dongia'+$i+'"></td>'+
          '<td><input type="text" id="thanhtien'+$i+'" readonly="" value="0"></td>'+
        '</tr>');
    $i = $i +1;
    document.getElementById('sochungloaithietbi').value = $i-1;
    $("#table_taoyeucau tbody td input").addClass('form-control');
    $("#table_taoyeucau tbody td select").addClass('form-control');
    $("#table_taoyeucau tbody td select").css('border','none');
    $("#table_taoyeucau tbody td input").css('border','none');
  };
$('#khach_hangmoi').addClass('btn-primary');
$('#khach_hangcu').addClass('btn-outline-primary');
$("#daidien").prop('readonly',false);
$("#dienthoai").prop('readonly',false);
$("#diachi").prop('readonly',false);
$("#tencongtymoi").prop('readonly',false);
$("#masothuemoi").prop('readonly',false);
$("#tag_loaikhachhang").prop('hidden',false);
$("#tag_chonkhachhang").prop('hidden',true);
$("#chonkhachhang").prop('hidden',true);
$("#table_taoyeucau tbody td input").addClass('form-control');
$("#table_taoyeucau tbody td select").addClass('form-control');
$("#table_taoyeucau tbody td select").css('border','none');
$("#table_taoyeucau tbody td input").css('border','none');


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
    $("#makhachhang").prop('value',{{$idmax}});
    $("#khachhangcu0moi1").prop('value','1');
    $("#makhachhang").prop('value',{{$idmax}});
    $("#masothue").prop('value','');
    $("#tencongty").prop('value','');
    $("#daidien").prop('value','');
    $("#dienthoai").prop('value','');
    $("#email").prop('value','');
    $("#diachi").prop('value','');



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
    $("#makhachhang").prop('value',"");
    $("#khachhangcu0moi1").prop('value','0');

  };


  function khachhangcanhan(){
  $( "#tencongtymoi" ).attr('value','Cá Nhân');
  $( "#tencongtymoi" ).prop("readOnly",true);
  $( "#masothuemoi" ).prop("readOnly",true);
  $( "#doanhnghiep" ).prop("checked",false);
  $( "#loaikhachhang" ).prop("value",'0');
  $( "#masothuemoi" ).prop("value",'0');
};




function tinhtien(){
  for (let i = 1; i < $i; i++) {
  document.getElementById("thanhtien"+i).value = currency(document.getElementById("soluong"+i).value*document.getElementById("sothoigian"+i).value*parseInt(document.getElementById("dongia"+i).value.replace(/,/g, '')), { precision: 0, symbol:'đ', pattern: `# !`}).format();
      
}
}
function doitien(i){
    
      alert('abc');
}




function delete_table(){
  if(parseInt(document.getElementById('sochungloaithietbi').value) > 1 ){
    document.getElementById('table_taoyeucau').deleteRow(-1);
    document.getElementById('sochungloaithietbi').value = document.getElementById('sochungloaithietbi').value - 1 ;
  };
};

function  laythongtinkhachhang(){
  var id_makhachhang = document.getElementById('chon_khachhang').value; //Lấy dữ liệu country
  $.ajax({
    url: "{{URL::to('/laythongtinkhachhang')}}", //url xử lí data
    type: "POST", //kiểu đưa dữ liệu lên
    data: {
        idtruyenvao: id_makhachhang, //khai báo dữ liệu đưa vào
        _token: '{{csrf_token()}}' //token để sử dụng với hàm post
    },
    dataType: 'json', //Kiểu dữ liệu trả về
    success: function (result) { //Nếu dữ liệu trả về ok thì sẽ chạy tiếp ở đây
        $.each(result.thongtinkhachhang, function (key, value) {
            $("#makhachhang").prop('value',value.makhachhang);
            $("#masothue").prop('value',value.masothue);
            $("#tencongty").prop('value',value.tencongty);
            $("#daidien").prop('value',value.daidien);
            $("#dienthoai").prop('value',value.dienthoai);
            $("#email").prop('value',value.email);
            $("#diachi").prop('value',value.diachi);
        });
    }
   });
};

</script>


@endsection

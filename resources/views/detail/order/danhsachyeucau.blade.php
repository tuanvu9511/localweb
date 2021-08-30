@extends('layout.master')
@section('content')

<br>
<section class="content" >
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header row">
                <div class="col"><h3> <i class="fas fa-list-ol"> Danh sách yêu cầu </i></h3></div>
                <div class="col text-right">
                  <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-history"> Lịch sử yêu cầu</i></button>
                  <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target=".bd-example-modal-xl"><i class="fas fa-plus"> Yêu Cầu Mới</i></button>
                </div>
              </div>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Lịch sử yêu cầu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Tính Năng Đang Phát Triển
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



              <!-- /.card-header -->
              <div class="card-body row">
                  <table class="table table-bordered table-hover" id="table_danhsachyeucau">
                    <thead class="thead-light text-center">
                        <th hidden>ssngaytao</th>
                        <th class="col-1">Ngày tạo</th>
                        <th class="col-4">Thông tin khách hàng</th>
                        <th class="col-5 text-center">Danh sách yêu cầu</th>
                        <th hidden > ssngaycuoicung</th>
                        <th class="col-2">Tình trạng</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($data_danhsachyeucau as $data)
                      <tr>
                        <td>{{\Carbon\Carbon::parse($data->created_at)->format('d/m/Y')}}</td>
                        <td hidden><?php echo strtotime($data->created_at); ?></td>
                        <td>
                           
                          {{$data->tencongty}} - <b>{{$data->daidien}}</b><br>
                          Giao ngày: <b>{{\Carbon\Carbon::parse($data->thoigiangiaomay)->format('d/m/Y')}}</b><br>
                          Liên hệ: {{$data->dienthoai}}<br>
                          Tại: {{$data->diachi}}<br>
                          <b style="color:blue">  Loại hình thuê: <?php   switch ($data->loaithue) {
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
                            </b><b style="color:red">Đặt cọc: {{$data->tiencoc}}đ</b> <br>
                        </td>
                        <td>
                          <?php 
                            $i = 1;
                            $thongtinthietbi = array(json_decode($data->thongtinthietbi, true))[0];
                            $gioihan = $thongtinthietbi['gioihan']+1;
                            for ($i=1; $i < $gioihan; $i++) { 
                            echo  '- Yêu cầu '.$i.': Số lượng '.$thongtinthietbi[$i]['soluong'.$i].' Máy<br>Cấu hình:'.$thongtinthietbi[$i]['loaithietbi'.$i];
                            // $thongtinthietbi[$i]['loaithietbi'.$i] 
                            // $thongtinthietbi[$i]['soluong'.$i]

                            }
                            //Ghi chú đơn hàng
                            if ($data->ghichu){ 
                            echo '<br><p style="background: yellow;">Lưu ý: '.$data->ghichu.' </p>';} 
                          ?>
                        </td>
                        <td><a href="{{URL::to('/chuyentiepyeucau/'.$data->id_yeucau)}}" class="btn btn-primary form-control">Xử lí yêu cầu</a></td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
              </div>
            </div>
       </div>
      </div>
  </div>
</section>

<div class="modal  bd-example-modal-xl" tabindex="1" role="dialog">
  <div class="modal-dialog modal-xl col-12">
    <div class="modal-content"  onmouseout="tinhtien()">

      <form action="{{URL::to('/post_taoyeucau')}}" method="POST">@csrf
      <div class="col-12">
        <nav class="row">
          <a class="btn col" onclick="khach_hangcu()" id="khach_hangcu">Khách hàng cũ</a>
          <a class="btn col" onclick="khach_hangmoi()" id="khach_hangmoi">Khách hàng mới</a>
        </nav>
      </div>
      <input type="text" name="khachhangcu0moi1" id="khachhangcu0moi1" value="1" hidden>

    <div class="card">
      <div class="col-12 px-5"><br>

      <div class="text-left"   id="tag_loaikhachhang" onchange="luachonkhachhang()">
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

      <div class="row" id="chonkhachhang">
        <label for="" class="col-3 text-right">Chọn khách hàng: </label>
        <select class="form-control col-7" onchange="laythongtinkhachhang()" name="chon_khachhang" id="chon_khachhang"><?php echo $option_khachhang ?></select>
      </div>

      <div class="row">
        <div class="col-2 inline">
          <i class="fas fa-id-badge"> Mã KH</i>
          <input type="text" id="makhachhang" name="makhachhang" value="{{$idmax}}" class="form-control" readonly>
          </div>

        <div class="col-2">
          <i class="fas fa-percentage"> Mã số thuế</i>
          <input type="text" class="form-control" id="masothue" name="masothue" placeholder="" required>
        </div>

        <div class="col-5">
          <i class="fas fa-building"> Tên công ty</i>
          <input type="text" class="form-control" id="tencongty" name="tencongty" placeholder="" required>
        </div>
        <div class="col-3">
            <i class="fas fa-user-tag"> Đại diện:</i>
            <input type="text" class="form-control" id="daidien" name="daidien" placeholder="" required>
          </div>
      </div>

      <div class="row">
           <div class="col">
            <i class="fas fa-phone-alt"> Điện Thoại:</i>
            <input type="text" class="form-control" id="dienthoai" name='dienthoai' placeholder="" required>
          </div>
          <div class="col">
            <i class="far fa-envelope"><b> Email:</b></i>
            <input type="email" class="form-control" id="email" name="email" placeholder="" >
          </div>
           <div class="col-3">
            <i class="far fa-calendar-check"> <b>Thời gian giao:</b></i>
            <input type="date" id="thoigiangiaomay" name="thoigiangiaomay" class="form-control" required>
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
      <th width="30%">Thiết bị yêu cầu</th>
      <th width="10%">Số lượng</th>
      <th width="15%">TG thuê</th>
      <th width="10%">Đơn giá</th>
      <th width="15%">Thành tiền</th>
    </tr>
  </thead>
  <tbody>
    <tr id="hang1">
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
@endsection

@section('js')



<script>
$("#tag_donhang").addClass('menu-open');
$("#donhang").addClass('active');
$("#danhsachyeucau").addClass('active');
$(document).ready( function () {
$('#table_danhsachyeucau').DataTable({
  "paging": true,
  "lengthChange": true,
  "searching": true,
  "info": true,
  "autoWidth": false,
  "responsive": true,
  "order":[[6,"desc"]]
});
} );
function luachonkhachhang(){
if(document.getElementById('khachhangcanhan').checked == true){
    $("#tencongty,#masothue").prop('readonly',true);
    $("#masothue").prop('value',0);
    $("#tencongty").prop('value','Cá Nhân');
}
if(document.getElementById('khachhangdoanhnghiep').checked == true){
    $("#masothue, #tencongty").prop('readonly',false);
    $("#masothue").prop('value',"");
    $("#tencongty").prop('value',"");}
};

  var $i = 2;
  function add_table(){    
    $('#table_taoyeucau').append('<tr id="hang'+$i+'">'+
          '<th scope="row" class="text-center">'+$i+'</th>'+
          '<td><input list="loaithietbi" name="loaithietbi'+$i+'" id="loaithietbi'+$i+'"></td>'+
          '<td><input type="" id="soluong'+$i+'" name="soluong'+$i+'" min="0"></td>'+
          '<td>'+
              '<input style="width: 50%; float: left;" type="text" id="sothoigian'+$i+'" name="sothoigian'+$i+'" min="0">'+
              '<select style="width: 50%; border:none;" id="donvithoigian'+$i+'" name="donvithoigian'+$i+'"><?php echo $option_donvithoigian ?></select>'+               
          '</td>'+
          '<td><input type="number" id="dongia'+$i+'" name="dongia'+$i+'" min="0"></td>'+
          '<td><input type="text" id="thanhtien'+$i+'" readonly="" value="0"></td>'+
        '</tr>');
    $i = $i +1;
    document.getElementById('sochungloaithietbi').value = $i-1;
    $("#table_taoyeucau tbody td input, #table_taoyeucau tbody td select").addClass('form-control');
    $("#table_taoyeucau tbody td select, #table_taoyeucau tbody td input").css('border','none');

  };
$('#khach_hangmoi').addClass('btn-info');
$('#khach_hangcu').addClass('btn-outline-info');
$("#tag_loaikhachhang").prop('hidden',false);
$("#tag_chonkhachhang").prop('hidden',true);
$("#chonkhachhang").prop('hidden',true);
$("#table_taoyeucau tbody td input, #table_taoyeucau tbody td select").addClass('form-control');
$("#table_taoyeucau tbody td select, #table_taoyeucau tbody td input").css('border','none');


  function khach_hangmoi(){
    $('#khach_hangcu').removeClass('btn-info');
    $('#khach_hangcu').addClass('btn-outline-info');
    $('#khach_hangmoi').removeClass('btn-outline-info');
    $('#khach_hangmoi').addClass('btn-info');

    $("#daidien, #dienthoai, #diachi, #tencongty, #masothue, #email").prop('readonly',false);
    $("#daidien, #dienthoai, #diachi, #tencongty, #masothue, #email").prop('value','');
    $("#tag_chonkhachhang").prop('hidden',true);
    $("#tag_loaikhachhang").prop('hidden',false);


    $("#chonkhachhang").prop('hidden',true);
    $("#doituongkhachhang").prop('hidden',false);
    $("#makhachhang").prop('value',{{$idmax}});
    $("#khachhangcu0moi1").prop('value','1');

  };
  function khach_hangcu(){
    $('#khach_hangmoi').removeClass('btn-info');
    $('#khach_hangmoi').addClass('btn-outline-info');
    $('#khach_hangcu').addClass('btn-info');
    $('#khach_hangcu').removeClass('btn-outline-info');
    $("#daidien, #dienthoai, #tencongty, #masothue, #email").prop('readonly',true);
    $("#chonkhachhang").prop('hidden',false);
    $("#doituongkhachhang").prop('hidden',true);
    $("#makhachhang").prop('value',"");
    $("#khachhangcu0moi1").prop('value','0');
    $("#tag_chonkhachhang").prop('hidden',false);
    $("#tag_loaikhachhang").prop('hidden',true);
  };

function tinhtien_old(){
  for (let i = 1; i < $i; i++) {
    $a = document.getElementById("thanhtien"+i).value;
    $b = document.getElementById("soluong"+i).value;
    $c = document.getElementById("sothoigian"+i).value;
    $d = parseInt(document.getElementById("dongia"+i).value.replace(/,/g, ''));
    $a = currency($b*$c*$d, { precision: 0, symbol:'đ', pattern: `# !`}).format();
    $("#dongia"+i).on('focusout', function() {
    const value = this.value.replace(/,/g, '');
    this.value = parseFloat(value).toLocaleString('en-US', {
    style: 'decimal',
    maximumFractionDigits: 0,
    minimumFractionDigits: 0
  });
});
}
}
function tinhtien(){
  for (let i = 1; i < $i; i++) {
    $a = document.getElementById("thanhtien"+i);
    $b = document.getElementById("soluong"+i).value;
    $c = document.getElementById("sothoigian"+i).value;
    $d = parseInt(document.getElementById("dongia"+i).value.replace(/,/g, ''));
    $a.value = currency($b*$c*$d, { precision: 0, symbol:'đ', pattern: `# !`}).format();
    $("#dongia"+i).on('focusout', function() {
    const value = this.value.replace(/,/g, '');
    this.value = parseFloat(value).toLocaleString('en-US', {
    style: 'decimal',
    maximumFractionDigits: 0,
    minimumFractionDigits: 0
  });
});
}
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
<script src="https://unpkg.com/currency.js@2.0.4/dist/currency.min.js">
const JPY = value => currency(value, { precision: 0, symbol: '¥' });
</script>
@endsection
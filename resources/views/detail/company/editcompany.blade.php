@extends('layout.master')
@section('content')
    <br>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <form method="POST" action="{{URL::to('/editcompany')}}"> @csrf
              @foreach($datacompanyedit as $datanew)
              <div class="card-header row">
                <div class="col "><h4 class=""><i class="fas fa-user-edit"> Thông tin khách hàng </i></h4></div>
                <div class="col-6 text-right" style="text-align: center;">
                        <div class="btn-group col-12">
                          <a class="btn btn-outline-info col" href="{{URL::to('/viewcustumer')}}">
                            <i class="fas fa-arrow-alt-circle-left" > Quay Lại</i>
                          </a>
                           <button class="btn btn-outline-info col" type="submit">
                            <i class="fas fa-cloud-upload-alt"> Lưu</i>
                          </button>
                          <a class="btn btn-outline-info col" href="{{URL::to('/yeucaukhachhang/'.$datanew->makhachhang)}}">
                            <i class="fas fa-cart-plus" > Tạo Yêu Cầu</i>
                          </a>
                          <button type="button" class="btn btn-outline-info col" data-toggle="modal" data-target="#exampleModal">
                            <i class="fas fa-times-circle" > Xóa</i>
                          </button>
                            
                         
                        </div>
                        
                </div>
              </div>
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Xóa thông tin khách hàng khỏi danh sách</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-footer text-center">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a class="btn btn-info " href="{{URL::to('/deletecompany/'.$datanew->makhachhang)}}">Xác nhận</a>
      </div>
    </div>
  </div>
</div>


              <!-- /.card-header -->
              <div class="card-body">



                     <div class="card-body">
                    <div class="row">
                      <div class="col-12 row form-check-inline">
                        
                      <div class="col-12 text-center" onchange="luachonkhachhang()" hidden>
                        <div class="form-check form-check-inline">
                          <label for="">Lựa chọn loại khách hàng: </label>
                          <input type="text" hidden id="loai_khachhang" value="{{$datanew->loaikhachhang}}">
                        </div>
                        
                        <div class="form-check form-check-inline" >
                          <input class="form-check-input" type="radio" name="loaikhachhang" id="khachhangdoanhnghiep" value="1">
                          <label class="form-check-label" for="inlineRadio2">Khách hàng doanh nghiệp</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="loaikhachhang" id="khachhangcanhan"  value="0">
                          <label class="form-check-label" for="inlineRadio1">Khách hàng cá nhân</label>
                        </div>
                      </div>
                      </div>
                    </div>
                    <div class="row">
                        <div class="col-2 inline">
                          <i class="fas fa-id-badge"> Mã Khách Hàng</i>
                          <input type="text" id="makhachhang" name="makhachhang" value="{{$datanew->makhachhang}}" class="form-control" readonly>
                          </div>
                        <div class="col-2">
                          <i class="fas fa-percentage"> Mã số thuế</i>
                          <input type="text" class="form-control" id="masothue" name="masothue" value="{{$datanew->masothue}}">
                        </div>
                        <div class="col-8">
                          <i class="fas fa-building"> Tên công ty</i>
                          <input type="text" class="form-control" id="tencongty" name="tencongty" value="{{$datanew->tencongty}}">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                      <div class="col">
                        <i class="fas fa-user-tag"> Đại diện:</i>
                        <input type="text" class="form-control" id="daidien" name="daidien" value="{{$datanew->daidien}}" >
                      </div>
                       <div class="col">
                        <i class="fas fa-phone-alt"> Điện Thoại:</i>
                        <input type="text" class="form-control" id="dienthoai" name='dienthoai' value="{{$datanew->dienthoai}}">
                      </div>
                      <div class="col">
                        <i class="far fa-envelope"> Email:</i>
                        <input type="email" class="form-control" id="email" name="email" value="{{$datanew->email}}">
                      </div>
                    </div>
                    <div class="row">
                       <div class="col">
                        <i class="fas fa-map-marker-alt"> Địa chỉ:</i>
                        <input type="text" class="form-control" id="diachi" name="diachi" value="{{$datanew->diachi}}">
                      </div>
                    </div>
                    <br>
              </div>
                  </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
                    @endforeach


            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>

<section class="content" >
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header row">
                <div class="col"><h4> <i class="fas fa-list-ol"> Lịch sử yêu cầu </i></h4></div>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <table class="table table-bordered table-hover" id="table_lichsudonhang">
                    <thead class="thead-light">
                      <tr>
                        <th><i class="fa fa-calendar" aria-hidden="true"> Ngày tạo</i></th>
                        <th>Đặt hàng</th>
                        <th>Giao hàng</th>
                        <th>Tình trạng</th>
                        <th>#</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($data_danhsachyeucau as $data)
                      <tr>
                        <td>{{\Carbon\Carbon::parse($data->created_at)->format('d/m/Y')}}</td>
                        <td>
                         <?php 
                            $i = 1;
                            $thongtinthietbi = array(json_decode($data->thongtinthietbi, true));
                            $thongtinthietbi = $thongtinthietbi[0];
                            $gioihan = $thongtinthietbi['gioihan']+1;
                            for ($i=1; $i < $gioihan; $i++) { 
                              echo $loaithietbi = $thongtinthietbi[$i]['loaithietbi'.$i].' - Số lượng: '. $thongtinthietbi[$i]['soluong'.$i].'<br>';}
                           if ($data->ghichu){ ?>
                            <p style="background: yellow;">Lưu ý: {{$data->ghichu}} </p>
                          <?php  } ?>
                        </td>
                        <td>Giao ngày: <b>{{\Carbon\Carbon::parse($data->thoigiangiaomay)->format('d/m/Y')}}</b><br>Tại: {{$data->diachi}}</td>
                        <td class="text-center">
<?php 
if($data->tinhtrang == 1000){echo 'Đã hoàn thành <br> Hàng đã nhập kho';}
else{if(strtotime($data->ngay_ketthuc)==0){echo 'Đơn hàng chưa giao';}
  else{
$tinhtrang = (strtotime($data->ngay_ketthuc) - strtotime(today()))/86400;  
if ($tinhtrang > 7) {echo '<div class="text-center align-middle" style="color:blue">Đang sử dụng <br>(Còn '.$tinhtrang.' ngày)</div>';}
else{
  if($tinhtrang > 0){echo '<div class="text-center align-middle table-info text-warning" >Sắp hết hạn <br>(Còn '.$tinhtrang.' ngày)</div>';}
  else{
    if($tinhtrang == 0){echo '<div class="text-center align-middle table-danger font-weight-bold" >Hết hạn<br>Đang liên hệ thu hồi máy</div>';}
    else{
      echo '<div class="text-center table-warning align-middle font-weight-bold">Đang thu hồi<br>Quá hạn '. intval($tinhtrang*(-1)).' ngày';
    }
  }
}}}

?>                     
                        </td>
                        <td><a class="btn btn-outline-info" href="{{URL::to('/chitietdonhang/'.$data->id_yeucau)}}"><i class="fas fa-edit"></i></a></td>
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




<style>
  #example {
    text-align: center;  }
</style>


@endsection
@section('js')
<script>
$( "#khachhang" ).addClass('active');
$( "#tag_khachhang" ).addClass('menu-open');
$( "#thongtinkhachhang" ).addClass('active');
$( "#thongtinkhachhang" ).prop('hidden',false);
if (document.getElementById('loai_khachhang').value == 0) {
  $("#masothue").prop('readonly',true);
  $("#tencongty").prop('readonly',true);
  $("#khachhangcanhan").prop('checked',true);

}else{
  $("#khachhangdoanhnghiep").prop('checked',true);


}
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
$(document).ready( function () {
    $('#table_lichsudonhang').DataTable({
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
       "order": [[ 1, "desc" ]],
    });});


</script>
@endsection
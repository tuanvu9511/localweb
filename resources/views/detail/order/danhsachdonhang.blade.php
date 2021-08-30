@extends('layout.master')
@section('content')
    <br>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header row">
                <div class="col"><h5 class=""><i class="fas fa-list-ol"> DANH SÁCH ĐƠN HÀNG ĐANG HOẠT ĐỘNG</i></h5></div>
                <div class="col text-right">
                  <a href="{{URL::to('lichsudonhang')}}" class="btn btn-outline-info">Lịch sử đơn hàng</a>
                </div>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="dataorder" class="table table-bordered table-hover">
                  <thead class="thead-light">
                  <tr class="text-center">
                    <th style="width: 30px">Mã đơn</th>
                    <td hidden>ss</td>
                    <th style="width: 80px;">Ngày Giao</th>
                    <th style="width: 180px;">Khách Hàng</th>
                    <th style="width: 360px;">Liên hệ</th>
                    <td hidden>ss</td>
                    <th style="width: 80px;">Ngày Trả</th>
                    <th style="width: 20px;" hidden>Sắp xếp</th>
                    <th style="width: 120px;">Tình trạng</th>
                    <th hidden></th>
                    <th style="width: 20px;"></th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($data_donhang as $data1)
                    <?php $tinhtrang = (strtotime($data1->ngay_ketthuc) - strtotime(today()))/86400;   ?>
                    <tr onclick="abc()">
                      <td>{{$data1->id_yeucau}}</td>
                    	<td  class="text-center" data-type="date">{{\Carbon\Carbon::parse($data1->thuctegiaomay)->format('d/m/Y')}}</td>
                      <td hidden><?php echo strtotime($data1->thuctegiaomay); ?></td>
                    	<td><b>{{$data1->daidien}}</b><br>{{$data1->tencongty}}</td>
                      <td><b>Điện thoại: {{$data1->dienthoai}}</b><br>Địa chỉ: {{$data1->diachi}}</td>
                      <td  class="text-center">{{\Carbon\Carbon::parse($data1->ngay_ketthuc)->format('d/m/Y')}}<br>(Còn {{$tinhtrang}} ngày)</td>
                      <td hidden><?php echo strtotime($data1->ngay_ketthuc); ?></td>
                      <td colspan="1">
                    	
<?php 
if ($tinhtrang > 7) {echo '<button class="btn btn-primary form-control">Đang hoạt động </button>';}
else{
  if($tinhtrang > 0){echo '<button class="btn btn-warning form-control">Sắp hết hạn</button>';}
  else{
    if($tinhtrang == 0){echo '<button class="btn btn-dark form-control">Hết hạn</button>';}
    else{
      echo '<button class="btn btn-danger form-control">Quá hạn</button>';
    }
  }
}

?>                     </td>
  <td hidden><?php echo $tinhtrang ?></td>
                    	<td class="text-center"><a class="btn btn-outline-info" href="{{URL::to('/chitietdonhang/'.$data1->id_yeucau)}}"><i class="fas fa-edit"></i></a></td>
                      <td hidden>{{$data1->updated_at}}</td>
                    </tr>
                    @endforeach
                    
                  </tbody>                  
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->


            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
@endsection

<style>
  .tinhtrang1{
    color: blue;
    text-align: center;
  }
  .tinhtrang2{
    background-color: yellow;
    text-align: center;
  }
  .tinhtrang3{
    text-align: center;
    background-color: red;
    color: yellow;
  }
  .tinhtrang4{
    text-align: center;
    background-color: blue;
    color: white;
  }
</style>




@section('js')


<script>
  
$( "#donhang" ).addClass('active');
$( "#tag_donhang" ).addClass('menu-open');
$( "#danhsachdonhang" ).addClass('active');

$(document).ready( function () {
    $('#dataorder').DataTable({
      "lengthChange": true,
      "searching": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
       "order": [[ 10, "desc" ]],
    });});








</script>
@endsection
@extends('layout.master')
@section('content')
    <br>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header row">
                <div class="col"><h5 class=""><i class="fas fa-list-ol"> Lịch sử đơn hàng đã thực hiện</i></h5></div>
                <div class="col text-right">
                  <a href="{{URL::to('danhsachdonhang')}}" class="btn btn-outline-info">Danh sách đơn hàng</a>
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
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($data_donhang as $data1)
                    <tr onclick="abc()">
                      <td>{{$data1->id_yeucau}}</td>
                    	<td  class="text-center" data-type="date">{{\Carbon\Carbon::parse($data1->thuctegiaomay)->format('d/m/Y')}}</td>
                      <td hidden><?php echo strtotime($data1->thuctegiaomay); ?></td>
                    	<td><b>{{$data1->daidien}}</b><br>{{$data1->tencongty}}</td>
                      <td><b>Điện thoại: {{$data1->dienthoai}}</b><br>Địa chỉ: {{$data1->diachi}}</td>
                      <td  class="text-center">{{\Carbon\Carbon::parse($data1->ngay_ketthuc)->format('d/m/Y')}}</td>
                      <td hidden><?php echo strtotime($data1->ngay_ketthuc); ?></td>
                      <td colspan="1">
                    	
<?php 
$tinhtrang = $data1->tinhtrang;  
if ($tinhtrang == 1000) {echo '<button type="button" class="btn btn-info form-control">Đã hoàn thành</button>';}
elseif($tinhtrang == 10){echo '<button type="button" class="btn btn-dark form-control">Đơn hàng hủy</button>';}
else{echo '<button type="button" class="btn btn-warning form-control">Đang hoạt động</button>';}

?>                     </td>
  <td hidden><?php echo $tinhtrang ?></td>
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
       "order": [[ 1, "desc" ]],
    });});








</script>
@endsection
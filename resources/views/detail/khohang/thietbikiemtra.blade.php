@extends('layout.master')
@section('content')

<br>
<section class="content">
  <div class="container-fluid">
  <div class="row">
  <div class="col-10 offset-1">
  <div class="card">
  <div class="card-header row">
  <div class="col"><h5 class=""><i class="fas fa-list"> Kiểm tra thiết bị </i></h5></div>
  <div class="col text-right"  id="btn12"><button class="btn btn-info" onclick="window.history.back()" >Quay lại</button></div>
  <p id="test"></p>

  </div>
  <!-- /.card-header -->
    <div class="card-body row">
      <div class=" col-12">
      <div class="col-12"><h5>
        <table class="table">
          <tbody>
          @foreach($thongtintonkho as $dt)
            <tr><td>Thiết bị: </td><td><b>{{$dt->tenloaimay}} {{$dt->tenhang}}  ({{$dt->tencauhinh}})</b></td></tr>
            <tr><td>Chủ sở hữu: </td><td><b>{{$dt->tenchusohuu}}</b></td></tr>
            <tr><td>Số lượng tồn kho: </td><td><b>{{$dt->soluong}}</b> (Chiếc)</td></tr>
            <tr><td>Tổng số lượng máy nhập: </td><td><b>...</b> (Chiếc)</td></tr>
            <tr><td>Số lượng máy xuất bán: </td><td><b>...</b> (Chiếc)</td></tr>
          @endforeach

        </tbody>
        </table>
        </h5>
      </div>
      <br>
      </div>
    </div>
  </div>
  <div class="card">
          <div class="card-header">
              <h5>Thông tin thiết bị trong đơn hàng</h5>
          </div>
          <div class="card-body">
            <table class="table table-bordered" id="table_kiemtra">
            <thead>
            <tr class="text-center">
            <th class="col-1">Mã</th>
            <th class="col-2">Ngày giao máy</th>
            <th class="col-6">Thông tin khách hàng</th>
            <th class="col-2">Ngày hết hạn</th>
            <th class="col-1">SL</th>
            </tr>
            </thead>     
            <tbody>
            @foreach($thongtindonhang as $data)
            <tr>
            <td class="text-center"><a href="{{URL::to('/chitietdonhang/'.$data->id_yeucau)}}">{{$data->id_yeucau}}</a></td>
            <td class="text-center">{{\Carbon\Carbon::parse($data->thuctegiaomay)->format('d/m/Y')}}</td>
            <td>{{$data->tencongty}} - <b>{{$data->daidien}}</b></td>
            <td class="text-center">{{\Carbon\Carbon::parse($data->ngay_ketthuc)->format('d/m/Y')}}</td>
            <td class="text-center">{{$data->soluong}}</td>
            </tr>
            @endforeach    
            </tbody>       
            </table>
          </div>
      </div>
  </div>
  </div>
  </div>
  </div>

</section>

@endsection

@section('js')
<script>
$(document).ready(function(){
    $("#table_kiemtra").DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
    });
  });
</script>  


@endsection
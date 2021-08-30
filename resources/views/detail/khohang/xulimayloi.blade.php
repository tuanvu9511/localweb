@extends('layout.master')
@section('content')
<br>
<form action="{{URL::to('capnhatthietbisua')}}" method="POST">@csrf
<section class="content">
  <div class="container-fluid px-3 row">
    <div class="card col-12">
      <div class="card-header row">
        <div class="col"><h3 class="card-title"> <i class="fas fa-toolbox"> Xử lí thiết bị sửa</i> </h3></div>
        <div class="col text-right">
            <button type="button" class="btn btn-outline-info" onclick="window.history.back()">Quay lại</button>
          <button type="submit" class="btn btn-info">Cập nhật</button></div>
        </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="card-body">
              <table class="table table-bordered" id="table_thietbisua">
                <thead class="thead-light">
                  <tr class="text-center">
                    <th style="width: 3%;">Mã</th>
                    <th class="col-1"><i class="fas fa-calendar"> Xuất</i></th>
                    <th class="col-3"><i class="fas fa-toolbox"> Thông tin thiết bị</i></th>
                    <th class="col-1"><i class="fas fa-user-tag"> Nguồn </i></th>
                    <th class="col-2">Phán đoán lỗi</th>
                    <th class="col-1">Tình trạng </th>
                    <th class="col-1">Đơn vị sửa</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($data as $data4)
                  <input type="number" name="id" value="{{$data4->id}}" hidden>
                  <input type="number" name="hang" value="{{$data4->hang}}" hidden>
                  <input type="number" name="loaimay" value="{{$data4->loaimay}}" hidden>
                  <input type="number" name="cauhinh" value="{{$data4->cauhinh}}" hidden>
                  <input type="number" name="chusohuu" value="{{$data4->chusohuu}}" hidden>
                  <input type="text" name="tendonvisua" value="{{$data4->tendonvisua}}" hidden>
                 <tr>
                    <td class="text-center">{{$data4->id}} </td>
                   <td class="text-center">{{\Carbon\Carbon::parse($data4->created_at)->format('d/m/Y')}}</td>
                   <td><b>{{$data4->tenloaimay}} {{$data4->tenhang}} </b> <br>  ({{$data4->tencauhinh}})</td>
                   <td>{{$data4->tenchusohuu}}</td>
                   <td>{{$data4->chuandoanloi}}</td>
                   <td><?php if($data4->tinhtrang == 1){echo 'Đang sửa';} 
                              elseif($data4->tinhtrang == 2){echo 'Đã sửa xong, chưa lấy về';}
                      ?></td>
                   <td>{{$data4->tendonvisua}}</td>
                 </tr>
                 @endforeach
                </tbody>
              </table>
              <br> 
              <div class="col-12 row">
                <div class="col-3 text-right"><label for=" ">Lỗi thực tế và cách giải quyết</label></div>
                <div class="col-5"><input type="text" name="thucteloi" class="form-control" required></div>
                <div class="col-2 text-right"><label for=" ">Chi phí sửa</label></div>
                <div class="col-2 input-group"><input type="text" class="form-control" name="chiphisua" required><div class="input-group-append"><span class="input-group-text" id="basic-addon2">đ</span></div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>


      </div>
    </div>
  </div>
</section>
</form>
@endsection

@section('js')

@endsection
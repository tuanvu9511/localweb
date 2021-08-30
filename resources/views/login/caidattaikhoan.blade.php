@extends('layout.master')
@section('content')
<br>
<section class="content">
  <div class="container-fluid px-3">
    <div class="card">
      <div class="card-header row">
        <div class="col"><i class="fas fa-users"> Thông tin tài khoản</i> </div>
        <div class="col text-right"><button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModalLong1">
  Đăng kí tài khoản
</button> </div>
        
      </div>
      <div class="card-body">
        <div class="col-10 offset-1">
          <label for=""> Danh sách tài khoản</label>
          <table class="table table-bordered">
            <thead class="thead-light">
              <tr class="text-center">
                <th class="col-1">ID</th>
                <th class="col-3">Họ và tên</th>
                <th class="col-3">Tên tài khoản</th>
                <th class="col-2">Chức Vụ</th>
                <th class="col-2">Ngày bắt đầu</th>
                <th class="col-1">Chi tiết</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data_user as $data)
              <tr>
                <th class="text-center">{{$data->id}}</th>
                <td>{{$data->name}}</td>
                <td>{{$data->email}}</td>
								<td><?php   switch ($data->chucvu) {
	        case "1":
	          echo "Nhân Viên";
	          break;
	        case "2":
	          echo "Kinh Doanh";
	          break;
	        case "3":
	          echo "Kĩ Thuật";
	          break;
	          case "4":
	          echo "Giám Sát";
	          break;
	          case "5":
	          echo "Giám Đốc";
	          break;    }
								     ?></td>
                <td class="text-center">{{\Carbon\Carbon::parse($data->created_at)->format('d/m/Y')}}</td>
                <td class="text-center">
                	<?php if ($data->chucvu	< 4): ?>
                			<a href="{{URL::to('/destroy/'.$data->id)}}"><i class="fas fa-times"></i></a>
                	<?php endif ?>
                	<a href="{{URL::to('/doimatkhau/').$data->id}}"><i class="fas fa-key"></i></a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>
.,<!-- Button trigger modal -->


<!-- Modal -->
<form  action="{{URL::to('/dangkitaikhoan')}}" method="POST">@csrf
<div class="modal fade" id="exampleModalLong1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Đăng kí mới</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body row">
            <div class="form-group col">
              <label for="exampleInputEmail1">Tên nhân viên</label>
              <input type="text" class="form-control" id="tennhanvien" name="tennhanvien"  placeholder="Tên nhân viên">
            </div>
            <div class="form-group col">
              <label for="exampleInputEmail1">Tên đăng nhập</label>
              <input type="email" class="form-control" id="tendangnhap" name="tendangnhap"  placeholder="Đăng nhập">
            </div>
            <div class="form-group col">
              <label for="exampleInputPassword1">Mật khẩu</label>
              <input type="text" class="form-control" id="matkhau" name="matkhau" placeholder="Mât khẩu">
            </div>
            <div class="form-group col">
              <label for="exampleInputPassword1">Chức vụ</label>
              <select name="chucvu" id="chucvu" class="form-control">
                <option value="1">Nhân viên</option>
                <option value="2">Kinh Doanh</option>
                <option value="3">Kĩ thuật</option>
                <option value="4">Giám sát</option>
                <option value="5">Giám Đốc</option>
              </select>
            </div>
            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal">Thoát</button>
        <button type="submit" class="btn btn-info">Đăng kí</button>
      </div>
      </form>
    </div>
  </div>
</div>

@endsection

@section('js')

@endsection
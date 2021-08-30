@extends('layout.master')
@section('content')
<br>
<form action="{{URL::to('xacnhandoimatkhau')}}" method="POST">@csrf

<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-8 offset-2">
            <div class="card">
              <div class="card-header">
                <h4 class=""> Đổi mật khẩu tài khoản - {{session('_tennhanvien')}} </h4>
              </div>
              <!-- /.card-header -->
              <div class="card-body row">
                <div class="col">
                  <label for="">Mật khẩu cũ</label>
                  <input class="form-control " type="text" name="matkhaucu" placeholder="">
                </div>
                <div class="col">
                  <label for="">Mật khẩu mới</label>
                  <input class="form-control " type="password" name="matkhaumoi" placeholder="">
                </div>
                <div class="col">
                  <label for="">Nhập lại mật khẩu mới</label>
                  <input class="form-control " type="password" name="matkhaumoi2" placeholder="">
                </div>
                <br>
                <div class="col-12 mt-3 text-right">
                  <button class="btn btn-primary">Xác nhận</button>
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
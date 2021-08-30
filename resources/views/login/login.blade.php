<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Công ty Bách Khoa 4</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{URL::to('/')}}/admin/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{URL::to('/')}}/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{URL::to('/')}}/admin/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">

<div class="login-box">
  @if ($errors->any())
<div class="alert alert-info col-10 offset-1">
<ul>
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
</ul>
</div>
@endif
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">

    <div class="card-header text-center">
      <a href="/" class="h1"><b>Admin</b>BK4</a>
    </div>

    <div class="card-body">
      <p class="login-box-msg"><span>Tương lai nằm trong tay bạn! <i class="fas fa-fighter-jet"></i></span></p>
      <form action="{{URL::to('check')}}" method="post">
        @csrf
        <div class="input-group mb-3">
          <input type="text" name="email" class="form-control" placeholder="Nhập tên tài khoản">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Mật khẩu">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-6 offset-3">
            <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
          </div>
          
          <!-- /.col -->
        </div>
      </form>

     
      <!-- /.social-auth-links -->

     
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{URL::to('/')}}/admin/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{URL::to('/')}}/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{URL::to('/')}}/admin/dist/js/adminlte.min.js"></script>
</body>
</html>

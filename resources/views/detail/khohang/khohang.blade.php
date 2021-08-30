@extends('layout.master')
@section('content')
<br>
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"> Tổng quan kho hàng </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body row">
                Thông tin thiết bị
                <p>Số lượng thiết bị đang thuê</p>
                <p>Số lượng thiết bị tồn kho</p>
                <p>Lần nhập thiết bị gần nhất</p>
                <p>Lịch sử thay đổi thiết bị</p>
                <p>Vvv...</p>

              </div>

            </div>
       </div>
      </div>
  </div>
</section>

@endsection

@section('js')

<script>
  $("#tag_khohang").addClass('menu-open');
  $("#khohang").addClass('active');
  $("#tongquankhohang").addClass('active');
</script>
@endsection
@extends('layout.master')
@section('content')
<br>
<section class="content">
  <div class="container-fluid row px-3">
    <div class="card col-12">
      <div class="card-header"><h3 class="card-title"> <i class="fas fa-tachometer-alt"> Dashboard </i></h3></div>        <!-- /.card-header -->
      <div class="card-body">
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3>{{$slthangdonhang}} / {{$sltongdonhang}}</h3>

                <p>Đơn hàng mới trong tháng</p>
              </div>
              <div class="icon">
                <i class="fas fa-shopping-cart"></i>
              </div>
              <a href="{{URL::to('danhsachdonhang')}}" class="small-box-footer">
                Xem thêm <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$slthangkhach}} / {{$sltongkhach}}</h3>

                <p>Khách hàng mới trong tháng</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-plus"></i>
              </div>
              <a href="{{URL::to('viewcustumer')}}" class="small-box-footer">
                Xem thêm <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$sldhketthuc}}</h3>

                <p>Đơn hàng kết thúc</p>
              </div>
              <div class="icon">
                <i class="fas fa-chart-pie"></i>
              </div>
              <a href="{{URL::to('lichsudonhang')}}" class="small-box-footer">
                Xem thêm <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{$slthangloi}}</h3>

                <p>Báo Lỗi thiết bị</p>
              </div>
              <div class="icon">
                <i class="fas fa-bug"></i>
              </div>
              <a href="#" class="small-box-footer">
                Xem thêm <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
        </div><!--end card body-->
      </div>
    </div>
  </div>
</section>


<section class="content">
  <div class="container-fluid row px-3">
    <div class="card col-12">
      <div class="card-header"><i class="fas fa-warehouse"> Thiết bị</i></div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fas fa-laptop"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Laptop</span>
                <span class="info-box-number"><h4>{{$sllaptop}} (Máy)</h4></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Case PC</span>
                <span class="info-box-number"><h4>{{$slpc}} (Máy)</h4></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Màn hình</span>
                <span class="info-box-number"><h4>{{$slmanhinh}} (Chiếc)</h4></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-danger"><i class="far fa-star"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Thiết bị lỗi đang sửa</span>
                <span class="info-box-number"><h4>{{$soluonghong}} (Máy)</h4></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          
          <!-- /.col -->
        </div>


      </div>
    </div>
  </div>
</section>




@endsection

@section('js')
<script>
  $("#tongquan").addClass('active');
</script>
@endsection
        




        <!-- end 1 -->
        

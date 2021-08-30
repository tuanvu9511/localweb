@extends('layout.master')
@section('content')

    <br>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-10 offset-1">
            <form method="POST" action="{{URL::to('/post_addcompany')}}"> @csrf
            <div class="card">
              <div class="card-header row">
                
                <div class="col"><h3 class="card-title"><i class="fas fa-users-cog"> Thêm Khách Hàng</i></h3></div>
                <div class="col text-right">
                  <button class="btn btn-outline-primary" type="submit">Thêm Mới</button></div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                    <div class="row">
                      <div class="col-12 row form-check-inline">
                        
                      <div class="col-10 offset-1 text-center" onchange="luachonkhachhang()">
                        <div class="form-check form-check-inline">
                          <label for="">Lựa chọn loại khách hàng: </label>
                        </div>
                        
                        <div class="form-check form-check-inline" >
                          <input class="form-check-input" type="radio" name="loaikhachhang" checked id="khachhangdoanhnghiep" value="1">
                          <label class="form-check-label" for="inlineRadio2">Khách hàng doanh nghiệp</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="loaikhachhang" id="khachhangcanhan"  value="0">
                          <label class="form-check-label" for="inlineRadio1">Khách hàng cá nhân</label>
                        </div>
                      </div>
                      </div>
                    </div>
                    <div class="row col-12">
                      <div class="col-2 inline">
                        <i class="fas fa-id-badge"> Mã Khách Hàng</i>
                        <input type="text" id="makhachhang" name="makhachhang" value="{{ $idmax }}" class="form-control" disabled>
                        </div>
                      <div class="col-2">
                        Mã số thuế
                        <input type="text" class="form-control" id="masothue" name="masothue" placeholder="">
                      </div>
                      <div class="col-8">
                        Tên công ty
                        <input type="text" class="form-control" id="tencongty" name="tencongty" placeholder="">
                      </div>
                    </div>
                    <br>
                    <div class="row">
                      <div class="col">
                        Đại diện:
                        <input type="text" class="form-control" id="daidien" name="daidien" placeholder="">
                      </div>
                       <div class="col">
                        Điện Thoại:
                        <input type="text" class="form-control" id="dienthoai" name='dienthoai' placeholder="">
                      </div>
                      <div class="col">
                        Email:
                        <input type="email" class="form-control" id="email" name="email" placeholder="">
                      </div>
                    </div>
                    <div class="row">
                       <div class="col">
                        Địa chỉ:
                        <input type="text" class="form-control" id="diachi" name="diachi" placeholder="">
                      </div>
                    </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            </form>


            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
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
$( "#themkhachhang" ).addClass('active');
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
</script>
@endsection
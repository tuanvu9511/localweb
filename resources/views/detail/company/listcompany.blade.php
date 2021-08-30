@extends('layout.master')
@section('content')
<br>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header row">
                <div class="col"><h3><i class="fas fa-list-ol"> Danh sách khách hàng</i></h3></div>
                <div class="col text-right">
                  <button id="myBtn" class="btn btn-outline-info"><i class="fas fa-plus"> Tạo mới</i></button>
                </div>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="datacompany" class="table table-bordered table-hover w-100 ">
                  <thead class="thead-light">
                  <tr class="text-center">
                    <th style="width: 4%;">#</th>
                    <th>Công ty/ Đại diện</th>
                    <th>Điện thoại</th>
                    <th>Email</th>
                    <th>Địa chỉ lắp/giao</th>
                    <th hidden>ss GD</th>
                    <th>GD Cuối</th>
                    <th style="width:3%">Func.</th>
                  </tr>
                  </thead>
                  <tbody>
                    
                    @foreach ($data_company as $data)
                    <tr>                    
                      <td class="text-center">{{ $data->makhachhang }}</td>
                      <td><b>{{ $data->tencongty }}</b><br>{{ $data->daidien }}</td>
                      <td>{{ $data->dienthoai }}</td>
                      <td>{{ $data->email }}</td>
                      <td>{{ $data->diachi }}</td>
                      <th class="text-center">{{\Carbon\Carbon::parse($data->giaodichcuoi)->format('d/m/Y')}}</th>
                      <th hidden><?php echo strtotime($data->giaodichcuoi) ?></th>
                      <td class="text-center"><a class="btn" href="{{URL::to('/editcompany/'.$data->makhachhang)}}"><i class="fas fa-users-cog"></i></a></td>
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

<!-- The Modal -->
<div id="myModal" class="modal">
  <div class="modal-content row">
    <div class="right"><span class="close"><i class="far fa-times-circle"></i></span></div>
    <form method="POST" action="{{URL::to('/post_addcompany')}}"> @csrf
    <div class="left row col-12">
      <div class="col-12 row">
        <div class="col-12">

          <div class="row">
            <div class="col-12 text-right" onchange="luachonkhachhang()">
              <div class="form-check form-check-inline">
                <label for="">Lựa chọn loại khách hàng: </label>
              </div>
              <div class="form-check form-check-inline" >
                <input class="form-check-input" type="radio" name="loaikhachhang" checked id="khachhangdoanhnghiep" value="1">
                <label class="form-check-label" for="inlineRadio2"><i class="fas fa-industry"> Doanh nghiệp</i></label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="loaikhachhang" id="khachhangcanhan"  value="0">
                <label class="form-check-label" for="inlineRadio1"><i class="fas fa-user"> Cá nhân</i></label>
              </div>
            </div>
          </div>

        </div>
      </div>
               <br>

      <div class="col-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                    
                    <div class="row">
                      <div class="col-2 inline">
                        <i class="fas fa-id-badge"> Mã KH</i>
                        <input type="text" id="makhachhang" name="makhachhang" value="{{$idmax}}" class="form-control" disabled>
                        </div>
                      <div class="col-3">
                        <i class="fas fa-percentage"> Mã số thuế</i>
                        <input type="text" class="form-control" id="masothue" name="masothue" placeholder="" required>
                      </div>
                      <div class="col-7">
                        <i class="fas fa-building"> Tên công ty</i>
                        <input type="text" class="form-control" id="tencongty" name="tencongty" placeholder="" required>
                      </div>
                    </div>
                    <br>
                    <div class="row">
                      <div class="col">
                        <i class="fas fa-user-tag"> Đại diện:</i>
                        <input type="text" class="form-control" id="daidien" name="daidien" placeholder="" required>
                      </div>
                       <div class="col">
                        <i class="fas fa-phone-alt"> Điện Thoại:</i>
                        <input type="text" class="form-control" id="dienthoai" name='dienthoai' placeholder="" required>
                      </div>
                      <div class="col">
                        <i class="far fa-envelope"> Email:</i>
                        <input type="email" class="form-control" id="email" name="email" placeholder="" >
                      </div>
                    </div>
                    <div class="row">
                       <div class="col">
                        <i class="fas fa-map-marker-alt"> Địa chỉ:</i>
                        <input type="text" class="form-control" id="diachi" name="diachi" placeholder="" >
                      </div>
                    </div>
                    <br>
                    <div class="row">
                      <div class="col-12 text-center">
                        <button class="btn btn-info" type="submit"><i class="fas fa-folder-plus"> Thêm Mới</i></button>
                      </div>
                    </div>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            </form>
            <!-- /.card -->
          </div>
    </div>
    
  </div>
</div>

<style>
  /* The Modal (background) */
.myModal {
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 5% auto; /* 15% from the top and centered */
  padding: 20px;
  border: 1px solid #888;
  width: 60%; /* Could be more or less, depending on screen size */
}

/* The Close Button */
.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}
</style>
@endsection
@section('js')

<script>
var modal = document.getElementById("myModal");
var btn = document.getElementById("myBtn");
var span = document.getElementsByClassName("close")[0];
btn.onclick = function() {modal.style.display = "block";}
span.onclick = function() {modal.style.display = "none";}
window.onclick = function(event) {if(event.target == modal){modal.style.display = "none";}}
$( "#khachhang").addClass('active');
$( "#tag_khachhang" ).addClass('menu-open');
$( "#danhsachkhachhang" ).addClass('active');



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
}



$(document).ready( function () {
    $('#datacompany').DataTable({
      "paging": true,
      "searching": true,
      "ordering": true,
      "info": false,
      "autoWidth": false,
      "responsive": true,
    });
} );

</script>
@endsection
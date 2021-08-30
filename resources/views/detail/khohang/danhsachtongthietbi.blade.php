@extends('layout.master')
@section('content')
<br>
@if ($errors->any())
    <div class="alert alert-info">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header row">
                <div class="col">
                  <h4><i class="fas fa-list-ol"> Thiết bị tồn kho </i></h4>
                  <span><i>  (Bao gồm thiết bị đang sẵn sàng cho thuê tại trong kho)</i></span>
                </div>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="col-12 tag_bangnoidung">
                  <table class="table table-bordered table-hover" id="table_danhsachtongthietbi">
                    <thead class="thead-light">
                      <tr class="text-center">
                        <th class="col-2"><i class="fas fa-toolbox"> Chủng Loại</i></th>
                        <th class="col-2"><i class="fas fa-server"> Hãng/Model</i></th>
                        <th class="col-4"><i class="fas fa-server"> Cấu hình</i></th>
                        <th class="col-2"><i class="fas fa-user-tag"> Chủ sử hữu </i></th>
                        <th class="col-2"><i class="fas fa-signal"> Số lượng</i></th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($data_danhsachtongthietbi as $data)
                      <tr class="text-center">
                        <td>{{$data->tenloaimay}}</td>
                        <td>{{$data->tenhang}}</td>
                        <td>{{$data->tencauhinh}}</td>
                        <td>{{$data->tenchusohuu}}</td>
                        <td>{{$data->soluong}} Chiếc</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header row">
              <div class="col input-group">
                <h4> <i class="fas fa-tools"> Thiết Bị Sửa</i> </h4><span> <a href="{{URL::to('lichsusuamay')}}">(Lịch sử)</a></span>
              </div>
              <div class="col text-right">
                 <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#exampleModalLong">
                    <i class="fas fa-plus"> Xuất thiết bị sửa</i>
                  </button>
              </div>  
              
            </div>
            <div class="card-body">
              <table class="table table-bordered" id="table_thietbisua">
                <thead class="thead-light">
                  <tr class="text-center">
                    <th style="width: 3%;">Mã</th>
                    <th class="col-1"><i class="fas fa-calendar"> Xuất</i></th>
                    <th class="col-3"><i class="fas fa-toolbox"> Thông tin thiết bị</i></th>
                    <th class="col-1"><i class="fas fa-user-tag"> Nguồn </i></th>
                    <th class="col-2">Tình trạng lỗi</th>
                    <th class="col-1">Tình trạng </th>
                    <th class="col-1">Đơn vị sửa</th>
                    <th style="width: 3%;"><i class="fas fa-cogs"></i></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($data_danhsachthietbisua as $data4)
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
                   <td class="text-center">
                    <a class="btn btn-outline-info" href="{{URL::to('/xulimayloi/'.$data4->id)}}">
                      <i class="fas fa-arrow-alt-circle-right"></i>
                    </a>
                   </td>
                 </tr>
                 @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
<!-- Button trigger modal -->

<section class="content">
  <div class="container-fluid">
  <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4 class=""><i class="fas fa-history"> Lịch sử xuất nhập kho</i></h4>
            </div>
            <div class="card-body">
              <table class="table table-bordered" id="table_lichsucapnhat">
                <thead class="thead-light">
                  <tr class="text-center">
                    <th class="col-1" hidden>#</th>
                    <th class="col-1">Cập nhật</th>
                    <th class="col-6">Công việc</th>
                    <th class="col-5">Thông tin thiết bị</th>
                  </tr>
                </thead>
                <tbody>
                 @foreach ($data_lichsunhapthietbi as $data2)
                  <tr>
                    <td class="text-center" hidden>{{$data2->id}}</td>
                    <td class="text-center">{{\Carbon\Carbon::parse($data2->created_at)->format('d/m/Y')}}</td>
                    <td>{{$data2->noidungcapnhat}}</td>
                    <td>{{$data2->tenloaimay}} {{$data2->tenhang}} - {{$data2->tenchusohuu}} <br> <b> ({{$data2->tencauhinh}})<p> Số lượng: {{$data2->soluong}} Chiếc</p></b></td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>

<!-- Modal -->
         
<!-- section 2 -->
<section> 
  <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
  <div class="modal-content">
  <div class="modal-header">
  <h5 class="modal-title" id="exampleModalLongTitle"><i class="fas fa-dolly"> Xuất thiết bị sửa</i></h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
  </button>
  </div>
  <form action="{{URL::to('/xuatthietbisua')}}" method="POST">@csrf
  <div class="modal-body" >
    <section class="content">
      <div class="container-fluid">
      <div class="row">
      <div class="col-12">
      <div class="card">
      <div class="card-header row">
        <div class="col-6 offset-3  form-inline">
          <label for="donvisua"><i class="fas fa-biking"> Chọn Đơn vị sửa: </i></label><br>
          <select class="ml-2 w-50 form-control" name="sl_donvisua" id="sl_donvisua">
            <?php echo $option_danhsachdonvisua; ?>
          </select>
           <input class="form-control w-50 ml-2" type="text" hidden name="ip_donvisua" id="ip_donvisua" placeholder="Nhập tên đơn vị sửa mới" >
           <input type="number" name="loaidonvisua" value="0" id="loaidonvisua" hidden>
          <input class="ml-4" type="checkbox" onchange="chondonvisua()" value="0" name="moi_donvisua" id="moi_donvisua"> 
          <label class="ml-2">Tạo mới</label>
        </div>
      </div>
      <!-- /.card-header -->
   
      <input type="text" name="dichchuyen" value="2" hidden>        
      <div class="card-body row">
      <table class="table table-bordered">
      <thead class="thead-light">
      <tr>
        <th class="col-2"><i class="fas fa-toolbox"> Chủng Loại</th>
        <th class="col-2"><i class="fas fa-server"> Hãng/Model</i></th>
        <th class="col-4"><i class="fas fa-server"> Cấu hình</i></th>
        <th class="col-2"><i class="fas fa-user-tag"> Chủ sử hữu </i></th>
        <th style="width:10%"><i class="fas fa-signal"> Số lượng</i></th>
      </tr>
      </thead>
      <tbody>
      <tr onchange="laysoluongton()">
        <td>
          <select name="sl_loaimay" id="sl_loaimay" onchange="chonhang_select()"  class="form-control"><?php echo $option_loaimay;  ?></select>
        </td>
        <td>
          <select name="sl_hang" id="sl_hang" onchange="choncauhinh_select()"  class="form-control"></select>
        </td>
        <td>
          <select name="sl_cauhinh" id="sl_cauhinh"  class="form-control"></select>
        </td>
        <td>
          <select name="sl_chusohuu" id="sl_chusohuu" class="form-control"><?php echo $option_chusohuu ?></select>
        </td>
        <td><input type="number" name="soluong" id="soluong" readonly class="form-control" value="1" required></td>
        
      </tr>
      <tr>
        <td class="text-right">
            <label for="">Phán đoán lỗi</label>
          
        </td>
        <td colspan="1">
            <input type="text" class="form-control" id="chuandoanloi_1" name="chuandoanloi_1" required placeholder="SerialNumber">
        </td>
        <td colspan="1">
            <input type="text" class="form-control" id="chuandoanloi_1" name="chuandoanloi_2" required placeholder="Tình trạng">
        </td>
        <td>Số lượng tồn trong kho</td>
        <td><input type="number" name="soluongton" id="soluongton" min="1" readonly class="form-control" min="0"></td>
      </tr>
      <tr>
        <td colspan="5" class="text-center">
          <button class="btn btn-info" type="submit">Xuất</button>
        </td>
      </tr>
      </tbody>
      </table>
      </div>
      </form>
      </div>
      </div>
      </div>
      </div>
    </section>
  </div>
  </div>
  </div>
  </div>
</section>
<!-- end section 2 -->






@endsection

@section('js')

<script>
  $("#tag_khohang").addClass('menu-open');
  $("#khohang").addClass('active');
  $("#danhsachtongthietbi").addClass('active');


$(document).ready( function () {
    $('#table_danhsachtongthietbi').DataTable({
      "paging": false,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });});

$(document).ready( function () {
    $("#table_lichsucapnhat").DataTable({
      "responsive": true,
       "lengthChange": false,
        "autoWidth": false,
       "order": [[ 0, "desc" ]],
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#table_lichsucapnhat_wrapper .col-md-6:eq(0)');
  });



$(document).ready( function () {
    $('#table_thietbisua').DataTable({
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
       "order": [[ 1, "desc" ]],
    });});

function chonhang_select(){
  var id_chungloaiselect = document.getElementById('sl_loaimay').value;
  $("#sl_hang").html('');
  $.ajax({
    url: "{{URL::to('/layhang')}}", //url xử lí data
    type: "POST", //kiểu đưa dữ liệu lên
    data: {
        idtruyenvao: id_chungloaiselect, //khai báo dữ liệu đưa vào
        _token: '{{csrf_token()}}' //token để sử dụng với hàm post
    },
    dataType: 'json', //Kiểu dữ liệu trả về
    success: function (result) { //Nếu dữ liệu trả về ok thì sẽ chạy tiếp ở đây
        $('#sl_hang').html('<option hidden>Chọn Loại</option>');
        $.each(result.layhang, function (key, value) {
            $('#sl_hang').append('<option value="' + value.id + '">' + value.tenhang + '</option>');
        });
    }
   });
};


function  choncauhinh_select(){
  var id_hang = document.getElementById('sl_hang').value; //Lấy dữ liệu country
  $("#sl_cauhinh").html('<option hidden>Chọn Loại</option>'); //Khai báo tỉnh với giá trị mặc định là null
  $.ajax({
    url: "{{URL::to('/laycauhinh')}}", //url xử lí data
    type: "POST", //kiểu đưa dữ liệu lên
    data: {
        idtruyenvao: id_hang, //khai báo dữ liệu đưa vào
        _token: '{{csrf_token()}}' //token để sử dụng với hàm post
    },
    dataType: 'json', //Kiểu dữ liệu trả về
    success: function (result) { //Nếu dữ liệu trả về ok thì sẽ chạy tiếp ở đây
        $('#sl_cauhinh').html('<option hidden>Chọn Loại</option>');
        $.each(result.cauhinh, function (key, value) {
            $("#sl_cauhinh").append('<option value="' + value.id + '">' + value.tencauhinh + '</option>');
        });
    }
   });
}; 

function  laysoluongton(){
  var a = document.getElementById('sl_loaimay').value;
  var b = document.getElementById('sl_hang').value;
  var c = document.getElementById('sl_cauhinh').value;
  var d = document.getElementById('sl_chusohuu').value;
  var id_soluongton = a+b+c+d; //Lấy dữ liệu country
  $("#soluongton").prop("value",''); //Khai báo tỉnh với giá trị mặc định là null
  $.ajax({
    url: "{{URL::to('/laysoluongton')}}", //url xử lí data
    type: "POST", //kiểu đưa dữ liệu lên
    data: {
        idtruyenvao: id_soluongton, //khai báo dữ liệu đưa vào
        _token: '{{csrf_token()}}' //token để sử dụng với hàm post
    },
    dataType: 'json', //Kiểu dữ liệu trả về
    success: function (result) { //Nếu dữ liệu trả về ok thì sẽ chạy tiếp ở đây
        $.each(result.soluongton, function (key, value) {
            $("#soluongton").prop('value',value.soluong);
        });
    }
   });
};  

 function  chondonvisua(){
    var a = document.getElementById('moi_donvisua');
    if (a.checked) 
    {
      $('#sl_donvisua').prop('hidden',true);
      $('#ip_donvisua').prop('hidden',false);
      $('#loaidonvisua').prop('value','1');
    }else{
      $('#sl_donvisua').prop('hidden',false);
      $('#ip_donvisua').prop('hidden',true);
      $('#loaidonvisua').prop('value','0');
    }
  }


</script>
@endsection
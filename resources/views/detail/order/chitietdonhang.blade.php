@extends('layout.master')
@section('content')

@foreach ($data_yeucau as $data)
<?php 
$option_donvithoigian = "";
        $thoigian = array('Ngày', 'Tuần', 'Tháng','Năm');
        for ($i=0; $i < 4 ; $i++) { 
          $option_donvithoigian .= '<option value="'.$thoigian[$i].'"">'.$thoigian[$i].'</option>';
        };  
$loaimay='<option value="" hidden>Chọn</option>';
foreach ($datachungloai as $data2){
  $loaimay .= '<option value="'.$data2->id.'">'.$data2->tenloaimay.'</option>';
};
$option_chusohuu='';
foreach ($chusohuu as $data3){
  $option_chusohuu .= '<option value="'.$data3->id.'">'.$data3->tenchusohuu.'</option>';
};
 ?>
<br>
<section class="content">
  <div class="container-fluid">
  <div>
@foreach($data_yeucau as $dulieu)
      <?php if ($dulieu->tinhtrang == 2){ ?>
    <div class="btn-group col-10 offset-1">
      <a href="{{URL::to('danhsachdonhang')}}" class="btn btn-outline-dark w-100"><i class="fas fa-arrow-left"> Quay lại</i></a>
      <button type="button" class="btn btn-outline-dark w-100" data-toggle="modal" data-target="#exampleModalLong5">
       <i class="fa fa-bug"> Báo lỗi</i>
      </button>
      <button type="button" class="btn btn-outline-dark w-100" data-toggle="modal" data-target="#exampleModalLong4"><i class="fas fa-exchange-alt"> Thay đổi máy</i></button>
       <button type="button" class="btn btn-outline-dark w-100" data-toggle="modal" data-target="#exampleModalLong2"><i class="fas fa-tape"> Gia hạn</i></button>
      <button type="button" class="btn btn-outline-dark w-100" data-toggle="modal" data-target="#exampleModalLong3">
       <i class="far fa-sticky-note"> Ghi Chú</i>
      </button>
      <button type="button" class="btn btn-outline-dark w-100" data-toggle="modal" data-target="#exampleModalLong1">
        <i class="fas fa-times"> Hủy Đơn</i>
      </button>
      <button type="button" class="btn btn-outline-dark w-100" data-toggle="modal" data-target="#exampleModalLong6">
          <i class="fas fa-check"> Kết thúc</i>
      </button>
    </div>
      <?php }else{ ?>
        <div class="col-10 offset-1 text-right">
          <button class="btn btn-outline-info" onclick="window.history.back()">Quay lại</button>
        </div>
      <?php } ?>
@endforeach
  </div>
<br>

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModalLong6" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-ml" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Xác nhận kết thúc</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p> <b>Đơn hàng đã hoàn thành! </b></p>
        <p> Khách hàng đã trả máy, thanh toán</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn light" data-dismiss="modal">Đóng</button>
        <a href="{{URL::to('/ketthucdonhang/'.$data->id_yeucau)}}" class="btn btn-info">Xác nhận</a>
      </div>
    </div>
  </div>
</div>



<!-- Modal -->
<div class="modal fade" id="exampleModalLong4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Bổ sung/cập nhật thiết bị</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">
        <form action="{{URL::to('/thaydoithietbi')}}" method="POST">@csrf
        <input type="text" name="id_yeucau" value="<?php echo $data->id_yeucau; ?>" hidden>
        <div class="col-12" id="1" >
        <div class="card">
        <div class="card-header row"> 
        <div class="card-title row col-12">
        <div class="col-6"><h5><i class="fa fa-book"> Số lượng thiết bị hiện tại</i></h5></div>
        <div class="col-6 row">
        <div class="col"><input class="float-left" id="check_ntb" onchange="ntb(this)" type="checkbox"> <label for="check_ntb">Nhận lại thiết bị</label></div>
        <div class="col"><input class="float-left" id="check_xtb" onchange="xtb(this)" type="checkbox"><label for="check_xtb">Xuất thêm thiết bị</label></div>
        </div>
        </div>
        </div>
        <div class="card-body">
        <div class="row">
        <div class="col-12">
        <table class="table table-hover table-bordered" id="table_thietbibangiao">
        <thead class="thead-light">
        <tr>
        <th width="2%" >
        <th width="10%">Chủng loại</th>
        <th width="10%">Hãng</th>
        <th width="20%">Cấu hình</th>
        <th width="10%">Chủ sở hữu</th>
        <th width="10%">Số lượng</th>
        </tr>
        </thead>
        <tbody>
        <?php $i=1 ?>
        @foreach ($data_donhang as $data)
        <tr>
        <td>{{$i}}</td>
        <td>{{$data->tenloaimay}}</td>
        <td>{{$data->tenhang}}</td>
        <td>({{$data->tencauhinh}})</td>
        <td>{{$data->tenchusohuu}}</td>
        <td>{{$data->soluong}}</td>
        </tr>
        <?php $i = $i +1 ?>
        @endforeach
        </tbody>
        </table>
        </div>
        </div>
        </div>

        </div><!--end card so luong thiet bi hien tai-->

        <div class="container-fluid" id="2" >
        <div class="row nhanthietbi" id="nhanthietbi" hidden>
        <div class="card col-12">
        <input type="number" name="thietbihong" id="thietbihong" value="0" hidden>
        <div class="card-body">
        <h5>Nhận lại thiết bị (Nhập Kho)</i></h5>
        <table class="table table-bordered" id="table_nhanthietbi">
        <thead class="thead-light">
        <tr>
        <th width="2%" >
        <a onclick="themdong3()"><i class="fas fa-plus"></i></a><br>
        <a onclick="xoadong3()"><i class="fa fa-minus"></i></a>
        <input type="number" id="sltb_nhan" name="sltb_nhan" value="1" hidden>
        </th>
        <th width="10%">Chủng loại</th>
        <th width="10%">Hãng</th>
        <th width="20%">Cấu hình</th>
        <th width="10%">Chủ sở hữu</th>
        <th width="10%">Số lượng</th>
        </tr>
        </thead>
        <tbody>
        <tr>
        <td><div>1</div></td>
        <td><select onchange="chonhang_nhap(1)" id="chungloai_nhap1" name="chungloai_nhap1"><?php echo $loaimay ?></select></td>
        <td><select onchange="choncauhinh_nhap(1)" id="hang_nhap1" name="hang_nhap1"></select></td>
        <td><select name="cauhinh_nhap1" id="cauhinh_nhap1"></select></td>
        <td><select name="chusohuu_nhap1"><?php echo $option_chusohuu?></select></td>
        <td><input type="number" name="soluong_nhap1" ></td>
        </tr>
        </tbody>
        </table>
        </div>
        </div>
        </div>

        <div class="row xuatthietbi" id="xuatthietbi" hidden>
        <div class="card col-12">
        <input type="text" name="thietbimoi" id="thietbimoi" value="0" hidden>
        <div class="card-body">
        <h5>Xuất thêm thiết bị (Xuất kho)</h5>
        <table class="table table-bordered" id="table_xuatthietbi">
        <thead class="thead-light">
        <tr>
        <th width="2%" >
        <a onclick="themdong4()"><i class="fas fa-plus"></i></a><br>
        <a onclick="xoadong4()"><i class="fa fa-minus"></i></a>
        <input type="number" id="sltb_xuat" name="sltb_xuat" value="1" hidden>
        </th>
        <th width="10%">Chủng loại</th>
        <th width="10%">Hãng</th>
        <th width="20%">Cấu hình</th>
        <th width="10%">Chủ sở hữu</th>
        <th width="10%">Số lượng</th>
        </tr>
        </thead>
        <tbody>
        <tr>
        <td><div>1</div></td>
        <td><select onchange="chonhang_xuat(1)" id="chungloai_xuat1" name="chungloai_xuat1"><?php echo $loaimay ?></select></td>
        <td><select onchange="choncauhinh_xuat(1)" id="hang_xuat1" name="hang_xuat1"></select></td>
        <td><select name="cauhinh_xuat1" id="cauhinh_xuat1"></select></td>
        <td><select name="chusohuu_xuat1"><?php echo $option_chusohuu?></select></td>
        <td><input type="number" name="soluong_xuat1" ></td>
        </tr>
        </tbody>
        </table>
        </div>
        </div>
        </div>
        </div>

        </div> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal">Đóng</button>
        <button type="submit" class="btn btn-info">Lưu thay đổi</button>
      </form>

      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="exampleModalLong5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Báo Lỗi Thiết Bị</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{URL::to('/capnhatloi/'.$data->id_yeucau)}}" method="POST">
        @csrf
      <div class="modal-body row">
        <div class="col-3">
          <input type="date" readonly class="form-control" value="{{\Carbon\Carbon::parse(today())->format('Y-m-d')}}">
        </div>
        <div class="col-9">
          <input type="text" class="form-control" name="noidungloi" id="noidungloi" placeholder="Thông tin Lỗi">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal">Đóng</button>
        <button type="submit" class="btn btn-info">Cập nhật</button>
      </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="exampleModalLong4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Cập nhật thiết bị đơn hàng</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{URL::to('/giahandonhang/'.$data->id_yeucau)}}" method="POST">
        @csrf
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-info">Xác nhận</button>
      </div>
      </form>
    </div>
  </div>
</div>



<!-- Modal -->




<div class="modal fade" id="exampleModalLong3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Cập nhật thông tin đơn hàng</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{URL::to('/capnhatghichu/'.$data->id_yeucau)}}" method="POST">
        @csrf
      <div class="modal-body">
        <p>Ghi chú</p>
        <textarea  hidden name="ghichu_old" id="ghichu_old" cols="30" rows="10">{{$data->ghichu}}</textarea>
        <div>{{$data->ghichu}}</div>
        <div><textarea name="ghichu_new" id="ghichu_new" class="form-control" class rows="10">{{$data->ghichu}}</textarea></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal">Đóng</button>
        <button type="submit" class="btn btn-info">Lưu</button>
      </div>
      </form>
    </div>
  </div>
</div>




<div class="modal fade" id="exampleModalLong2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">
          <i class="fas fa-anchor"> Thông tin gia hạn</i></h5> ( <div class="form-check">
              <input class="form-check-input" onchange="trasom(this)" type="checkbox"  id="trasom">
              <label class="form-check-label" for="flexCheckDefault">
              Chọn ngày trả
              </label>
            </div>)
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{URL::to('/giahandonhang/'.$data->id_yeucau)}}" method="POST">
        <input type="text" hidden name="baotrasom" id="baotrasom" value="0"> 
        @csrf
      <div class="modal-body" onchange="tinhngayketthuc()">
        <div class="row">
          <div class="col">
            Ngày hết hạn cũ
            <input type="date" id="ngay_giaomay" class="form-control" value="{{\Carbon\Carbon::parse($data->ngay_ketthuc)->format('Y-m-d')}}" readonly>
          </div>
          <div class="col row" id="thoigiangiahan">
            <div class="col-12">Gia hạn mới</div>
            <div class="col">
              <input type="number" id="so_thoigian" class="form-control w-100" min="0">
            </div>
            
            <div class="col">
              <select id="donvi_thoigian" class="form-control w-100">
                <?php echo $option_donvithoigian ?>
              </select>
            </div>
          </div>
          <div class="col" id="ngayketthuc1" >
            Ngày kết thúc cũ
            <input type="date" class="form-control" id="ngay_ketthuc" name="ngay_ketthuc1" >
          </div>
          <div class="col" hidden id="ngayketthuc2" >
            Ngày kết thúc mới
            <input type="date" class="form-control" id="ngay_ketthuc2" name="ngay_ketthuc2" >
          </div>
        </div>
        <div class="row">
          <div class="col">
            Ghi Chú
            <textarea name="ghichumoi" class="form-control">{{$data->ghichu}}</textarea>
          </div>
        </div>          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-info">Xác nhận</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalLong1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Xác nhận hủy đơn hàng</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">Hủy bỏ</button>
        <a class="btn btn-outline-info" href="{{URL::to('/xoayeucau1/'.$data->id_yeucau)}}">Xác nhận</a>
      </div>
    </div>
  </div>
</div>


    <!-- Content here -->
 <div class="row">  
  <div class="col-10 offset-1">
    <div class="card">
      <div class="card-header row">
        <div class="card-title col-12 row">
          <h5><i class="fas fa-book"> Chi tiết đơn hàng</i></h5>
        </div>
      </div>
      <div class="card-body">
          <?php $ghichepdonhang = json_decode($data->ghichepdonhang,true);
          $a =  $ghichepdonhang['tongghichep'];
          echo '<table class="table table-bordered w-100"><thead  class="thead-light text-center"><tr><th class="col-1">#</th> <th class="col-2">Ngày Cập Nhật</th><th>Nội dung</th></tr></thead><tbody>';
          for ($i=1; $i <= $a; $i++) { 
            echo '<tr><td class="text-center">'.$ghichepdonhang['thutu'.$i].'</td><td class="text-center">'.$ghichepdonhang['ngaycapnhat'.$i].'</td><td class="px-2">'.$ghichepdonhang['noidung'.$i].'</td></tr>';}
           echo '</tbody></table>';
          ?>
      </div>
    </div>
  </div>



<?php if($coloi == 1){ ?>
  <div class="row">  
  <div class="col-10 offset-1">
    <div class="card">
      <div class="card-header row">
        <div class="card-title col-12 row">
          <div class="col"><h5><i class="fas fa-book"> Thông báo lỗi</i></h5></div>
        </div>
      </div>
      <div class="card-body">
          <table class="table table-bordered">
            <thead class="thead-light">
              <tr class="text-center">
                <th class="col-2"><i class="fas fa-calendar"></i> Ngày Báo</th>
                <th class="col-3"><i class="fas fa-bars"></i> Nội dung lỗi</th>
                <th class="col-4"><i class="fas fa-id-badge"></i> Phương án xử lí</th>
                <th class="col-2">Trạng Thái</th>
                <th class="col-1">#</th>
              </tr>
            </thead>
            <tbody>
              @foreach($dt_thongbaoloi as $dataloi)
              <tr>
                <td class="text-center">{{\Carbon\Carbon::parse($dataloi->created_at)->format('d/m/Y')}}</td>
                <td>{{$dataloi->noidungloi}}</td>
                <td>{{$dataloi->cachxuliloi}}</td>
                <?php if($dataloi->tinhtrangloi == 1){ echo '<td class="chuaxuli">Chưa xử lí</td>'; }
                          elseif($dataloi->tinhtrangloi == 2){ echo '<td>Đã xử lí xong lúc<br>'.\Carbon\Carbon::parse($data->updated_at)->format('d/m/Y').'</td>'; }
                 ?>
                <td class="text-center">
                  <?php if ($dataloi->tinhtrangloi == 1): ?>
                    <a href="{{URL::to('/xuliloi/'.$dataloi->id)}}">Xử lí <i class="fas fa-chevron-right"></i>
                  <?php endif ?>
                  </a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
      </div>
    </div>
  </div>
<?php } ?>
 <style>
   .chuaxuli{
    background-color: yellow;
   }
 </style>

<!-- Start Card 1 -->
<div class="col-10 offset-1 1a">
  <div class="card 1b">
  <div class="card-header row">
      <div class="col"><h5><i class="fas fa-edit"> Yêu cầu khách hàng<a href="{{URL::to('/xuliyeucau/'.$data->id_yeucau)}}"> (Sửa)</a></i></h5></div> 
      <div style="text-align:right;" > 
        <div class="col text-center" style="background: blue; border-radius: 15px; color: white"> 
            Hết hạn ngày: {{\Carbon\Carbon::parse($data->ngay_ketthuc)->format('d/m/Y')}} 
         
          </div>
      </div>
    </div>
    <!-- /.card-header -->
  <div class="card-body">
      <div class="row">
        <div class="col-4">
          <p>Mã Đơn: <b>{{$data->id_yeucau}}</b></p>
          <p>Giao ngày <b>{{\Carbon\Carbon::parse($data->thuctegiaomay)->format('d/m/Y')}}</b></p>
          <p>Mã Số Thuế: <b>{{$data->masothue}}</b></p>
          <p>Tên Doanh Nghiệp: <b>{{$data->tencongty}}</b></p>
          <p>Đại diện: <b>{{$data->daidien}}</b></p> 
          <p>Điện thoại: <b>{{$data->dienthoai}}</b></p>
          <p>Địa chỉ: <b>{{$data->diachi}}</b></p>
          <p style="color:blue"><b>  Loại hình thuê: <?php   switch ($data->loaithue) {
                            case '1':
                              echo 'Biên bản xác nhận/ Có đặt cọc';
                            break;
                            case '2':
                              echo 'Kí hợp đồng, có đặt cọc';
                            break;
                            case '3':
                            echo 'Biên bản xác nhận/ Không đặt cọc';
                            break;
                            case '4':
                              echo 'Kí hợp đồng, không đặt cọc, thanh toán sau';
                            break;
                            case '5':
                              echo 'Kí hợp đồng, không đặt cọc, thanh toán trước';
                            break;
                          } ?>
                            </b> </p>
      <p style="color:red"><b>Đặt cọc: {{$data->tiencoc}}đ</b></p>
        </div>
        <div class="col-8">
          <div class="col-12 row">
          Ghi Chú:
          <textarea class="form-control" disabled rows="05">{{$data->ghichu}}</textarea>
          </div>
          <table class="table table-bordered">
          <thead class="thead-light">
            <tr><p><h5>Yêu cầu thiết bị</h5><p></tr>
            <tr>
              <th>#</th>
              <th>Thiết bị</th>
              <th>Số Lượng</th>
              <th>Thời gian</th>
              <th>Đơn giá</th>
            </tr>
          </thead>
          <tbody>
            <?php $thongtinthietbi = array(json_decode($data->thongtinthietbi, true));
            $gioihan = $thongtinthietbi[0]['gioihan']+1;
            for ($i=1; $i < $gioihan; $i++) { ?>
            <tr>
            <td>{{$i}}</td>
            <td>{{$thongtinthietbi[0][$i]['loaithietbi'.$i]}}</td>
            <td>{{$thongtinthietbi[0][$i]['soluong'.$i]}}</td>
            <td>{{$thongtinthietbi[0][$i]['sothoigian'.$i].' '.$thongtinthietbi[0][$i]['donvithoigian'.$i]}}</td>
            <td>{{$thongtinthietbi[0][$i]['dongia'.$i]}}</td>
            </tr><?php } ?>
          </tbody>
          </table>
        </div>
      </div>
  </div>
</div> <!-- end class 1a -->
<!-- end card 1 -->
@endforeach
</div>

<!-- start card 2 -->
<div class="col-10 offset-1">
<div class="card">
  <div class="card-header row"> 
    <div class="col">
      <div class="card-title">
        <h5><i class="fa fa-book"> Thiết bị bàn giao</i></h5>
      </div>
    </div>
    <div class="col">
   
    </div>
    
  </div>
<div class="card-body">
  <div class="row">
    <div class="col-12">
    <table class="table table-hover table-bordered" id="table_thietbibangiao" onchange="tinhtien()">
    <thead class="thead-light">
      <tr>
        <th width="2%" >
          <input type="number" id="soluongchungloai" onchange="abc()" name="soluongchungloai" value="1" hidden></th>
        <th width="10%">Chủng loại</th>
        <th width="30%">Hãng/Cấu hình</th>
        <th width="10%">Chủ sở hữu</th>
        <th width="10%">Số lượng</th>
      </tr>
    </thead>
    <tbody>
      <?php $i=1 ?>
     @foreach ($data_donhang as $data)
      <tr>
        <td>{{$i}}</td>
        <td>{{$data->tenloaimay}}</td>
        <td>{{$data->tenhang}} <b>({{$data->tencauhinh}})</b></td>
        <td>{{$data->tenchusohuu}}</td>
        <td>{{$data->soluong}}</td>
      </tr>
     <?php $i = $i +1 ?>
      @endforeach
    </tbody>
    </table>
    </div>
  </div>
</div>
</div>
</div>
<!-- End Card 2 -->






      </div>
<!-- End Row  -->
  </div>
  <!-- Container-fluid -->
  </div>

</section>

@endsection

@section('js')
<script>
  $("#tag_donhang").addClass('menu-open');
  $("#donhang").addClass('active');
  $("#chitietdonhang").addClass('active');
  $("#chitietdonhang").prop('hidden',false);
  $("#table_thietbibangiao tbody td select").css('width','100%');
  $("#table_thietbibangiao tbody td input").css('width','100%');
  $("#table_thietbibangiao tbody td select").css('height','25px');
  $("#table_thietbibangiao tbody td input").css('height','25px');
  $("#table_thietbibangiao thead tr th").css('text-align','center');

function tinhngayketthuc(){
    var d = document.getElementById('ngay_giaomay').valueAsDate;
    var t1 = document.getElementById('so_thoigian').value;
    var t2 = document.getElementById('donvi_thoigian').value;
switch(t2) {
  case 'Ngày':
    document.getElementById('ngay_ketthuc').value = moment(d).add(t1, 'days').format('YYYY-MM-DD'); 
    break;
  case 'Tuần':
    document.getElementById('ngay_ketthuc').value = moment(d).add(t1, 'weeks').format('YYYY-MM-DD');  
    break;
    case 'Tháng':
    document.getElementById('ngay_ketthuc').value = moment(d).add(t1, 'months').format('YYYY-MM-DD');  
    break;
    case 'Năm':
    document.getElementById('ngay_ketthuc').value = moment(d).add(t1, 'years').format('YYYY-MM-DD'); 
    break;
}
}

 function  ntb(kiemtra){
  if(kiemtra.checked){
    $("#nhanthietbi").prop('hidden',false);
    $("#thietbihong").prop('value',1);
  }else{
    $("#thietbihong").prop('value',0);
     $("#nhanthietbi").prop('hidden',true);
  }
  }
   function  xtb(kiemtra){
  if(kiemtra.checked){
    $("#thietbimoi").prop('value',1);
    $("#xuatthietbi").prop('hidden',false);
      $("table input").addClass('form-control');
      $("table select").addClass('form-control');
  }else{
    $("#thietbimoi").prop('value',0);
    $("#xuatthietbi").prop('hidden',true);
  }
  }
$("table input").addClass('form-control');
$("table select").addClass('form-control');

function chonhang_nhap(i) {
  var id_chungloai = document.getElementById('chungloai_nhap'+i).value; //Lấy dữ liệu country
  $("#hang_nhap"+i).html(''); //Khai báo tỉnh với giá trị mặc định là null
  $.ajax({
    url: "{{URL::to('/layhang')}}", //url xử lí data
    type: "POST", //kiểu đưa dữ liệu lên
    data: {
        idtruyenvao: id_chungloai, //khai báo dữ liệu đưa vào
        _token: '{{csrf_token()}}' //token để sử dụng với hàm post
    },
    dataType: 'json', //Kiểu dữ liệu trả về
    success: function (result) { //Nếu dữ liệu trả về ok thì sẽ chạy tiếp ở đây
        $('#hang_nhap'+i).html('<option value="123">Chọn cấu hình</option>');
        $.each(result.layhang, function (key, value) {
            $("#hang_nhap"+i).append('<option value="' + value.id + '">' + value.tenhang + '</option>');
        });
    }
   });
};
function  choncauhinh_nhap(i){
  var id_hang = document.getElementById('hang_nhap'+i).value; //Lấy dữ liệu country
  $("#cauhinh_nhap"+i).html(''); //Khai báo tỉnh với giá trị mặc định là null
  $.ajax({
    url: "{{URL::to('/laycauhinh')}}", //url xử lí data
    type: "POST", //kiểu đưa dữ liệu lên
    data: {
        idtruyenvao: id_hang, //khai báo dữ liệu đưa vào
        _token: '{{csrf_token()}}' //token để sử dụng với hàm post
    },
    dataType: 'json', //Kiểu dữ liệu trả về
    success: function (result) { //Nếu dữ liệu trả về ok thì sẽ chạy tiếp ở đây
        $('#cauhinh_nhap'+i).html('<option value="123">Chọn cấu hình</option>');
        $.each(result.cauhinh, function (key, value) {
            $("#cauhinh_nhap"+i).append('<option value="' + value.id + '">' + value.tencauhinh + '</option>');
        });
    }
   });
};
function chonhang_xuat(i) {
  var id_chungloai = document.getElementById('chungloai_xuat'+i).value; //Lấy dữ liệu country
  $("#hang_xuat"+i).html(''); //Khai báo tỉnh với giá trị mặc định là null
  $.ajax({
    url: "{{URL::to('/layhang')}}", //url xử lí data
    type: "POST", //kiểu đưa dữ liệu lên
    data: {
        idtruyenvao: id_chungloai, //khai báo dữ liệu đưa vào
        _token: '{{csrf_token()}}' //token để sử dụng với hàm post
    },
    dataType: 'json', //Kiểu dữ liệu trả về
    success: function (result) { //Nếu dữ liệu trả về ok thì sẽ chạy tiếp ở đây
        $('#hang_xuat'+i).html('<option value="123">Chọn cấu hình</option>');
        $.each(result.layhang, function (key, value) {
            $("#hang_xuat"+i).append('<option value="' + value.id + '">' + value.tenhang + '</option>');
        });
    }
   });
};
function  choncauhinh_xuat(i){
  var id_hang = document.getElementById('hang_xuat'+i).value; //Lấy dữ liệu country
  $("#cauhinh_xuat"+i).html(''); //Khai báo tỉnh với giá trị mặc định là null
  $.ajax({
    url: "{{URL::to('/laycauhinh')}}", //url xử lí data
    type: "POST", //kiểu đưa dữ liệu lên
    data: {
        idtruyenvao: id_hang, //khai báo dữ liệu đưa vào
        _token: '{{csrf_token()}}' //token để sử dụng với hàm post
    },
    dataType: 'json', //Kiểu dữ liệu trả về
    success: function (result) { //Nếu dữ liệu trả về ok thì sẽ chạy tiếp ở đây
        $('#cauhinh_xuat'+i).html('<option value="123">Chọn cấu hình</option>');
        $.each(result.cauhinh, function (key, value) {
            $("#cauhinh_xuat"+i).append('<option value="' + value.id + '">' + value.tencauhinh + '</option>');
        });
    }
   });
};





  function trasom(kiemtra){
    if(kiemtra.checked){
      $("#ngayketthuc1").prop('hidden',true);
      $("#thoigiangiahan").prop('hidden',true);
      $("#ngayketthuc2").prop('hidden',false);
      $("#baotrasom").prop('value','1');

    }else{
      $("#ngayketthuc1").prop('hidden',false);
      $("#thoigiangiahan").prop('hidden',false);
      $("#ngayketthuc2").prop('hidden',true);
      $("#baotrasom").prop('value','0');
    }
  }
</script>





@endsection
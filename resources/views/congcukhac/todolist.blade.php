@extends('layout.master')
@section('content')
<br>
<form action="">
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-8 offset-2">
            <div class="card">
              <div class="card-header row">
                <div class="col"><h4 class=""><i class="fas fa-sticky-note"> Ghi chú cá nhân</i></h4></div>
                <div class="col text-right"><button type="submit" class="btn btn-info">Lưu</button></div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              	<table class="table " id="table_ghichu">
                 <thead>
                   <tr>
                     <th class="col-1">

                     </th>
                     <th class="col-7 text-center">Công việc</th>
                     <th class="col-2 text-center">Deadline</th>
                     <th class=""></th>
                     <th class=""></th>
                   </tr>
                 </thead>
                 <tbody>
                  @for($i=1;$i<3;$i++)
                  <?php $check = 'checked'; ?>
                   <tr>
                     <td>{{$i}}</td>
                     <td><input type="text" id="noidung{{$i}}" name="noidung{{$i}}" class="form-control"></td>
                     <td><input type="date" id="ngayhoanthanh{{$i}}" name="ngayhoanthanh{{$i}}" value="{{\Carbon\Carbon::parse(today())->format('Y-m-d')}}" class="form-control" style="border:none"></td>
                     <input type="tinhtrang{{$i}}"  hidden>
                     <td><input type="checkbox" onchange="xacnhanhoanthanh({{$i}})" id="row1"></td>
                     <td><i class="fas fa-times" id="id{{$i}}" ></i></td>
                   </tr>
                   @endfor
                 </tbody>
                 <tfoot>
                   <tr>
                     <td><a href=""><i class="fas fa-plus"></i></a></td>
                     <td><input type="text" class="form-control"></td>
                     <td><input type="date" class="form-control" value="{{\Carbon\Carbon::parse(today())->format('Y-m-d')}}" style="border:none"></td>
                     <td></td>
                     <td></td>
                   </tr>
                   </tfoot>
                </table>
              </div>
          	</div>
     	 </div>
  		</div>
	</div>
</section>
</form>

@endsection

@section('js')
<script>
  $("#todolist").addClass('active');
  function  xacnhanhoanthanh(id){
    $("#noidung"+id).prop('readonly',true);
  }
</script>
@endsection
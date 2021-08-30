 <aside class="main-sidebar sidebar-dark-primary elevation-4 sidebar-toggle sidebar-collapse" >
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{URL::to('/')}}/logo3.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Công Ty Bách Khoa 4</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{URL::to('/')}}/user.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{URL::to('caidattaikhoan')}}" class="d-block">Cài đặt tài khoản</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
<!--       <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item">
            <a href="{{URL::to('tongquan')}}" class="nav-link" id="tongquan">
              <i class="nav-icon fas fa-chart-line"></i>
              <p>Tổng quan
              </p>
            </a>
          </li>


              <!-- Khách Hàng -->
          <li class="nav-item" id="tag_khachhang">
            <a href="#" class="nav-link" id="khachhang">
              <i class="nav-icon fas fa-user-plus"></i>
              <p>
                Khách Hàng
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{URL::to('/viewcustumer')}}" class="nav-link" id="danhsachkhachhang">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách khách hàng</p>
                </a>
              </li>
              <li class="nav-item ">
                <a href="{{URL::to('/addcompany')}}" class="nav-link" id="themkhachhang" hidden>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm khách hàng</p>
                </a>
              </li>
              <li class="nav-item ">
                <a href="{{URL::to('/addcompany')}}" class="nav-link" id="thongtinkhachhang" hidden>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thông tin khách hàng</p>
                </a>
              </li>
            </ul>
          </li>




         <!-- Đơn hàng -->
          <li class="nav-item" id="tag_donhang">
            <a href="#" class="nav-link" id="donhang">
              <i class="nav-icon fas fa-cart-plus"></i>
              <p>
                Đơn hàng
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">0</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{URL::to('/taoyeucau')}}" class="nav-link" id="taoyeucau" hidden>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tạo Yêu Cầu</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{URL::to('/danhsachyeucau')}}" class="nav-link" id="danhsachyeucau">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách yêu cầu</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link" id="xuliyeucau" hidden>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Xử lí yêu cầu</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link" id="chuyentiepyeucau" hidden>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Chuyển tiếp yêu cầu</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{URL::to('/danhsachdonhang')}}" class="nav-link" id="danhsachdonhang">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách đơn hàng</p>
                </a>
              </li>
              <li class="nav-item" hidden>
                <a href="{{URL::to('/chitietdonhang')}}" class="nav-link" id="chitietdonhang">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Chi tiết đơn hàng</p>
                </a>
              </li>
              <li class="nav-item" hidden>
                <a href="{{URL::to('/donhangxuatban')}}" class="nav-link" id="donhangxuatban">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Đơn hàng xuất bán</p>
                </a>
              </li>
            </ul>
          </li>

          



          <!-- Thống kê -->
          





          <!-- Kho hàng  -->
          <li class="nav-item" id="tag_khohang">
            <a href="#" class="nav-link" id="khohang">
              <i class="nav-icon fas fa-warehouse"></i>
              <p>
                Kho hàng
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{URL::to('/danhsachtongthietbi')}}" class="nav-link" id="danhsachtongthietbi">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tồn kho</p>
                </a>
              </li>
           
              <li class="nav-item">
                <a href="{{URL::to('/nhapmoithietbi')}}" class="nav-link" id="nhapmoithietbi" hidden>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Nhập Mới Thiết bị</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{URL::to('/thietbicongty')}}" class="nav-link" id="thietbicongty">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thiết bị Công ty</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="{{URL::to('/kiemtrathietbi')}}" class="nav-link" id="kiemtrathietbi">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kiểm tra thiết bị</p>
                </a>
              </li>
            </ul>
          </li>





         <!--  Giấy tờ  -->
          



          <li class="nav-item" id="tag_thietbidoitac">
            <a href="#" class="nav-link " id="doitac">
              <i class="nav-icon fas fa-hands-helping"></i>
              <p>
                Đối tác
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{URL::to('/thietbidoitac')}}" class="nav-link" id="thietbidoitac">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thiết bị Đối Tác</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kiểm tra dòng tiền</p>
                </a>
              </li>
            </ul>
          </li>

           <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-file-pdf"></i>
              <p>
                Giấy tờ
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>General Elements</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Advanced Elements</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Editors</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Validation</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-header">Công cụ khác</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                Lịch Công Việc
                <i class="fas fa-angle-left right"></i>
                
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{URL::to('todolist')}}" class="nav-link " id="todolist">
              <i class="nav-icon far fa-image"></i>
              <p>
                Todo List
                <i class="fas fa-angle-left right"></i>

              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{URL::to('/thoat')}}" class="nav-link " id="todolist">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Đăng xuất
                <i class="fas fa-angle-left right"></i>

              </p>
            </a>
          </li>
        </ul>
        



      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
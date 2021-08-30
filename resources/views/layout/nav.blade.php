
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button" ><i class="fas fa-bars"></i></a>
      </li>

      <li>
        @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
        @endif
      </li>
      
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
        <label class="form-control" style="color:blueviolet;">Hi! {{session('_tennhanvien')}} - Hôm nay: {{\Carbon\Carbon::parse(today())->format('d/m/Y')}} </label>
         
    </ul>
  </nav>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bách Khoa 4</title>
@include('layout.ex.links')
</head>
<style>
	*{
		font-family: "Times New Roman", Times, serif;
	}
</style>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
	<div class="wrapper">
		@include('layout.nav')
		@include('layout.aside')
		  <div class="content-wrapper">
		  	<section>
		  		<div class="container-fluid px-3 row">
		  			 @if ($errors->any())
        <div class="alert alert-info col-12">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif		
		  		</div>
		  	</section>
				@yield('content')
			</div>
		@include('layout.footer')
	</div>
	@include('layout.ex.js')
	@yield('js')
	<script src="https://momentjs.com/downloads/moment-with-locales.js"></script>
	<script>
   $('[data-widget="pushmenu"]').PushMenu("collapse");

</script>
</body>
</html>

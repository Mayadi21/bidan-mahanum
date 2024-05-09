<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Muhamad Nauval Azhar">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta name="description" content="This is a login page template based on Bootstrap 5">
	<title>Tubes Blog | {{ $page }}</title>
	<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
</head>

<body>
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-sm-center h-100">
				<div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
					<div class="card shadow-lg my-3">
						<div class="card-body p-5">
							<div class="text-center mb-4">
								<img src="{{ asset('img/logo.jpeg') }}" class="w-25 img rounded" alt="logo">
							</div>
							
							@yield('content')

						</div>
						
						@yield('footer')

					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="{{ asset('js/login.js') }}"></script>
	<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>

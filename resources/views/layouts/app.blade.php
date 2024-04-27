<!DOCTYPE html>
<html lang="en">
<head>
	<title>{{ config('app.name') }} | @yield('title')</title>
    @include('partials.hscript')
    @yield('custom_CSS')
</head>
<body class="admin-dashboard">
	
	<section class="dash-section">
        <div class="dashboard-blog">
            
    		@include('partials.sidebar')
                
			@yield('main-content')

        </div>
    </section>

    @include('partials.fscript')

    @include('partials.alert')

	@yield('custom_JS')
</body>
</html>

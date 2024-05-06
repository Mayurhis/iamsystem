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

            <div class="dash-right-area">
                <div class="mobile-header d-md-none">
                   <div class="mob-logo">
                      <a href="javascript:void(0);" title="logo"><h3 class="text-white">IAM SYSTEM</h3></a>
                   </div>
                   <div class="humberger-icon">
                      <img src="{{ asset('backend/images/humberger-icon.svg') }}" alt="humberger-icon">
                   </div>
                </div>

                <div class="dash-title">
                    <div class="main-title">
                        <h2>@yield('headerTitle')</h2>
                        <div class="dropdown user-dropdown">
                            <div class="dropdown-toggle ms-auto p-0" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="img-user"><img src="{{ asset('backend/images/user.jpg') }}" class="img-fluid" id="userImg" alt="user"></div>
                                <div class="name-dta d-flex align-items-end">
                                    <div class="welcome-user">
                                    <span class="welcome">@lang('global.welcome')</span>
                                    <span class="user-name-title">{{ authUserDetail('data.user.type') ? ucwords(authUserDetail('data.user.type')) : '' }}</span>
                                    </div>
                                    <span class="arrow-icon ms-2">
                                    <svg width="10" height="5" viewBox="0 0 14 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M13.002 7L7.00195 0.999999L1.00195 7" stroke="#102846" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                    </span>
                                </div>
                            </div>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <ul class="list-unstyled mb-0">
                                    <li>
                                    <a class="dropdown-item" href="{{ route('admin.profile') }}">
                                        <svg width="16" height="18" viewBox="0 0 16 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <mask id="path-1-inside-1_1239_12575" fill="white">
                                                <path d="M16 18V16C16 14.9391 15.5786 13.9217 14.8284 13.1716C14.0783 12.4214 13.0609 12 12 12H4C2.93913 12 1.92172 12.4214 1.17157 13.1716C0.421427 13.9217 0 14.9391 0 16V18"></path>
                                            </mask>
                                            <path d="M14.5 18C14.5 18.8284 15.1716 19.5 16 19.5C16.8284 19.5 17.5 18.8284 17.5 18H14.5ZM12 12V10.5V12ZM4 12L4 10.5L4 12ZM0 16H-1.5H0ZM-1.5 18C-1.5 18.8284 -0.828427 19.5 0 19.5C0.828427 19.5 1.5 18.8284 1.5 18H-1.5ZM17.5 18V16H14.5V18H17.5ZM17.5 16C17.5 14.5413 16.9205 13.1424 15.8891 12.1109L13.7678 14.2322C14.2366 14.7011 14.5 15.337 14.5 16H17.5ZM15.8891 12.1109C14.8576 11.0795 13.4587 10.5 12 10.5L12 13.5C12.663 13.5 13.2989 13.7634 13.7678 14.2322L15.8891 12.1109ZM12 10.5H4V13.5H12V10.5ZM4 10.5C2.54131 10.5 1.14236 11.0795 0.110913 12.1109L2.23223 14.2322C2.70107 13.7634 3.33696 13.5 4 13.5L4 10.5ZM0.110913 12.1109C-0.920537 13.1424 -1.5 14.5413 -1.5 16L1.5 16C1.5 15.337 1.76339 14.7011 2.23223 14.2322L0.110913 12.1109ZM-1.5 16V18H1.5V16H-1.5Z" fill="#102846" mask="url(#path-1-inside-1_1239_12575)"></path>
                                            <path d="M11.25 4C11.25 5.79493 9.79493 7.25 8 7.25C6.20507 7.25 4.75 5.79493 4.75 4C4.75 2.20507 6.20507 0.75 8 0.75C9.79493 0.75 11.25 2.20507 11.25 4Z" stroke="#102846" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                        My Profile
                                    </a>
                                    </li>
                                    <li>
                                    <a class="dropdown-item" href="{{route('logout')}}">
                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6.75 15.75H3.75C3.35218 15.75 2.97064 15.592 2.68934 15.3107C2.40804 15.0294 2.25 14.6478 2.25 14.25V3.75C2.25 3.35218 2.40804 2.97064 2.68934 2.68934C2.97064 2.40804 3.35218 2.25 3.75 2.25H6.75" stroke="#102846" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M12 12.75L15.75 9L12 5.25" stroke="#102846" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M15.75 9H6.75" stroke="#102846" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                        Log out
                                    </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    @yield('main-content')

                </div>
            </div>

        </div>
    </section>

    <div class="popup_render_div"></div>

    <div class="pageloader" style="display: none;">
        <div class="loader">
            <div class="line-scale">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>

    @include('partials.fscript')

    @include('partials.alert')

	@yield('custom_JS')
</body>
</html>

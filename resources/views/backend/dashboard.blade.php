@extends('layouts.app')
@section('title', trans('global.dashboard'))
@section('custom_CSS')
@endsection
@section('main-content')
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
         <h2>@lang('global.dashboard')</h2>
         <div class="dropdown user-dropdown">
            <div class="dropdown-toggle ms-auto p-0" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
               <div class="img-user"><img src="{{ asset('backend/images/user.jpg') }}" class="img-fluid" id="userImg" alt="user"></div>
               <div class="name-dta d-flex align-items-end">
                  <div class="welcome-user">
                     <span class="welcome">Welcome</span>
                     <span class="user-name-title">Admin</span>
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
        <div class="row mb-3">
            <div class="col-sm-6 col-lg-3 mb-4">
                <div class="card card-border-shadow-primary dash-boxes">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2 pb-1">
                        <div class="avatar me-2">
                            <span class="avatar-initial rounded bg-label-primary">
                                <svg width="20" height="17" viewBox="0 0 20 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19 15.9999C19 14.2583 17.3304 12.7767 15 12.2275M13 16C13 13.7909 10.3137 12 7 12C3.68629 12 1 13.7909 1 16M13 9C15.2091 9 17 7.20914 17 5C17 2.79086 15.2091 1 13 1M7 9C4.79086 9 3 7.20914 3 5C3 2.79086 4.79086 1 7 1C9.20914 1 11 2.79086 11 5C11 7.20914 9.20914 9 7 9Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                        </div>
                        <h4 class="ms-1 mb-0">42</h4>
                        </div>
                        <p class="mb-1">orcapay</p>
                        <p class="mb-0">
                        <span class="fw-medium me-1">+18.2%</span>
                        <small class="text-muted">than last week</small>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3 mb-4">
                <div class="card card-border-shadow-warning dash-boxes">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2 pb-1">
                        <div class="avatar me-2">
                            <span class="avatar-initial rounded bg-label-warning">
                                <svg width="20" height="17" viewBox="0 0 20 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19 15.9999C19 14.2583 17.3304 12.7767 15 12.2275M13 16C13 13.7909 10.3137 12 7 12C3.68629 12 1 13.7909 1 16M13 9C15.2091 9 17 7.20914 17 5C17 2.79086 15.2091 1 13 1M7 9C4.79086 9 3 7.20914 3 5C3 2.79086 4.79086 1 7 1C9.20914 1 11 2.79086 11 5C11 7.20914 9.20914 9 7 9Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                        </div>
                        <h4 class="ms-1 mb-0">8</h4>
                        </div>
                        <p class="mb-1">canapay</p>
                        <p class="mb-0">
                        <span class="fw-medium me-1">-8.7%</span>
                        <small class="text-muted">than last week</small>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3 mb-4">
                <div class="card card-border-shadow-danger dash-boxes">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2 pb-1">
                        <div class="avatar me-2">
                            <span class="avatar-initial rounded bg-label-danger">
                                <svg width="20" height="17" viewBox="0 0 20 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19 15.9999C19 14.2583 17.3304 12.7767 15 12.2275M13 16C13 13.7909 10.3137 12 7 12C3.68629 12 1 13.7909 1 16M13 9C15.2091 9 17 7.20914 17 5C17 2.79086 15.2091 1 13 1M7 9C4.79086 9 3 7.20914 3 5C3 2.79086 4.79086 1 7 1C9.20914 1 11 2.79086 11 5C11 7.20914 9.20914 9 7 9Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                        </div>
                        <h4 class="ms-1 mb-0">27</h4>
                        </div>
                        <p class="mb-1">orcapay</p>
                        <p class="mb-0">
                        <span class="fw-medium me-1">+4.3%</span>
                        <small class="text-muted">than last week</small>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3 mb-4">
                <div class="card card-border-shadow-info dash-boxes">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2 pb-1">
                        <div class="avatar me-2">
                            <span class="avatar-initial rounded bg-label-info">
                                <svg width="20" height="17" viewBox="0 0 20 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19 15.9999C19 14.2583 17.3304 12.7767 15 12.2275M13 16C13 13.7909 10.3137 12 7 12C3.68629 12 1 13.7909 1 16M13 9C15.2091 9 17 7.20914 17 5C17 2.79086 15.2091 1 13 1M7 9C4.79086 9 3 7.20914 3 5C3 2.79086 4.79086 1 7 1C9.20914 1 11 2.79086 11 5C11 7.20914 9.20914 9 7 9Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                        </div>
                        <h4 class="ms-1 mb-0">13</h4>
                        </div>
                        <p class="mb-1">canapay</p>
                        <p class="mb-0">
                        <span class="fw-medium me-1">-2.5%</span>
                        <small class="text-muted">than last week</small>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="data-fieldtable">
                            <div class="brand-listing d-flex">
                                <h4 class="table-subtitle">Users Listing</h4>
                                <!-- <div class="select_brand">
                                    <label for="">Select Brands</label>
                                    <select name="" id="">
                                        <option value="Brand">Brand</option>
                                        <option value="Brand1">Brand1</option>
                                        <option value="Brand2">Brand2</option>
                                        <option value="Brand3">Brand3</option>
                                    </select>
                                </div> -->
                            </div>
                            <div class="table-responsive">
                                <table class="w-100" id="fieldtable">
                                    <thead>
                                        <tr>
                                            <th>User Name</th>
                                            <th>ID</th>
                                            <th>Audience</th>
                                            <th>Created Date</th>
                                            <th>Login Date</th>
                                            <th>Status</th>
                                            <th>Email</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <a href="javascript:void(0)" class="pro-data" title="Mayor Kelly">
                                                    <div class="pro-img"><img src="{{ asset('backend/images/user01.jpg') }}" alt="" class="img-fluid"></div>
                                                    <div class="prodata-content">
                                                        <h6 class="pb-1">Mayor Kelly</h6>
                                                    </div>
                                                </a>
                                            </td>
                                            <td>
                                                d4AKjfkjfiods9gshd
                                            </td>
                                            <td>
                                                canapay
                                            </td>
                                            <td>18/01/2024</td>
                                            <td>10/11/2023</td>
                                            <td><span class="badge rounded bg-label-success">Active</span></td>
                                            <td><a href="mailto:mayorkelly@gmail.com" title="mayorkelly@gmail.com">mayorkelly@gmail.com</a></td>
                                            <td>
                                                <div class="action-grid d-flex gap-2">
                                                    <a href="{{route('admin.user_detail')}}" class="action-btn bg-dark" title="View"><i class="fi fi-rr-eye"></i></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="javascript:void(0)" class="pro-data" title="Andrew Garfield">
                                                    <div class="pro-img"><img src="{{ asset('backend/images/user011.jpg') }}" alt="" class="img-fluid"></div>
                                                    <div class="prodata-content">
                                                        <h6 class="pb-1">Andrew Garfield</h6>
                                                    </div>
                                                </a>
                                            </td>
                                            <td>
                                                d4AKjfkjfiods9gshd
                                            </td>
                                            <td>
                                                IdFox
                                            </td>
                                            <td>29/01/2024</td>
                                            <td>15/11/2023</td>
                                            <td><span class="badge rounded bg-label-success">Active</span></td>
                                            <td><a href="mailto:andrewgarfield@gmail.com" title="andrewgarfield@gmail.com">andrewgarfield@gmail.com</a></td>
                                            <td>
                                                <div class="action-grid d-flex gap-2">
                                                    <a href="{{route('admin.user_detail')}}" class="action-btn bg-dark" title="View"><i class="fi fi-rr-eye"></i></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="javascript:void(0)" class="pro-data" title="Simon Cowel">
                                                    <div class="pro-img"><img src="{{ asset('backend/images/user022.jpg') }}" alt="" class="img-fluid"></div>
                                                    <div class="prodata-content">
                                                        <h6 class="pb-1">Simon Cowel</h6>
                                                    </div>
                                                </a>
                                            </td>
                                            <td>
                                                d4AKjfkjfiods9gshd
                                            </td>
                                            <td>
                                                orcapay
                                            </td>
                                            <td>23/01/2024</td>
                                            <td>17/11/2023</td>
                                            <td><span class="badge rounded bg-label-success">Active</span></td>
                                            <td><a href="mailto:simoncowel@gmail.com" title="simoncowel@gmail.com">simoncowel@gmail.com</a></td>
                                            <td>
                                                <div class="action-grid d-flex gap-2">
                                                    <a href="{{route('admin.user_detail')}}" class="action-btn bg-dark" title="View"><i class="fi fi-rr-eye"></i></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="javascript:void(0)" class="pro-data" title="Mirinda Hers">
                                                    <div class="pro-img"><img src="{{ asset('backend/images/user033.jpg') }}" alt="" class="img-fluid"></div>
                                                    <div class="prodata-content">
                                                        <h6 class="pb-1">Mirinda Hers</h6>
                                                    </div>
                                                </a>
                                            </td>
                                            <td>
                                                d4AKjfkjfiods9gshd
                                            </td>
                                            <td>
                                                canapay
                                            </td>
                                            <td>25/01/2024</td>
                                            <td>18/11/2023</td>
                                            <td><span class="badge rounded bg-label-danger">Inactive</span></td>
                                            <td><a href="mailto:mirindahers@gmail.com" title="mirindahers@gmail.com">mirindahers@gmail.com</a></td>
                                            <td>
                                                <div class="action-grid d-flex gap-2">
                                                    <a href="{{route('admin.user_detail')}}" class="action-btn bg-dark" title="View"><i class="fi fi-rr-eye"></i></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="javascript:void(0)" class="pro-data" title="Ryan Gercia">
                                                    <div class="pro-img"><img src="{{ asset('backend/images/user04.jpg') }}" alt="" class="img-fluid"></div>
                                                    <div class="prodata-content">
                                                        <h6 class="pb-1">Ryan Gercia</h6>
                                                    </div>
                                                </a>
                                            </td>
                                            <td>
                                                d4AKjfkjfiods9gshd
                                            </td>
                                            <td>
                                                orcapay
                                            </td>
                                            <td>21/01/2024</td>
                                            <td>19/11/2023</td>
                                            <td><span class="badge rounded bg-label-success">Active</span></td>
                                            <td><a href="mailto:ryangercia@gmail.com" title="ryangercia@gmail.com">ryangercia@gmail.com</a></td>
                                            <td>
                                                <div class="action-grid d-flex gap-2">
                                                    <a href="{{route('admin.user_detail')}}" class="action-btn bg-dark" title="View"><i class="fi fi-rr-eye"></i></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="javascript:void(0)" class="pro-data" title="Peter Parkour">
                                                    <div class="pro-img"><img src="{{ asset('backend/images/user011.jpg') }}" alt="" class="img-fluid"></div>
                                                    <div class="prodata-content">
                                                        <h6 class="pb-1">Peter Parkour</h6>
                                                    </div>
                                                </a>
                                            </td>
                                            <td>
                                                d4AKjfkjfiods9gshd
                                            </td>
                                            <td>
                                                IdFOx
                                            </td>
                                            <td>22/01/2024</td>
                                            <td>20/11/2023</td>
                                            <td><span class="badge rounded bg-label-success">Active</span></td>
                                            <td><a href="mailto:peterparkour@gmail.com" title="peterparkour@gmail.com">peterparkour@gmail.com</a></td>
                                            <td>
                                                <div class="action-grid d-flex gap-2">
                                                    <a href="{{route('admin.user_detail')}}" class="action-btn bg-dark" title="View"><i class="fi fi-rr-eye"></i></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="javascript:void(0)" class="pro-data" title="Mirinda Hers">
                                                    <div class="pro-img"><img src="{{ asset('backend/images/user02.jpg') }}" alt="" class="img-fluid"></div>
                                                    <div class="prodata-content">
                                                        <h6 class="pb-1">Mirinda Hers</h6>
                                                    </div>
                                                </a>
                                            </td>
                                            <td>
                                                d4AKjfkjfiods9gshd
                                            </td>
                                            <td>
                                                canapay
                                            </td>
                                            <td>24/01/2024</td>
                                            <td>22/11/2023</td>
                                            <td><span class="badge rounded bg-label-success">Active</span></td>
                                            <td><a href="mailto:mirindahers@gmail.com" title="mirindahers@gmail.com">mirindahers@gmail.com</a></td>
                                            <td>
                                                <div class="action-grid d-flex gap-2">
                                                    <a href="{{route('admin.user_detail')}}" class="action-btn bg-dark" title="View"><i class="fi fi-rr-eye"></i></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="javascript:void(0)" class="pro-data" title="Andrew Garfield">
                                                    <div class="pro-img"><img src="{{ asset('backend/images/user033.jpg') }}" alt="" class="img-fluid"></div>
                                                    <div class="prodata-content">
                                                        <h6 class="pb-1">Andrew Garfield</h6>
                                                    </div>
                                                </a>
                                            </td>
                                            <td>
                                                d4AKjfkjfiods9gshd
                                            </td>
                                            <td>
                                                orcapay
                                            </td>
                                            <td>08/02/2024</td>
                                            <td>10/12/2023</td>
                                            <td><span class="badge rounded bg-label-success">Active</span></td>
                                            <td><a href="mailto:andrewgarfield@gmail.com" title="andrewgarfield@gmail.com">andrewgarfield@gmail.com</a></td>
                                            <td>
                                                <div class="action-grid d-flex gap-2">
                                                    <a href="{{route('admin.user_detail')}}" class="action-btn bg-dark" title="View"><i class="fi fi-rr-eye"></i></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="javascript:void(0)" class="pro-data" title="Hr-Spruko">
                                                    <div class="pro-img"><img src="{{ asset('backend/images/user04.jpg') }}" alt="" class="img-fluid"></div>
                                                    <div class="prodata-content">
                                                        <h6 class="pb-1">Hr-Spruko</h6>
                                                    </div>
                                                </a>
                                            </td>
                                            <td>
                                                d4AKjfkjfiods9gshd
                                            </td>
                                            <td>
                                                IDFox
                                            </td>
                                            <td>19/02/2024</td>
                                            <td>17/11/2023</td>
                                            <td><span class="badge rounded bg-label-success">Active</span></td>
                                            <td><a href="mailto:hrspruko@gmail.com" title="hrspruko@gmail.com">hrspruko@gmail.com</a></td>
                                            <td>
                                                <div class="action-grid d-flex gap-2">
                                                    <a href="{{route('admin.user_detail')}}" class="action-btn bg-dark" title="View"><i class="fi fi-rr-eye"></i></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>

   </div>
</div>
@endsection
@section('custom_JS')
@endsection
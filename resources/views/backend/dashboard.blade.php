@extends('layouts.app')
@section('title', trans('cruds.pageTitles.dashboard'))

@section('custom_CSS')
@endsection

@section('headerTitle',trans('cruds.pageTitles.dashboard'))

@section('main-content')

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
                            {{$dataTable->table(['class' => 'table', 'style' => 'width:100%;'])}}
                            {{-- <table class="w-100" id="fieldtable">
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
                            </table> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('custom_JS')
@parent
{!! $dataTable->scripts() !!}

@endsection

@extends('layouts.app')
@section('title', trans('cruds.pageTitles.user'))

@section('custom_CSS')
@endsection

@section('headerTitle',trans('cruds.pageTitles.user'))

@section('main-content')

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
                                                <a href="{{route('admin.users.show','1')}}" class="action-btn bg-dark" title="View"><i class="fi fi-rr-eye"></i></i></a>
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
                                                <a href="{{route('admin.users.show','2')}}" class="action-btn bg-dark" title="View"><i class="fi fi-rr-eye"></i></i></a>
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
                                                <a href="{{route('admin.users.show','3')}}" class="action-btn bg-dark" title="View"><i class="fi fi-rr-eye"></i></i></a>
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
                                                <a href="{{route('admin.users.show','4')}}" class="action-btn bg-dark" title="View"><i class="fi fi-rr-eye"></i></i></a>
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
                                                <a href="{{route('admin.users.show','5')}}" class="action-btn bg-dark" title="View"><i class="fi fi-rr-eye"></i></i></a>
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
                                                <a href="{{route('admin.users.show','6')}}" class="action-btn bg-dark" title="View"><i class="fi fi-rr-eye"></i></i></a>
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
                                                <a href="{{route('admin.users.show','7')}}" class="action-btn bg-dark" title="View"><i class="fi fi-rr-eye"></i></i></a>
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
                                                <a href="{{route('admin.users.show','8')}}" class="action-btn bg-dark" title="View"><i class="fi fi-rr-eye"></i></i></a>
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
                                                <a href="{{route('admin.users.show','9')}}" class="action-btn bg-dark" title="View"><i class="fi fi-rr-eye"></i></i></a>
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

@endsection

@section('custom_JS')
@endsection

@extends('layouts.app')
@section('title', trans('cruds.pageTitles.user_detail'))
@section('custom_CSS')
@endsection

@section('headerTitle',trans('cruds.pageTitles.user_detail'))

@section('main-content')

    <div class="user-detail-area">
        <div class="row">
        <div class="col-12 col-sm-12 col-md-3 col-lg-2">
            <div class="user_profile">
                <img class="img-fluid" src="{{ asset('backend/images/user011.jpg') }}" alt="profile">
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-8 col-lg-10">
            <div class="user_content">
                <div class="mb-3">
                    <div class="name">
                        <h4>User Name</h4>
                        <span>Andrew Garfield</span>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="name">
                        <h4>ID</h4>
                        <span>d4AKjfkjfiods9gshd</span>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="name">
                        <h4>Audience</h4>
                        <span>canapay</span>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="name">
                        <h4>Created Date</h4>
                        <span>18/01/2024</span>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="name">
                        <h4>Login Date</h4>
                        <span>10/11/2023</span>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="name">
                        <h4>Email</h4>
                        <span>mayorkelly@gmail.com</span>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="name">
                        <h4>Status</h4>
                        <span class="text-success">Complete</span>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>

@endsection

@section('custom_JS')
@endsection

@extends('Admin.layout.main')

@section('title', '用户权限')

@section('content')
    <div class="main-container">
        <div class="container-fluid">
            @include('Admin.layout.breadcrumb')

            <div class="row">
                <div class="col-md-12">
                    {{ base_path('resources/views/Admin/acl/user/index.blade.php') }}
                </div>
            </div>
        </div>
    </div>
@endsection

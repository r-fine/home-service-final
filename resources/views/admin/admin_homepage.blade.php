@extends('layouts.admin_dashboard')
@section('title', 'Admin Dashboard')

@section('admin_content')

<div class="container my-5">
    <div class="row row-cols-md-3 justify-content-center gx-5">
        <div class="col">
            <div class="col-md">
                <div class="card text-center text-white mb-5" style="height: 180px; background-color: #7898ff;">
                    <div class="card-header">
                        <h4 class="card-title">Total Orders</h4>
                    </div>
                    <div class="card-body d-flex justify-content-center align-items-center">
                        <h1 class="card-title">{{ $order_count }}</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="col-md">
                <div class="card text-center text-white mb-5" style="height: 180px; background-color: #7abecc">
                    <div class="card-header">
                        <h4 class="card-title">Orders Completed</h4>
                    </div>
                    <div class="card-body d-flex justify-content-center align-items-center">
                        <h1 class="card-title">{{ $order_completed }}</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="col-md">
                <div class="card text-center text-white mb-5" style="height: 180px; background-color: #7CD1C0;">
                    <div class="card-header">
                        <h4 class="card-title">Orders Pending</h4>
                    </div>
                    <div class="card-body d-flex justify-content-center align-items-center">
                        <h1 class="card-title">{{ $order_pending }}</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="col-md">
                <div class="card text-center text-white mb-5"
                    style="height: 180px; background-color: rgb(255, 143, 123);">
                    <div class="card-header">
                        <h4 class="card-title">Total Providers</h4>
                    </div>
                    <div class="card-body d-flex justify-content-center align-items-center">
                        <h1 class="card-title">{{ $provider_count }}</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="col-md">
                <a href="{{ route('admin.unverified.provider.list') }}" class="card text-decoration-none text-center text-white mb-5"
                    style="height: 180px; background-color: rgb(95, 185, 140);">
                    <div class="card-header">
                        <h4 class="card-title">Provider Approval Pending</h4>
                    </div>
                    <div class="card-body d-flex justify-content-center align-items-center">
                        <h1 class="card-title">{{ $unverified_providers }}</h1>
                    </div>
                </a>
            </div>
        </div>
        <div class="col">
            <div class="col-md">
                <div class="card text-center text-white mb-5" style="height: 180px; background-color: #f1ad5e;">
                    <div class="card-header">
                        <h4 class="card-title">Total Services</h4>
                    </div>
                    <div class="card-body d-flex justify-content-center align-items-center">
                        <h1 class="card-title">{{ $service_count }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

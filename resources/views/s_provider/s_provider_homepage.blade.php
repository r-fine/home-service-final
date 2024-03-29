@extends('layouts.s_provider_dashboard')
@section('title', 'Provider Dashboard')

@section('provider_content')
<div class="container my-5 pb-5">
    <div class="row row-cols-md-3 justify-content-center gx-5 pb-5">
        <div class="col">
            <div class="col-md">
                <div class="card text-center text-white my-5" style="height: 180px; background-color: #7898ff;">
                    <div class="card-header">
                        <h4 class="card-title">Upcoming Tasks</h4>
                    </div>
                    <div class="card-body d-flex justify-content-center align-items-center">
                        <h1 class="card-title">{{ $upcoming }}</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="col-md">
                <div class="card text-center text-white my-5" style="height: 180px; background-color: #7abecc">
                    <div class="card-header">
                        <h4 class="card-title">Ongoing Tasks</h4>
                    </div>
                    <div class="card-body d-flex justify-content-center align-items-center">
                        <h1 class="card-title">{{ $ongoing }}</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="col-md">
                <div class="card text-center text-white my-5" style="height: 180px; background-color: #7CD1C0;">
                    <div class="card-header">
                        <h4 class="card-title">Completed Tasks</h4>
                    </div>
                    <div class="card-body d-flex justify-content-center align-items-center">
                        <h1 class="card-title">{{ $completed }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.dashboard')
@include('extras.svg-dashboard')

@section('content')

<div class="row">
    <div class="col-2">
        <div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="height:98vh">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                <a class="navbar-brand ms-2" aria-current="page" href="/"><img src="{{ URL::asset('/images/logo.png' )}}" alt="brand logo" style="aspect-ratio:367/366;height:65px;width:80px;"></a>
                <span class="fs-4 fw-bold ms-2">Provider Dashboard</span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li>
                    <a href="{{ route('provider.dashboard') }}" class="nav-link link-dark">
                        <svg class="bi me-2" width="16" height="16">
                            <use xlink:href="#speedometer2" /></svg>
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('provider.task.list') }}" class="nav-link link-dark">
                        <svg class="bi me-2" width="16" height="16">
                            <use xlink:href="#table" /></svg>
                        Tasks
                    </a>
                </li>
            </ul>
            <hr>
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle"
                    id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ URL::asset('/images/person.jpg' )}}" alt="" width="32" height="32" class="rounded-circle me-2">
                    <strong>Account</strong>
                </a>
                <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                    <li><a class="dropdown-item" href="#">Profile</a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <form id="logOutForm" method="POST" action="{{ route('logout') }}">
                            @csrf
                        </form>
                        <a class="dropdown-item" href="#" onclick="logOut()">Sign out</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-10">
        <!-- <section class="py-5"> -->
        <!-- <div class="container my-5"> -->
        <div class="d-flex justify-content-center">
            <div class="mt-4">

            </div>
        </div>
        
        @yield('provider_content')

        <!-- </div> -->
        <!-- </section> -->
    </div>
</div>

<script type="text/javascript">
    (function () {
        'use strict'
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        tooltipTriggerList.forEach(function (tooltipTriggerEl) {
            new bootstrap.Tooltip(tooltipTriggerEl)
        })
    })()

    function logOut() {
        document.getElementById('logOutForm').submit();
        return false;
    }
</script>

@endsection

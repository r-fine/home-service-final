<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="{% static 'favicon.ico' %}" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
    <meta name="referrer" content="no-referrer-when-downgrade">
    <!-- CSS -->
    <link href="{{  asset('css/base.css') }}" rel="stylesheet" type="text/css" />
    <!-- JS -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body>

    <!-- Navbar Start -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" aria-current="page" href="{{ route('home') }}">
                <img src="{{URL::asset('/images/logo.png')}}" alt="brand logo"
                    style="aspect-ratio:367/366;height:65px;">
            </a>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link" href="#Footer">Links</a>
                    </li>
                    <!-- Navbar Dropdown Link for Service List -->
                    <li class="d-none d-lg-inline nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Categories
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @foreach ($categories as $cat)
                            <li class="dropdown-submenu">
                                @if ($cat->isParent())
                                <a class="dropdown-item">
                                    {{ $cat->title }} @if ($cat->hasChildren())<span class="text-muted"
                                        style="font-size: 0.8rem"><i class="bi bi-caret-right-fill"></i></span>@endif
                                </a>
                                <hr class="dropdown-divider" />
                                @if ($cat->hasChildren())
                                <ul class="dropdown-menu children">
                                    @foreach ($cat->children as $child)
                                    <a href="{{ route('category.list', $child) }}"
                                        class="dropdown-item">{{ $child->title }}</a>
                                    @endforeach
                                </ul>
                                @endif
                                @endif
                            </li>
                            @endforeach
                        </ul>
                    </li>
                    <!-- Search Bar -->
                    <li class="col-md-10 col-lg-7 col-xl-9 col-xxl-11">
                        <form method="GET" action="{{ route('search') }}" class="d-flex">
                            <input class="form-control me-2" name="q" type="search" placeholder="Find a service..."
                                aria-label="Search">
                            <button class="btn btn-outline-dark" type="submit" style="width: 120px;"><i
                                    class="bi bi-search"></i>Search</button>
                        </form>
                    </li>
                </ul>
                <!-- Navbar Dropdown for Accounts -->
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                class="bi bi-person-fill" viewBox="0 0 16 16">
                                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                            </svg>
                            <br>Account
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @if(Route::has('login'))
                            @auth
                            @if(Auth::user()->hasRole('admin'))
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                    Admin Dashboard
                                </a>
                            </li>
                            @elseif(Auth::user()->hasRole('s_provider'))
                            <li>
                                <a class="dropdown-item" href="{{ route('provider.dashboard') }}">
                                    Provider Dashboard
                                </a>
                            </li>
                            @else
                            <li>
                                <a class="dropdown-item" href="#">
                                    My Account
                                </a>
                            </li>
                            @endif
                            <!-- Logout Form -->

                            <form id="logOutForm" method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="dropdown-item" href="#" onclick="logOut()">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z" />
                                        <path fill-rule="evenodd"
                                            d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z" />
                                    </svg>
                                    Logout
                                </a>
                            </form>
                            @else
                            <!-- Login/Signup -->
                            <li>
                                <a class="dropdown-item" href="{{ route('login') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z" />
                                        <path fill-rule="evenodd"
                                            d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                                    </svg>
                                    Login
                                </a>
                            </li>
                            <hr class="dropdown-divider">
                            <li>
                                <a class="dropdown-item" href="{{ route('register') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-pen" viewBox="0 0 16 16">
                                        <path
                                            d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
                                    </svg>
                                    Sign Up
                                </a>
                            </li>
                            @endif
                            @endif
                        </ul>
                    </li>
                </ul>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
    <!-- navbar end -->

    <div style="position:fixed;right:1%;top:46%;">
        <a type="button" href="{{ route('order.create') }}"
            class="d-flex btn btn-warning justify-content-center align-items-center" id="Order"
            style="height: 75px;width: 75px;">
            <sup class="text-danger fw-bold p-0 m-0 fs-6">{{ $item_count }}</sup>
            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-bag-x me-1"
                viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M6.146 8.146a.5.5 0 0 1 .708 0L8 9.293l1.146-1.147a.5.5 0 1 1 .708.708L8.707 10l1.147 1.146a.5.5 0 0 1-.708.708L8 10.707l-1.146 1.147a.5.5 0 0 1-.708-.708L7.293 10 6.146 8.854a.5.5 0 0 1 0-.708z" />
                <path
                    d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
            </svg>
        </a>
    </div>

    <div id="start-from-navbar">
        @yield('content')
    </div>

    <footer id="Footer" class="text-center text-lg-start bg-light text-muted">
        <section class="d-flex justify-content-center p-4 border-bottom">
            <div class="me-5 d-none d-lg-block">
                <span>Get connected with us on social networks:</span>
            </div>
            <div>
                <a href="" class="me-4 text-reset"><i class="bi bi-facebook"></i></a>
                <a href="" class="me-4 text-reset"><i class="bi bi-twitter"></i></a>
                <a href="" class="me-4 text-reset"><i class="bi bi-google"></i></a>
                <a href="" class="me-4 text-reset"><i class="bi bi-instagram"></i></a>
                <a href="" class="me-4 text-reset"><i class="bi bi-linkedin"></i></a>
                <a href="" class="me-4 text-reset"><i class="bi bi-github"></i></a>
            </div>
        </section>
        <section class="">
            <div class="container text-center text-md-start mt-5">
                <div class="row mt-3">
                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                        <h6 class="text-uppercase fw-bold mb-4"><i class="bi bi-gem"></i> Home Service 470</h6>
                    </div>
                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                        <h6 class="text-uppercase fw-bold mb-4">Products</h6>
                        <p><a href="https://www.laravel.com/" class="text-decoration-none text-reset">Laravel</a></p>
                        <p><a href="https://getbootstrap.com" class="text-decoration-none text-reset">Bootstrap</a></p>
                        <p><a href="https://jquery.com" class="text-decoration-none text-reset">jQuery</a></p>
                        <p><a href="https://www.mariadb.org/" class="text-decoration-none text-reset">MariaDB</a></p>
                    </div>
                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                        <h6 class="text-uppercase fw-bold mb-4">Useful links</h6>
                        <p><a href="#!" class="text-decoration-none text-reset">Pricing</a></p>
                        <p><a href="#!" class="text-decoration-none text-reset">Settings</a></p>
                        <p><a href="#!" class="text-decoration-none text-reset">Orders</a></p>
                        <p><a href="#!" class="text-decoration-none text-reset">Help</a></p>
                    </div>
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                        <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
                        <p><i class="bi bi-house-fill"></i> Rd No. 27, Dhaka 1209</p>
                        <p><i class="bi bi-envelope-fill"></i> info@example.com</p>
                        <p><i class="bi bi-telephone-fill"></i> + 880 123 456 77</p>
                        <p><i class="bi bi-file-earmark-break"></i> + 880 123 456 78</p>
                    </div>
                </div>
            </div>
        </section>
        <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
            © 2022 Copyright:
            <a class="text-reset text-decoration-none fw-bold" href="#">www.mywebsite.com</a>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script type="text/javascript">
        function logOut() {
            document.getElementById('logOutForm').submit();
            return false;
        }

    </script>
</body>

</html>

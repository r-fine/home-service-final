@extends('../layouts/base')
@section('title', 'Home')

@section('content')

<section class="mt-5 pt-5" style="min-height:84vh">
    <div class="mx-auto mt-5 pt-5" style="max-width: 425px; margin-top:100px;">
        <h1 class="text-center text-primary">Sign In</h1>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control @error('email') border border-danger @enderror"
                    placeholder="e.g. name@example.com" value="{{ old('email') }}" required autofocus />
            </div>
            <div class="form-group mt-4">
                <label for="password">Password</label>
                <input type="password" name="password"
                    class="form-control @error('password') border border-danger @enderror"
                    placeholder="enter your password" required autocomplete="current-password" />
            </div>
            <div class="form-group mt-4">
                <label for="remember_me">
                    <input type="checkbox" class="form-check-input" name="remember">
                    <span>Remember me</span>
                </label>
            </div>
            <div class="row justify-content-xs-center mt-3 mx-auto">
                <button class="btn btn-secondary" type="submit">Sign In &raquo;</button>
            </div>
            <hr>
            <div class="text-right">
                @if (Route::has('password.request'))
                <a class="button" href="{{ route('password.request') }}">Forgot Password?</a>
                @endif
            </div>
            <div class="text-left">
                Don't have an account? <a href="{{ route('register') }}">Sign up here</a>
            </div>
        </form>
    </div>
</section>
@endsection

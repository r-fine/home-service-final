@extends('../layouts/base')
@section('title', 'Register User')

@section('content')

<section class="mt-5 pt-5" style="min-height:84vh">
    <div class="mx-auto mt-5 pt-5" style="max-width: 425px; margin-top:100px;">

        <h1 class="text-center text-primary">Register</h1>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <label for="name">Username:<span class=text-danger>*</span></label>

                <input type="name" name="name" class="form-control @error('name') border border-danger @enderror"
                    placeholder="enter username" value="{{ old('name') }}" required autofocus />
                @error('name')
                <div class="fs-6 text-danger mt-2">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group mt-4">
                <label for="email">Email:<span class=text-danger>*</span></label>

                <input type="email" name="email" class="form-control @error('email') border border-danger @enderror"
                    placeholder="e.g. name@example.com" value="{{ old('email') }}" required />
                @error('email')
                <div class="fs-6 text-danger mt-2">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group mt-4">
                <label for="password">Password:<span class=text-danger>*</span></label>
                <input type="password" name="password"
                    class="form-control @error('password') border border-danger @enderror"
                    placeholder="enter your password" required autocomplete="new-password" />
                @error('password')
                <div class="fs-6 text-danger mt-2">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group mt-4">
                <label for="password_confirmation">Confirm Password:<span class=text-danger>*</span></label>
                <input type="password" name="password_confirmation"
                    class="form-control @error('password_confirmation') border border-danger @enderror"
                    placeholder="rewrite password" required />
                @error('password_confirmation')
                <div class="fs-6 text-danger mt-2">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group mt-4">
                <label for="role_id">Register as:</label>
                <select name="role_id" class="form-control">
                    <option value="customer">customer</option>
                    <option value="s_provider">Service Provider</option>
                </select>
            </div>

            <div class="row justify-content-xs-center mt-3 mx-auto">
                <button class="btn btn-secondary" type="submit">Sign Up &raquo;</button>
            </div>

            <div class="d-flex justify-content-start mt-4">
                <span>Already registered?
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                        sign in here
                    </a>
                </span>
            </div>
        </form>
    </div>
</section>
@endsection

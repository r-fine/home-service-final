@extends('../layouts/base')
@section('title', 'Forgot Password')

@section('content')

<section class="mt-5 pt-5" style="min-height:84vh">
    <div class="mx-auto mt-5 pt-5" style="max-width: 425px; margin-top:100px;">

        <div class="mb-4 text-sm text-muted">
            Forgot your password? No problem. Just let us know your email address and we will email you a password reset
            link that will allow you to choose a new one.
        </div>

        <x-auth-session-status class="tw-mb-4" :status="session('status')" />

        <x-auth-validation-errors class="tw-mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="form-group">
                <label for="email">Email:</label>

                <input class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus />
            </div>

            <div class="row justify-content-xs-center mt-3 mx-auto">
                <button class="btn btn-secondary" type="submit">Email Password Reset Link</button>
            </div>
        </form>
    </div>
</section>
@endsection

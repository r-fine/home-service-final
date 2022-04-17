@extends('../layouts/base')
@section('title', 'Reset Password')

@section('content')

<section class="mt-5 pt-5" style="min-height:84vh">
    <div class="mx-auto mt-5 pt-5" style="max-width: 425px; margin-top:100px;">

        <h1 class="text-center text-primary">Reset Password</h1>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="form-group">
                <label for="email">Email:</label>

                <input class="form-control" type="email" name="email" value="{{ old('email', $request->email) }}"
                    required autofocus />
            </div>

            <div class="form-group mt-4">
                <label for="password">Password</label>

                <input class="form-control" type="password" name="password" required />
            </div>

            <div class="form-group mt-4">
                <label for="password_confirmation">Confirm Password</label>

                <input class="form-control" type="password" name="password_confirmation" required />
            </div>

            <div class="row justify-content-xs-center mt-3 mx-auto">
                <button class="btn btn-secondary" type="submit">Reset Password</button>
            </div>
        </form>
    </div>
</section>
@endsection

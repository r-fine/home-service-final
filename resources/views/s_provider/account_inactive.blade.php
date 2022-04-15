@extends('../layouts/dashboard')
@section('title', 'Wait for activation')

@section('content')
<section class="mt-5 pt-5" style="min-height:84vh">
    <div class="border border-danger mx-auto mt-5 pt-5" style="max-width: 425px; margin-top:100px;">
        <div class="mx-5 mb-5 mt-2">
            <h1 class="text-center text-primary">Account is not activated</h1>
            <p>Please wait...</p>
            <p>Our admin will activate your account shortly.</p>
            <p>You can edit your submiited form <a href="{{ route('s_provider.edit', $profile) }}">here</a></p>
        </div>
    </div>
</section>
@endsection

@extends('../layouts/dashboard')
@section('title', 'Create Profile')

@section('content')
<section class="my-2 pt-3">
    <div class="mx-auto mb-5" style="max-width: 550px;">
        <hr>
        <h1 class="text-center text-primary mb-3">Create Profile</h1>
        <hr>
        {{-- <x-show-error /> --}}
        <form method="POST" action="{{ route('s_provider.store') }}" enctype="multipart/form-data">
            @csrf
            @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ Session::get('success') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <div class="form-group my-2">
                <label for="category_id">Providing Service</label>
                <select name="category_id" class="form-control @error('category_id') border border-danger @enderror">
                    <option value=""> -- Select One --</option>
                    @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : null }}>{{ $cat->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group my-2">
                <label for="profile_pic">Profile Picture<span class=text-danger>*</span></label>
                <input type="file" name="profile_pic" id=""
                    class="form-control @error('profile_pic') border border-danger @enderror"
                    placeholder="profile_pic" value="{{ old('profile_pic') }}" />
                @error('profile_pic')
                <div class="fs-6 text-danger mt-2">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group my-2">
                        <label for="first_name">Full name<span class=text-danger>*</span></label>
                        <input type="text" name="first_name" id=""
                            class="form-control @error('first_name') border border-danger @enderror"
                            placeholder="" value="{{ old('first_name') }}" />
                        @error('first_name')
                        <div class="fs-6 text-danger mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group my-2">
                        <label for="last_name">Full name<span class=text-danger>*</span></label>
                        <input type="text" name="last_name" id=""
                            class="form-control @error('last_name') border border-danger @enderror"
                            placeholder="" value="{{ old('last_name') }}" />
                        @error('last_name')
                        <div class="fs-6 text-danger mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group my-2">
                <label for="phone">Phone number<span class=text-danger>*</span></label>
                <input type="text" name="phone" id=""
                    class="form-control @error('phone') border border-danger @enderror" placeholder="e.g. 01xxxxxxxxx"
                    value="{{ old('phone') }}" />
                @error('phone')
                <div class="fs-6 text-danger mt-2">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group my-2">
                <label for="address_line">Address line 1<span class=text-danger>*</span></label>
                <input type="text" name="address_line" id=""
                    class="form-control @error('address_line') border border-danger @enderror"
                    placeholder="Enter address" value="{{ old('address_line') }}" />
                @error('address_line')
                <div class="fs-6 text-danger mt-2">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group my-2">
                <label for="address_line_2">Address line 2</label>
                <input type="text" name="address_line_2" id=""
                    class="form-control @error('address_line_2') border border-danger @enderror"
                    placeholder="(optional)" value="{{ old('address_line_2') }}" />
                @error('address_line_2')
                <div class="fs-6 text-danger mt-2">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="row justify-content-xs-center mt-3 mx-auto">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            @auth
            @if(Auth::user()->hasRole('s_provider') && Auth::user()->is_verified == 0)
            <div class="row justify-content-xs-center mt-3 mx-auto text-danger fw-bold fs-6">
                * Please complete your profile by submitting this form
            </div>
            @endif
            @endauth

        </form>
    </div>
</section>

@endsection

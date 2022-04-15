@extends('../layouts/admin_dashboard')
@section('title', 'Edit order')

@section('admin_content')
<div class="container my-5">
    <main>
        <div class="row g-5 mt-5 pt-5 justify-content-center">
            <div class="col" style="max-width: 440px;">
                <hr>
                <h1 class="text-center text-primary mb-3">Assign Provider</h1>
                <hr>
                <form method="POST" action="{{ route('admin.order.item.assign.provider', $item) }}">
                    @csrf
                    @method('PUT')
                    @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ Session::get('success') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <div class="form-group my-2">
                        <label for="provider_id">Assign Provider</label>
                        <select name="provider_id" id=""
                            class="form-control @error('provider_id') border border-danger @enderror">
                            @if ($item->provider)
                            <option value="{{ $item->provider->id }}">{{ $item->provider->getFullName() }} ({{ $item->provider->id }})</option>
                            @else
                            <option value=""> -- Select One --</option>
                            @endif
                            @foreach ($providers as $provider)
                            <option value="{{ $provider->id }}">{{ $provider->getFullName() }} ({{ $provider->id }})
                            </option>
                            @endforeach
                        </select>
                        @error('provider_id')
                        <div class="fs-6 text-danger mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <hr class="my-4">
                    <button class="w-100 btn btn-secondary btn-lg" type="submit">save</button>
                </form>
            </div>
        </div>
    </main>
</div>
@endsection

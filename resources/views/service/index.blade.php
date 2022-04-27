@extends('../layouts/admin_dashboard')
@section('title', 'Service List')

@section('admin_content')

<div class="container my-5">
    <div class="container px-4 px-lg-5 mt-5">
        <hr>
        <h1 class="text-center text-primary mb-3">Service List</h1>
        <hr>
        <x-message-success />
        <div>
            <span class="d-flex justify-content-end mt-2">
                <a href="{{ route('admin.services.create') }}" class="btn btn-sm btn-primary fs-6">
                    Add <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-plus-lg" viewBox="0 0 16 16" data-darkreader-inline-fill=""
                        style="--darkreader-inline-fill:currentColor;">
                        <path fill-rule="evenodd"
                            d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z">
                        </path>
                    </svg>
                </a>
            </span>
        </div>
        <hr>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Category</th>
                    <th scope="col">Title</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($services as $service)
                <tr>
                    <td><img src="{{ asset('images/service/' . $service->image) }}" alt="image" style="height:30px; width:50px"></td>
                    <td>{{ $service->category->title }}</td>
                    <td>{{ $service->title }}</td>
                    <td>
                        <a href="{{ route('admin.services.edit', $service) }}">
                            <i class="bi bi-pencil-square fs-5"></i>
                        </a>
                    </td>
                    <td>
                        <form method="POST" action="{{ route('admin.services.destroy', $service) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-link text-danger"><i class="bi bi-trash fs-5"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="container mt-4">
            {{ $services->links() }}
        </div>
    </div>
</div>
</section>

@endsection

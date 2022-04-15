@extends('../layouts/admin_dashboard')
@section('title', 'Category List')

@section('admin_content')

<div class="container my-5">
    <div class="container px-4 px-lg-5 mt-5">
        <hr>
        <h1 class="text-center text-primary mb-3">Category List</h1>
        <hr>
        <div>
            <span class="d-flex justify-content-end mt-2">
                <a href="{{ route('admin.categories.create') }}" class="btn btn-sm btn-primary fs-6">
                    <i class="bi bi-plus fs-5">Add</i>
                    </svg>
                </a>
            </span>
        </div>
        <hr>
        @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ Session::get('success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Title</th>
                    <th scope="col">Is root</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $cat)
                <tr>
                    <td><img src="{{ asset('images/category/' . $cat->image) }}" alt="image" width="50px"></td>
                    <td>{{ $cat->title }}</td>
                    <td>{{ $cat->isRoot() }}</td>
                    <td>
                        <a href="{{ route('admin.categories.edit', $cat) }}">
                            <i class="bi bi-pencil-square fs-5"></i>
                        </a>
                    </td>
                    <td>
                        <form method="POST" action="{{ route('admin.categories.destroy', $cat) }}">
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
            {{ $categories->links() }}
        </div>
    </div>
    </section>

    @endsection

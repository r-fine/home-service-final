@extends('../layouts/admin_dashboard')
@section('title', 'Provider\'s List')

@section('admin_content')
<div class="container my-5">
    <div class="container px-4 px-lg-5 mt-5">
        <hr>
        <h1 class="text-center text-primary mb-3">Service Provider's List</h1>
        <hr>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Id</th>
                    <th scope="col">Full Name</th>
                    <th scope="col">Department</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Address</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($providers as $provider)
                <tr>
                    <td><img src="{{ asset('images/s_provider/' . $provider->profile_pic) }}" alt="image" style="height:50px; width:50px"></td>
                    <td>{{ $provider->id }}</td>
                    <td>{{ $provider->getFullName() }}</td>
                    <td>{{ $provider->category->title }}</td>
                    <td>{{ $provider->phone }}</td>
                    <td>{{ $provider->getFullAddress() }}</td>
                    <td>
                        <form method="POST" action="{{ route('admin.s_provider.destroy', $provider) }}">
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
            {{ $providers->links() }}
        </div>
    </div>
</div>
@endsection
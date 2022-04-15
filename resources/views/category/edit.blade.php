@extends('../layouts/admin_dashboard')
@section('title', 'Add Category')

@section('admin_content')
<section class="my-2 pt-3">
    <div class="mx-auto mb-5" style="max-width: 550px;">
        <hr>
        <h1 class="text-center text-primary mb-3">Edit Category</h1>
        <hr>
        {{-- <x-show-error /> --}}
        <form method="POST" action="{{ route('admin.categories.update', $category) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ Session::get('success') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <div class="form-group my-2">
                <label for="parent_id">Parent category</label>
                <select name="parent_id" id="" class="form-control @error('parent_id') border border-danger @enderror">
                    @if (!$category->parent_id)
                    <option value=""> -- Select One --</option>
                    @else
                    <option value="{{ $category->parent->id }}">{{ $category->parent->title }}</option>
                    @endif
                    @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group my-2">
                <label for="title">Category title<span class=text-danger>*</span></label>
                <input type="text" name="title" id=""
                    class="form-control @error('title') border border-danger @enderror"
                    placeholder="category name" value="{{ $category->title }}" />
                @error('title')
                <div class="fs-6 text-danger mt-2">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group my-2">
                <label for="description">Category description<span class=text-danger>*</span></label>
                <textarea class="form-control @error('description') border border-danger @enderror" name="description" id="" cols="30" rows="10" placeholder="write description here...">{{ $category->description }}</textarea>
                @error('description')
                <div class="fs-6 text-danger mt-2">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group my-2">
                <label for="image">Image<span class=text-danger>*</span></label>
                <input type="file" name="image" id=""
                    class="form-control @error('image') border border-danger @enderror"
                    placeholder="image" value="" />
                @error('image')
                <div class="fs-6 text-danger mt-2">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="row justify-content-xs-center mt-3 mx-auto">
                <button type="submit" class="btn btn-secondary">Save</button>
            </div>
        </form>
    </div>
</section>

@endsection

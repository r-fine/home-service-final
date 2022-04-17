@extends('../layouts/base')
@section('title', $title)

@section('content')
<section class="pb-5">
    <div class="container px-4 px-lg-5 mt-5 pt-4">
        <div class="container mb-4">
            <div class="row justify-content-start">
                <div class="col-9 col-sm-4">
                    <span class="text-primary fs-4 fs-sm-3 fw-bold">All {{ $category->title }}</span>
                    <hr class="d-sm-none">
                </div>
            </div>
        </div>
        
        <x-product-card :services="$services" />

        <div class="container">
            {{ $services->links() }}
        </div>
    </div>
</section>
@endsection

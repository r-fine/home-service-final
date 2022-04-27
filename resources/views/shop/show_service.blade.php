@extends('../layouts/base')
@section('title', $title)

@section('content')
<div class="container">
    <div
        class="row g-3 mx-3 px-3 mx-sm-3 px-sm-3 mx-md-5 px-md-5 mx-lg-5 px-lg-5 mt-3 pt-3 mt-sm-3 pt-sm-3 mt-md-5 pt-md-5 mt-lg-5 pt-lg-5">
        <div class="col-md-5 ps-3 col-lg-5 order-md-last p-0 order-1">
            <div class="d-grid gap-2">
                @if (Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ Session::get('success') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <a href="{{ route('order.add.to.order', $service) }}" class="btn btn-primary fs-6 mx-md-4 mt-1 mb-3">
                    <i class="bi bi-plus-square-fill"></i> Book this service
                </a>
                <button type="button" class="btn btn-outline-success mx-md-4">
                    <i class="bi bi-star-fill"></i> Add to Favorites
                </button>
                <hr>

                <div class="accordion mt-4" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                Description
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                {!! $service->description !!}
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Pricing
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                {!! $service->pricing !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7 col-lg-7 p-0">
            <div class="card mb-3 border-0">
                <div class="row g-0">
                    <div class="col-md-12">
                        <div class="card-body p-1">
                            <h1 class="mb-0 h2 px-4 pt-2 pb-4">{{ $service->title }}</h1>
                            <div class="bg-light"><img class="img-fluid mx-auto d-block" width="400px" height="400px"
                                    alt="Responsive image" src="{{ asset('images/service/' . $service->image) }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div
        class="row g-3 mx-3 px-3 mx-sm-3 px-sm-3 mx-md-5 px-md-5 mx-lg-5 px-lg-5 mb-3 pb-3 mb-sm-3 pb-sm-3 mb-md-3 pb-md-3 mb-lg-3 pb-lg-3">
        <div class="col">
            <div data-bs-spy="scroll" data-bs-target="#navbar-example3" data-bs-offset="0" tabindex="0">
                <div class="col-8">
                    <div class="d-flex justify-content-between mt-5">
                        <div>
                            <h3 class="text-primary fw-bold" id="item-2">#Reviews:</h3>
                        </div>
                        <div>
                            @if ($my_review)
                            <button type="button" class="btn btn-sm btn-outline-primary me-4 mt-1"
                                onclick="return confirm('You have already reviewed this service. Please delete and submit another one if you want to update your review.')">
                                write a review
                            </button>
                            @else
                            <button type="button" class="btn btn-sm btn-outline-primary me-4 mt-1"
                                data-bs-toggle="modal" data-bs-target="#createModal">
                                write a review
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
                <p>
                    @if ($my_review)
                    <div class="alert alert-@if ($service->avgReviewRating() >= 3)success
                        @elseif ($service->avgReviewRating() < 3)danger
                        @endif" style="width: 15%;">
                        <h2>
                            <span class="text-warning"><i class="bi bi-star-fill"></i></span>
                            {{ $service->avgReviewRating() }}
                        </h2> <span class="ms-4 ps-2">out of 5</span>
                    </div>
                    @endif
                </p>

                <!-- Form modal for creating ReviewRating -->
                <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title fw-bold" id="createModalLabel">Submit a review</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('review.store', $service) }}">
                                    @csrf
                                    @if (Session::has('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>{{ Session::get('success') }}</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                    @endif
                                    <div class="d-flex justify-content-between">
                                        <div class="form-group">
                                            <label for="rating">Rating<span class=text-danger>*</span></label>
                                        </div>
                                        <div class="me-4">
                                            <ul>
                                                <li style="display: inline-block"><input type="radio" name="rating"
                                                        value=1>
                                                    <label for="rating">1</label><br></li>
                                                <li style="display: inline-block"><input type="radio" name="rating"
                                                        value=2>
                                                    <label for="rating">2</label><br></li>
                                                <li style="display: inline-block"><input type="radio" name="rating"
                                                        value=3>
                                                    <label for="rating">3</label></li>
                                                <li style="display: inline-block"><input type="radio" name="rating"
                                                        value=4>
                                                    <label for="rating">4</label></li>
                                                <li style="display: inline-block"><input type="radio" name="rating"
                                                        value=5>
                                                    <label for="rating">5</label></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="form-group my-2">
                                        <label for="title">Review title<span class=text-danger>*</span></label>
                                        <input type="text" name="title" id=""
                                            class="form-control @error('title') border border-danger @enderror"
                                            placeholder="" value="{{ old('title') }}" />
                                        @error('title')
                                        <div class="fs-6 text-danger mt-2">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group my-2">
                                        <label for="description">Review description</label>
                                        <textarea
                                            class="form-control @error('description') border border-danger @enderror"
                                            name="description" id="" cols="30" rows="10"
                                            placeholder="write feedback here...">{{ old('description') }}</textarea>
                                        @error('description')
                                        <div class="fs-6 text-danger mt-2">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    @guest
                                    <span class="text-danger">please <a href="{{ route('login') }}">login in</a> to
                                        review</span>
                                    @endguest
                                    @auth
                                    @if ($reviewable)
                                    <div class="row justify-content-center mx-auto">
                                        <button class="btn btn-primary mt-3" type="submit">Submit Review</button>
                                    </div>
                                    @else
                                    <span class="text-danger">You need purchase this order first to review</span>
                                    @endif
                                    @endauth
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-8">

                        @if ($my_review)
                        <h4>My Review:</h4>
                        <div class="list-group-item list-group-item-action my-2">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">Reviewed by: {{ $my_review->user->name }}</h5>
                                <small class="text-muted">
                                    on:
                                    {{ $my_review->created_at }}
                                </small>
                            </div>
                            <div class="d-flex justify-content-start">
                                <div>
                                    <p class="mb-1">
                                        <x-rating-stars :review="$my_review" />
                                    </p>
                                </div>
                            </div>
                            <p class="mb-1"><span class="fs-4 fw-bold">"</span>{{ $my_review->title }}<span
                                    class="fs-4 fw-bold">"</span>
                            </p>
                            <p class="mb-1">
                                {{ $my_review->description }}
                            </p>
                            <div class="d-flex justify-content-end">
                                <form method="POST" action="{{ route('review.destroy', $my_review) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger"
                                        onclick="return confirm('Are you sure you want to delete this review?')"
                                        style="padding: .25rem .4rem; font-size: .875rem; line-height: .5; border-radius: .2rem;">
                                        delete
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endif
                        <div class="overflow-auto mt-5" style="height: 800px;">
                            <div class="d-flex justify-content-between me-3">
                                <div>
                                    <h4>All Reviews:</h4>
                                </div>
                                <div>(Total {{ $service->countReviewRating() }}
                                    {{ Str::plural('review', $service->countReviewRating()) }})
                                </div>
                            </div>
                            @forelse ($all_reviews as $review)
                            <div class="list-group my-3">
                                <div class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">Reviewed by: {{ $review->user->name }}</h5>
                                        <small class="text-muted">on:
                                            {{ $review->created_at }}
                                    </div>
                                    <div class="d-flex justify-content-start">
                                        <div>
                                            <p class="mb-1">
                                                <x-rating-stars :review="$review" />
                                            </p>
                                        </div>
                                    </div>
                                    <p class="mb-1"><span class="fs-4 fw-bold">"</span>{{ $review->title }}<span
                                            class="fs-4 fw-bold">"</span>
                                    </p>
                                    <p class="mb-1">
                                        {{ $review->description }}
                                    </p>
                                    @guest
                                    <div></div>
                                    @endguest
                                    @auth
                                    @if (Auth::user()->hasRole('admin'))
                                    <div class="d-flex justify-content-end">
                                        <form method="POST" action="{{ route('review.destroy', $review) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger"
                                                onclick="return confirm('Are you sure you want to delete this review?')"
                                                style="padding: .25rem .4rem; font-size: .875rem; line-height: .5; border-radius: .2rem;">
                                                delete
                                            </button>
                                        </form>
                                    </div>
                                    @endif
                                    @endauth
                                </div>
                            </div>
                            @empty
                            @if ($my_review)
                            <div class="alert alert-secondary text-center me-5">
                                This service has no other review yet
                            </div>
                            @else
                            <div class="alert alert-secondary text-center me-5">
                                This service has no review yet
                            </div>
                            @endif
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

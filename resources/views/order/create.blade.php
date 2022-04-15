@extends('../layouts/base')
@section('title', 'Place order')

@section('content')
<div class="container my-5">
    <main>
        <div class="row g-5 mt-5 pt-5 justify-content-center">
            <div class="col-md-5 col-lg-4 order-md-last">
                @if (Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ Session::get('success') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-primary">Order List</span>
                    <span class="badge bg-primary rounded-pill">{{ $item_count }}</span>
                </h4>
                <ul class="list-group mb-3">
                    @forelse ($order_items as $item)
                    <li class="list-group-item d-flex justify-content-between lh-sm">
                        <div>
                            <h6 class="text-dark my-2">{{ $loop->iteration }}. {{ $item->service->title }}</h6>
                        </div>
                        <a class="text-danger my-2" href="{{ route('order.remove.from.order', $item) }}">
                            <i class="bi bi-trash-fill"></i>
                        </a>
                    </li>
                    @empty
                    <div class="alert alert-danger">
                        Your order list is empty!
                    </div>
                    @endforelse
                </ul>
            </div>
            <div class="col-md-7 col-lg-8" style="max-width: 660px;">
                <h4 class="text-primary fw-bold fs-3 mb-3">Billing address</h4>
                <form method="POST" action="{{ route('order.store') }}">
                    @csrf
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="first_name">First name<span class=text-danger>*</span></label>
                                <input type="text" name="first_name"
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
                            <div class="form-group">
                                <label for="last_name">Last name<span class=text-danger>*</span></label>
                                <input type="text" name="last_name"
                                    class="form-control @error('last_name') border border-danger @enderror"
                                    placeholder="" value="{{ old('last_name') }}" />
                                @error('last_name')
                                <div class="fs-6 text-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="phone">Phone number<span class=text-danger>*</span></label>
                                <input type="text" name="phone"
                                    class="form-control @error('phone') border border-danger @enderror" placeholder=""
                                    value="{{ old('phone') }}" />
                                @error('phone')
                                <div class="fs-6 text-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="email">Email address<span class=text-danger>*</span></label>
                                <input type="email" name="email"
                                    class="form-control @error('email') border border-danger @enderror" placeholder=""
                                    value="{{ old('email') }}" />
                                @error('email')
                                <div class="fs-6 text-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="address_line">Address line 1<span class=text-danger>*</span></label>
                                <input type="text" name="address_line"
                                    class="form-control @error('address_line') border border-danger @enderror"
                                    placeholder="" value="{{ old('address_line') }}" />
                                @error('address_line')
                                <div class="fs-6 text-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="address_line_2">Address line 2</label>
                                <input type="text" name="address_line_2"
                                    class="form-control @error('address_line_2') border border-danger @enderror"
                                    placeholder="" value="{{ old('address_line_2') }}" />
                                @error('address_line_2')
                                <div class="fs-6 text-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="town_city">Town/City<span class="text-danger">*</span></label>
                                <select name="town_city"
                                    class="form-control @error('town_city') border border-danger @enderror">
                                    <option value=""> -- Select One --</option>
                                    @foreach ($town_cities as $town_city)
                                    <option value="{{ $town_city }}"
                                        {{ old('town_city') == $town_city ? 'selected' : null }}>
                                        {{ $town_city }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('town_city')
                                <div class="fs-6 text-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="date" class="form-label my-0">Delivery date<span
                                    class="text-danger">*</span></label>
                            <input type="date" min="" max="" name="date" class="form-control" value="{{ old('date') }}">
                            @error('date')
                            <div class="fs-6 text-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="time">Delivery time<span class="text-danger">*</span></label>
                                <select name="time" class="form-control @error('time') border border-danger @enderror">
                                    <option value=""> -- Select One --</option>
                                    @foreach ($times as $time)
                                    <option value="{{ $time }}" {{ old('time') == $time ? 'selected' : null }}>
                                        {{ $time }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('time')
                                <div class="fs-6 text-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">
                    @if ($item_count)
                    <button class="w-100 btn btn-primary btn-lg" type="submit">Place Order</button>
                    @endif
                </form>
            </div>
        </div>
    </main>
</div>
@endsection

@extends('../layouts/admin_dashboard')
@section('title', 'Edit order')

@section('admin_content')
<div class="container my-5">
    <main>
        <div class="row g-5 mt-5 pt-5 justify-content-center">
            <div class="col" style="max-width: 660px;">
                <hr>
                <h1 class="text-center text-primary mb-3">Edit billing address</h1>
                <hr>
                <form method="POST" action="{{ route('admin.order.update', $order) }}">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="first_name">First name<span class=text-danger>*</span></label>
                                <input type="text" name="first_name"
                                    class="form-control @error('first_name') border border-danger @enderror"
                                    placeholder="" value="{{ $order->first_name }}" />
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
                                    placeholder="" value="{{ $order->last_name }}" />
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
                                    value="{{ $order->phone }}" />
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
                                    value="{{ $order->email }}" />
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
                                    placeholder="" value="{{ $order->address_line }}" />
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
                                    placeholder="" value="{{ $order->address_line_2 }}" />
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
                                    @foreach ($town_cities as $town_city)
                                    <option value="{{ $order->town_city }}">
                                        {{ $order->town_city }}
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
                            <input type="date" min="" max="" name="date" class="form-control"
                                value="{{ \Carbon\Carbon::parse($order->date)->format('Y-m-d') }}">
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
                                    @foreach ($times as $time)
                                    <option value="{{ $order->time }}">
                                        {{ $order->time }}
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
                    <button class="w-100 btn btn-secondary btn-lg" type="submit">Update</button>
                </form>
            </div>
        </div>
    </main>
</div>
@endsection

@extends('../layouts/base')
@section('title', 'Order history')

@section('content')
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ Session::get('success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div class="fw-bolder fs-3 text-secondary">Order History</div>

        @foreach ($orders as $order)
        <div class="card my-3">
            <div class="card-header d-flex">
                <div>Order <span class="text-primary">#{{ $order->order_number }}</span></div>
                <div class="ms-auto"><span class="fw-bold">Placed on:</span>
                    {{ \Carbon\Carbon::parse($order->created_at)->format('d-m-Y') }}</div>
            </div>
            <div class="card-body bg-light">
                @foreach ($order->order_items as $item)
                <div class="d-flex align-items-center">
                    <div><img class="me-3" src="{{ asset('images/service/' . $item->service->image) }}" alt="s img"
                            width="50px" height="50px">
                    </div>
                    <div>{{ $item->service->title }}</div>
                    <div class="badge rounded-pill ms-auto me-3 bg-@if ($item->status == 'Pending')secondary
                        @elseif($item->status == 'Accepted')primary
                        @elseif ($item->status == 'Preparing')info
                        @elseif ($item->status == 'Completed')success
                        @elseif ($item->status == 'Cancelled')danger
                        @endif">
                        {{ $item->status }}
                    </div>
                    @if ($item->status == 'Pending' || $item->status == 'Accepted' || $item->status == 'Preparing')
                    <div>
                        <a href="{{ route('order.cancel', $item) }}" type="button" class="btn btn-sm btn-outline-danger"
                            onclick="return confirm('Are you sure you want to cancel this order?')">
                            cancel
                        </a>
                    </div>
                    @else
                    <div class="ms-5"></div>
                    <div class="ms-3"></div>
                    @endif
                </div>
                <p class="card-text"></p>
                @endforeach
            </div>
            <div class="card-footer text-muted d-flex">
                <span class="fw-bold ms-auto">Estimated Delivery:
                </span>{{ \Carbon\Carbon::parse($order->date)->format('d-m-Y') }} {{ $order->time }}
            </div>
        </div>
        @endforeach
    </div>
</section>
@endsection

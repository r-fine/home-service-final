@extends('layouts.s_provider_dashboard')
@section('title', 'My tasks')

@section('provider_content')
<section class="py-5 mx-0">
    <div class="container my-5">
        <hr>
        <h1 class="text-center text-primary mb-3">Task List</h1>
        <hr>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Order number</th>
                    <th scope="col">My task</th>
                    <th scope="col">Phone no</th>
                    <th scope="col">Area</th>
                    <th scope="col">Delivery date</th>
                    <th scope="col">Delivery time</th>
                    <th scope="col">Status</th>
                    <th scope="col">Mark as</th>
                    <th scope="col">Last updated</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                <tr>
                    <td>{{ $task->order->order_number }}</td>
                    <td>{{ $task->service->title }}</td>
                    <td>{{ $task->order->phone }}</td>
                    <td>{{ $task->order->town_city }}</td>
                    <td>{{ \Carbon\Carbon::parse($task->order->date)->format('d-m-Y') }}</td>
                    <td>{{ $task->order->time }}</td>
                    <td><span class="badge rounded-pill bg-light text-dark fs-6">{{ $task->status }}</span></td>
                    <td>
                        @if ($task->status == 'Completed')
                        <a href="#" type="button"
                            class="btn btn-sm btn-outline-success">undo</a>
                        @else
                        <a href="{{ route('provider.order.complete', $task) }}" type="button"
                            class="btn btn-sm btn-outline-primary">completed</a>
                        @endif
                    </td>
                    <td>{{ \Carbon\Carbon::parse($task->updated_at)->format('d-m-Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
@endsection

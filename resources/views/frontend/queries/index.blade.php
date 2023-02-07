@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('frontend/css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/order-table.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/vendor/libs/datatable/datatables.min.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="main-body my-4">

            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    @include('frontend.user.sidebar')
                </div>
                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-body order-table">
                            <div class="bg-primary d-flex justify-content-between align-items-center py-3 px-2">
                                <h3 class="text-light mb-0">Queries</h3>
                                <a class="nav-link bg-dark text-light mb-0"
                                    href="{{ route('frontend.user.queries.add') }}">Create</a>
                            </div>
                            <table id="queries_table" class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Order ID</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($queries as $index => $item)
                                        <tr>
                                            <td>
                                                {{ $index + 1 }}
                                            </td>
                                            <td>{{ $item->title }}</td>
                                            <td class="text-uppercase">{{ $item->type }}</td>
                                            @if ($item->order_id)
                                                <td><a
                                                        href="{{ route('frontend.user.order_details', [
                                                            'order_code' => $item->order_id,
                                                        ]) }}">Go
                                                        To
                                                        Order</a></td>
                                            @else
                                                <td>No Order ID</td>
                                            @endif

                                            <td>
                                                <span
                                                    class="p-2 {{ $item->answered ? 'bg-warning text-light' : 'bg-success text-light' }}">{{ $item->answered ? 'Answered' : 'Continuing' }}</span>
                                            </td>

                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        Actions
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="#">View
                                                                Details</a></li>
                                                        </li>
                                                        <li><a class="dropdown-item"h href="#">Delete</a>
                                                        </li>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('dashboard/vendor/libs/datatable/datatables.min.js') }}"></script>

    <script>
        $(document).ready(function() {

            console.log('datatabke')
            $('#queries_table').DataTable();
        });
    </script>
@endsection

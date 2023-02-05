@extends('layouts.admin')


@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->


        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Orders /</span> View Orders</h4>

            @if (session()->has('success'))
                <div id="global_alert"
                    class="alert bg-primary fade show d-flex align-items-center justify-content-between global_alert"
                    role="alert">
                    <p class="text-light m-0"> {{ session()->get('success') }}</p>
                </div>
            @endif

            @if (session()->has('error'))
                <div id="global_alert" class="alert bg-danger fade show d-flex align-items-center justify-content-between "
                    role="alert">
                    <p class="text-light m-0"> {{ session()->get('error') }}</p>
                </div>
            @endif


            <div class="card">
                <div class="table-responsive text-nowrap px-4">
                    <table class="table" id="store_table">
                        <thead>
                            <tr>
                                <th>Order Code</th>
                                <th>Customer</th>
                                <th>Date</th>
                                <th>Payment Method</th>
                                <th>Amount</th>
                                <th>Paid</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">

                            @foreach ($orders as $item)
                                <tr>
                                    <td>{{ @$item->order_code }}
                                        <br>
                                        <span
                                            class="badge {{ $item->status == 'delivered' ? 'bg-success' : ($item->status == 'cancelled' ? 'bg-danger' : 'bg-warning') }}">{{ $item->status }}
                                            (<small>{{ @explode(' ', $item->updated_at)[0] }}</small>)
                                        </span>
                                        <span
                                            class="badge {{ $item->payment_status == 'unpaid' ? 'bg-danger' : 'bd-success' }}">
                                            {{ $item->payment_status }}</span>
                                    </td>
                                    <td>{{ @$item->customer_name }}
                                        <br>
                                        <span><small>{{ $item->phone }}</small></span>
                                        <br>
                                        <span><small>{{ $item->email }}</small></span>
                                    </td>
                                    <td>{{ @explode(' ', $item->created_at)[0] }}</td>
                                    <td>{{ @$item->payment_method }}</td>
                                    <td>{{ $item->total_amount }}</td>
                                    <td>{{ $item->paid_amount }}</td>


                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a href="{{ route('admin.orders.details', [
                                                    'order_code' => $item->order_code,
                                                ]) }}"
                                                    class="dropdown-item">
                                                    View Details
                                                </a>
                                                <button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#change_order_status_{{ $item['id'] }}">
                                                    Update Status
                                                </button>
                                                <button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#change_order_status_{{ $item['id'] }}">
                                                    Invoice
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <div class="modal fade" id="change_order_status_{{ $item['id'] }}"
                                    aria-labelledby="modalToggleLabel" tabindex="-1" style="display: none;"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header text-center">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <h4>Update Order Status</h4>
                                                <form
                                                    action="{{ route('admin.orders.order_status_update', ['id' => $item->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    <div class="form-group">
                                                        <select class="form-control" name="order_status">
                                                            <option value="pending"
                                                                {{ $item->status == 'pending' ? 'selected' : '' }}>
                                                                Pending
                                                            </option>
                                                            <option value="processing"
                                                                {{ $item->status == 'processing' ? 'selected' : '' }}>
                                                                Processing
                                                            </option>
                                                            <option value="on_delivery"
                                                                {{ $item->status == 'on_delivery' ? 'selected' : '' }}>
                                                                On
                                                                Delivery
                                                            </option>
                                                            <option value="delivered"
                                                                {{ $item->status == 'delivered' ? 'selected' : '' }}>
                                                                Delivered
                                                            </option>
                                                            <option value="cancelled"
                                                                {{ $item->status == 'cancelled' ? 'selected' : '' }}>
                                                                Cancelled
                                                            </option>
                                                        </select>
                                                    </div>

                                                    <button type="submit" class="btn btn-danger mt-3"
                                                        data-bs-target="#change_order_status_{{ $item['id'] }}"
                                                        data-bs-toggle="modal" data-bs-dismiss="modal">
                                                        Confirm
                                                    </button>
                                                </form>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach



                        </tbody>
                    </table>
                </div>
            </div>

            <!-- / Content -->



            <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
    </div>
    <!-- / Layout page -->
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $(document).ready(function() {
                $('#store_table').DataTable();
            });
        })
    </script>
@endsection

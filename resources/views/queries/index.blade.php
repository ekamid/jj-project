@extends('layouts.admin')


@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->


        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Queries /</span> View Queries</h4>

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
                                <th>Title</th>
                                <th>Type</th>
                                <th>Order ID</th>
                                <th>Status</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">

                            @foreach ($queries as $item)
                                <tr>
                                    <td>{{ @$item->title }}</td>
                                    <td class="text-uppercase">{{ $item->type }}</td>
                                    @if ($item->order_code)
                                        <td><a
                                                href="{{ route('frontend.user.order_details', ['order_code' => $item->order_code]) }}">Go
                                                To Order
                                            </a>
                                        </td>
                                    @else
                                        <td>No Order ID</td>
                                    @endif

                                    <td>
                                        <span
                                            class="p-2 {{ $item->answered ? 'bg-primary text-light' : 'bg-success text-light' }}">{{ $item->answered ? 'Answered' : 'Continuing' }}</span>
                                    </td>

                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item"
                                                    href="{{ route('admin.user.queries.chat', ['id' => $item->id]) }}"><i
                                                        class="bx bx-eye-alt me-1"></i>
                                                    View Details</a>
                                                <button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#delete_modal_{{ $item['id'] }}">
                                                    <i class="bx bx-trash me-1"></i> Delete
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>


                                <div class="modal fade" id="delete_modal_{{ $item['id'] }}"
                                    aria-labelledby="modalToggleLabel" tabindex="-1" style="display: none;"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header text-center">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <i style="font-size: 48px" class="bx bx-trash text-danger me-1 mb-3"></i>
                                                <br>
                                                You sure you want to delete this query?
                                            </div>
                                            <div class="modal-footer">
                                                <form method="POST"
                                                    action="{{ route('admin.user.queries.delete', $item['id']) }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger"
                                                        data-bs-target="#delete_modal_{{ $item['id'] }}"
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

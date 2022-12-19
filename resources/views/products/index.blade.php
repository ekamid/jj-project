@extends('layouts.admin')


@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->


        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Products /</span> View Products</h4>

            @if (session()->has('success'))
                <div id="global_alert"
                    class="alert bg-primary fade show d-flex align-items-center justify-content-between global_alert"
                    role="alert">
                    <p class="text-light m-0"> {{ session()->get('success') }}</p>
                    {{-- <button type="button" class="btn btn-sm btn-outline-danger bg-danger text-light" data-dismiss="alert"
                        aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button> --}}
                </div>
            @endif

            @if (session()->has('error'))
                <div id="global_alert" class="alert bg-danger fade show d-flex align-items-center justify-content-between "
                    role="alert">
                    <p class="text-light m-0"> {{ session()->get('error') }}</p>
                    {{-- <button type="button" class="btn btn-sm btn-outline-danger" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button> --}}
                </div>
            @endif


            <div class="card">
                <div class="table-responsive text-nowrap px-4">
                    <table class="table" id="store_table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Images</th>
                                <th>Weight</th>
                                <th>Price</th>
                                <th>Karat</th>
                                <th>Size</th>
                                <th>Stock</th>
                                <th>Customization Avaiable</th>
                                <th>Published</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">

                            @foreach ($products as $item)
                                <tr>
                                    <td>{{ @$item->name }}</td>
                                    <td class="text-capitalize">
                                        <img style="max-width: 120px"
                                            src="{{ @$item->images ? asset(@array_values(json_decode(@$item->images))[0]) : asset('frontend/images/default_images.png') }}"
                                            alt="{{ @$item->name }}">
                                    </td>
                                    <td>{{ @$item->weight }}</td>
                                    <td>{{ @$item->price }}</td>
                                    <td>{{ @$item->karat }}</td>
                                    <td>{{ @$item->size }}</td>
                                    <td>{{ @$item->stock }}</td>
                                    <td><span
                                            class="badge {{ @$item->customization_available ? 'bg-label-primary' : 'bg-label-warning' }} me-1">{{ @$item->customization_available ? 'Avaiable' : 'Unavaiable' }}</span>
                                    </td>
                                    <td><span
                                            class="badge {{ @$item->published ? 'bg-label-primary' : 'bg-label-warning' }} me-1">{{ @$item->published ? 'Published' : 'Unpublished' }}</span>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item"
                                                    href="{{ route('admin.products.edit', $item->id) }}"><i
                                                        class="bx bx-edit-alt me-1"></i>
                                                    Edit</a>
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
                                                You sure you want to delete the product name
                                                <strong class="text-primary"> {{ $item['name'] }}</strong>
                                            </div>
                                            <div class="modal-footer">
                                                <form method="POST"
                                                    action=" {{ route('admin.products.delete', $item['id']) }}">
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

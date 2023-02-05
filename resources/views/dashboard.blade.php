@extends('layouts.admin')

@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">


            <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                    <div class="card">
                        <div class="d-flex align-items-end row">
                            <div class="col-sm-7">
                                <div class="card-body">
                                    <h5 class="card-title text-primary">Congratulations
                                        {{ Auth::user()->name }}! 🎉</h5>
                                    <p class="mb-4">
                                        Lot's of works to do today.
                                        Are you ready?
                                    </p>
                                </div>
                            </div>
                            <div class="col-sm-5 text-center text-sm-left">
                                <div class="card-body pb-0 px-0 px-md-4">
                                    <img src="{{ asset('dashboard/img/illustrations/man-with-laptop-light.png') }}"
                                        height="140" alt="View Badge User"
                                        data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                        data-app-light-img="illustrations/man-with-laptop-light.png" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 row">
                    <div class="col-md-6 col-lg-4 col-xl-4">
                        <div class="card">
                            <div class="card-body d-flex justify-content-between">
                                <div>
                                    <span class="fw-semibold d-block mb-1">Avaiable Products</span>
                                    <h3 class="card-title mb-2">{{ count($products) }}</h3>
                                </div>

                                <div class="dropdown">
                                    <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                        <a class="dropdown-item" href="{{ route('admin.products.index') }}">View More</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-4">
                        <div class="card">
                            <div class="card-body d-flex justify-content-between">
                                <div>
                                    <span class="fw-semibold d-block mb-1">Total Orders</span>
                                    <h3 class="card-title mb-2">{{ count($orders) }}</h3>
                                </div>

                                <div class="dropdown">
                                    <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                        <a class="dropdown-item" href="{{ route('admin.orders.index') }}">View More</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-4">
                        <div class="card">
                            <div class="card-body d-flex justify-content-between">
                                <div>
                                    <span class="fw-semibold d-block mb-1">Total Customers</span>
                                    <h3 class="card-title mb-2">{{ count($users) }}</h3>
                                </div>

                                <div class="dropdown">
                                    <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                        <a class="dropdown-item" href="{{ route('admin.users.index') }}">View More</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- Footer -->
                <footer class="content-footer footer bg-footer-theme">
                    <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                        <div class="mb-2 mb-md-0">
                            ©
                            <script>
                                document.write(new Date().getFullYear());
                            </script>
                            , by
                            <a href="/" target="_blank" class="footer-link fw-bolder">Apurba
                                Jewellers<a>
                        </div>
                    </div>
                </footer>
                <!-- / Footer -->
            </div>

            <!-- / Content -->



            <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
    </div>
    <!-- / Layout page -->
@endsection

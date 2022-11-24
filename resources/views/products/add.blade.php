@extends('layouts.admin')

@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Products /</span> Add Product</h4>

            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Product Information</h5>
                    <a class="btn btn-outline-primary float-end" href="{{ route('admin.products.index') }}">View Products</a>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.stores.add') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Name</label>
                            <input type="text" value="{{ old('name') }}" class="form-control" name="name"
                                id="basic-default-fullname" placeholder="Stylish Braclet" required>
                            @error('name')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="product_categories">Categories</label>
                            <select type="text" data-show-subtext="true" data-live-search="true" multiple
                                name="categories" class="form-control" required id="product_categories">
                                <option disabled selected>Select Multiple Categories</option>

                                @foreach ($categories as $category)
                                    <option value={{ $category->id }}>{{ $category->name }}</option>
                                @endforeach
                            </select>

                        </div>


                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="product_weight">Weight</label>
                                    <input type="text" value="{{ old('weight') }}" name="weight" class="form-control"
                                        id="product_weight" placeholder="Weight In gram" required>

                                    @error('weight')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="product_karet">Karat</label>
                                    <input type="text" value="{{ old('karat') }}" name="karat" class="form-control"
                                        id="product_karet" placeholder="Karat" required>
                                    @error('karat')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="store_address">Address</label>
                            <input type="text" value="{{ old('address') }}" name="address" class="form-control"
                                id="store_address" placeholder="Dhaka, Bangladesh" required>
                            @error('address')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="store_contact_no">Phone</label>
                            <input type="text" name="phone" value="{{ old('phone') }}" class="form-control"
                                id="store_contact_no" placeholder="+8801634234566" required>

                            @error('phone')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label class="form-label" for="instructions">Instructions</label>
                            <textarea id="instructions" class="form-control"
                                placeholder="You should first come to Rajdhani market more to reach us. Then....">
                            {{ old('instructions') }}
                            </textarea>
                            @error('instructions')
                                <div class="text-danger d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label class="form-label" for="store_image">Store Image</label>
                            <input type="file" accept="image/*" name="store_image" class="form-control" id="store_image"
                                placeholder="store image">

                            @error('store_image')
                                <div class="text-danger d-block">
                                    {{ $message }}
                                </div>
                            @enderror

                            <img id="store_image_prev" width="200" src="" alt="store image"
                                class="mt-2 d-none" />


                        </div>


                        <div class="mb-3">
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="checkbox" name="customization_available[]"
                                    id="customization_available">
                                <label class="form-check-label" for="customization_available"> Customization Available
                                </label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="checkbox" name="published[]" id="published">
                                <label class="form-check-label" for="published"> Publish </label>
                            </div>
                        </div>



                        <button type="submit" class="btn btn-primary">Add Store</button>
                    </form>
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
        // To style only selects with the my-select class
        $('#product_categories').selectpicker();

        $('#store_image').on('change', function() {
            const file = $(this).get(0).files[0];
            if (file) {
                let url = URL.createObjectURL(file)
                $('#store_image_prev').removeClass('d-none');
                $('#store_image_prev').attr('src', url);
            } else {
                $('#store_image_prev').addClass('d-none');
            }


        })
    </script>
@endsection

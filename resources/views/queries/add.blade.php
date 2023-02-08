@extends('layouts.admin')

@section('styles')
    <style>
        .ck-editor__editable[role="textbox"] {
            /* editing area */
            min-height: 200px;
        }

        #product_images_prev {
            display: flex;
            align-items: center;
            gap: 10px;
            max-width: 160px;
            flex-wrap: nowrap;
            flex-direction: row;
        }

        #product_images_prev img {
            width: 100%;
        }
    </style>
@endsection

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
                    <form method="POST" action="{{ route('admin.products.add') }}" enctype="multipart/form-data">
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

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="product_price">Price</label>
                                    <input type="text" value="{{ old('price') }}" min="0" class="form-control"
                                        name="price" id="product_price" placeholder="Price in taka" required>
                                    @error('price')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="product_stock">Stock</label>
                                    <input type="number" value="{{ old('stock') }}" name="stock" class="form-control"
                                        id="product_stock" placeholder="Product Stock" required>

                                    @error('stock')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="product_categories">Categories</label>
                            <select type="text" data-show-subtext="true" data-live-search="true" multiple
                                name="categories[]" class="form-control" required id="product_categories">
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
                            <label class="form-label" for="description">Description</label>
                            <textarea id="description" style="min-height: 200px" class="form-control" placeholder="Description" name="description">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="text-danger d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label class="form-label" for="physical_store">Physical Store</label>
                            <select type="text" data-show-subtext="true" data-live-search="true" multiple
                                name="physical_store[]" class="form-control" required id="physical_store">
                                <option disabled selected>Select Multiple Stores</option>

                                @foreach ($stores as $store)
                                    <option value={{ $store->id }}>{{ $store->name }}</option>
                                @endforeach
                            </select>

                        </div>


                        <div class="mb-3">
                            <label class="form-label" for="product_images">Product Images</label>
                            <input type="file" accept="image/*" name="images[]" class="form-control"
                                id="product_images" placeholder="store image" multiple />

                            @error('images')
                                <div class="text-danger d-block">
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="mt-2" id="product_images_prev">

                            </div>


                        </div>



                        <div class="mb-3">
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="checkbox" name="published[]" id="published">
                                <label class="form-check-label" for="published"> Publish </label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Add Product</button>
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
    <script src="https://cdn.ckeditor.com/ckeditor5/35.3.2/classic/ckeditor.js"></script>
    <script>
        // To style only selects with the my-select class
        $('#product_categories').selectpicker();
        $('#physical_store').selectpicker();
        // $('#product_size').selectpicker();

        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });


        //multiple images
        $('#product_images').on('change', function() {
            const files = $(this).get(0).files;

            console.log(files);

            for (let i = 0; i < files.length; i++) {
                if (files[i]) {
                    let url = URL.createObjectURL(files[i])
                    $('#product_images_prev').append(`<img src="${url}" alt="Product Image" />`)
                } else {
                    $('.product_images_prev').addClass('d-none');
                }
            }
        })
    </script>
@endsection

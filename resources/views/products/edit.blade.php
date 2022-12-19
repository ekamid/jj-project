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
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Products /</span> Edit Product</h4>

            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Product Information</h5>
                    <a class="btn btn-outline-primary float-end" href="{{ route('admin.products.index') }}">View Products</a>
                </div>




                <div class="card-body">
                    <form method="POST" action="{{ route('admin.products.edit', $product->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Name</label>
                            <input type="text" value="{{ $product['name'] }}" class="form-control" name="name"
                                id="basic-default-fullname" placeholder="Stylish Braclet" required>
                            @error('name')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="product_price">Price</label>
                            <input type="text" value="{{ $product['price'] }}" min="0" class="form-control"
                                name="price" id="product_price" placeholder="Price in taka" required>
                            @error('price')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="product_categories">Categories</label>

                            <select type="text" data-show-subtext="true" data-live-search="true" multiple
                                name="categories[]" class="form-control" required id="product_categories">
                                <option disabled selected>Select Multiple Categories</option>
                                @foreach ($categories as $category)
                                    <option value={{ $category->id }}
                                        {{ in_array($category->id, json_decode($product->categories)) ? 'selected' : '' }}>
                                        {{ $category->name }}</option>
                                @endforeach
                            </select>

                        </div>


                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="product_weight">Weight</label>
                                    <input type="text" value="{{ $product['weight'] }}" name="weight"
                                        class="form-control" id="product_weight" placeholder="Weight In gram" required>

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
                                    <input type="text" value="{{ $product['karat'] }}" name="karat"
                                        class="form-control" id="product_karet" placeholder="Karat" required>
                                    @error('karat')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="product_stock">Stock</label>
                                    <input type="number" value="{{ $product['stock'] }}" name="stock"
                                        class="form-control" id="product_stock" placeholder="Product Stock" required>

                                    @error('stock')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="product_size">Size</label>
                                    <select type="text" data-show-subtext="true" data-live-search="true" multiple
                                        name="size[]" class="form-control" required id="product_size">
                                        <option disabled selected>Select Multiple Categories</option>
                                        <option value='sm' {{ selectedSize('sm', $product->size) }}>Small</option>
                                        <option value='md' {{ selectedSize('md', $product->size) }}>Medium</option>
                                        <option value='lg' {{ selectedSize('lg', $product->size) }}>Large</option>
                                        <option value='xl' {{ selectedSize('xl', $product->size) }}>Extra Large
                                        </option>
                                        <option value='xxl' {{ selectedSize('xxl', $product->size) }}>Extra Extra Large
                                        </option>
                                    </select>

                                    @error('size')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="mb-3">
                            <label class="form-label" for="description">Description</label>
                            <textarea id="description" style="min-height: 200px" class="form-control" placeholder="Description">{{ $product['description'] }}</textarea>
                            @error('description')
                                <div class="text-danger d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label class="form-label" for="physical_store">Physical Store</label>
                            <select type="text" data-show-subtext="true" data-live-search="true" multiple
                                name="physical_store[]" class="form-control" id="physical_store">
                                <option disabled selected>Select Multiple Stores</option>

                                @foreach ($stores as $store)
                                    <option value={{ $store->id }}
                                        {{ in_array($store->id, json_decode($product->stores)) ? 'selected' : '' }}>
                                        {{ $store->name }}</option>
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
                                @foreach (json_decode($product->images) as $image)
                                    <img src="{{ asset($image) }}" alt="{{ $product->name }}">
                                @endforeach
                            </div>


                        </div>


                        <div class="mb-3">
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="checkbox" name="customization_available[]"
                                    id="customization_available"
                                    {{ $product['customization_available'] ? 'checked' : '' }}>
                                <label class="form-check-label" for="customization_available"> Customization Available
                                </label>
                            </div>
                        </div>



                        <div id="customizationInstructionContainer" class="mb-3 d-none">
                            <label class="form-label" for="customaization_instructions">Customization Instructions</label>
                            <textarea id="customaization_instructions" style="min-height: 200px" class="form-control"
                                placeholder="Customaization Instructions">{{ $product['customaization_instructions'] }}</textarea>
                            @error('customaization_instructions')
                                <div class="text-danger d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="checkbox" name="published[]" id="published"
                                    {{ $product['published'] ? 'checked' : '' }}>
                                <label class="form-check-label" for="published"> Publish </label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Product</button>
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
        $('#product_size').selectpicker();

        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#customaization_instructions'))
            .catch(error => {
                console.error(error);
            });


        $("#customization_available").change(function() {
            if (this.checked) {
                $('#customizationInstructionContainer').removeClass('d-none');
            } else {
                $('#customizationInstructionContainer').addClass('d-none');
            }
        });


        //multiple images
        $('#product_images').on('change', function() {
            const files = $(this).get(0).files;

            for (let i = 0; i < files.length; i++) {
                if (files[i]) {
                    let url = URL.createObjectURL(files[i])
                    $('#product_images_prev').empty();
                    $('#product_images_prev').append(`<img src="${url}" alt="Product Image" />`)
                } else {
                    $('.product_images_prev').addClass('d-none');
                }
            }
        })
    </script>
@endsection

@extends('layouts.admin')

@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Category /</span> Add Category</h4>

            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Category Information</h5>
                    <a class="btn btn-outline-primary float-end" href="{{ route('admin.categories') }}">View Category</a>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.add_category') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Name</label>
                            <input type="text" value="{{ old('name') }}" class="form-control" name="name"
                                id="basic-default-fullname" placeholder="Bracelet" required>
                            @error('name')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="parent_category_id">Parent Category</label>
                            <select data-show-subtext="true" data-live-search="true" id="parent_category_id" type="text"
                                name="parent_id" class="form-control">
                                <option disabled selected>Select Parent Category</option>
                                @foreach ($categories as $category)
                                    <option value={{ $category->id }}>{{ $category->name }}</option>
                                @endforeach

                            </select>

                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="description">Description</label>
                            <textarea id="description" name="description" class="form-control" placeholder="Description">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="text-danger d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label class="form-label" for="category_banner">Banner</label>
                            <input type="file" accept="image/*" name="banner" class="form-control" id="category_banner"
                                placeholder="Category banner">

                            @error('banner')
                                <div class="text-danger d-block">
                                    {{ $message }}
                                </div>
                            @enderror

                            <img id="category_banner_prev" width="200" src="" alt="store image"
                                class="mt-2 d-none" />


                        </div>


                        <div class="mb-3">
                            <div class="form-check mt-3">
                                <input name="published[]" class="form-check-input" type="checkbox" id="published">
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
        $('#parent_category_id').selectpicker();

        $('#category_banner').on('change', function() {
            const file = $(this).get(0).files[0];
            if (file) {
                let url = URL.createObjectURL(file)
                $('#category_banner_prev').removeClass('d-none');
                $('#category_banner_prev').attr('src', url);
            } else {
                $('#category_banner_prev').addClass('d-none');
            }

        })
    </script>
@endsection

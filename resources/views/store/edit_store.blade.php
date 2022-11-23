@extends('layouts.admin')

@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Store /</span> Edit Store</h4>

            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Store Information</h5>
                    <a class="btn btn-outline-primary float-end" href="{{ route('admin.stores') }}">View Store</a>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.edit_store', $store['id']) }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Name</label>
                            <input type="text" value="{{ @$store['name'] }}" class="form-control" name="name"
                                id="basic-default-fullname" placeholder="Apurba Jewellers" required>
                            @error('name')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="store_address">City</label>
                            <select type="text" name="city" class="form-control" required id="store_city">
                                <option value="dhaka" {{ @$store['city'] == 'dhaka' ? 'selected' : '' }}>Dhaka</option>

                                <option value="chattogram" {{ @$store['city'] == 'chattogram' ? 'selected' : '' }}>
                                    Chattogram
                                </option>
                                <option value="sylhet" {{ @$store['city'] == 'sylhet' ? 'selected' : '' }}>Sylhet</option>
                                <option value="mymensingh" {{ @$store['city'] == 'mymensingh' ? 'selected' : '' }}>
                                    Mymensingh
                                </option>
                                <option value="rajshahi" {{ @$store['city'] == 'rajshahi' ? 'selected' : '' }}>Rajshahi
                                </option>
                                <option value="rangpur" {{ @$store['city'] == 'rangpur' ? 'selected' : '' }}>Rangpur
                                </option>
                                <option value="khulna" {{ @$store['city'] == 'khulna' ? 'selected' : '' }}>Khulna</option>
                                <option value="barishal" {{ @$store['city'] == 'barishal' ? 'selected' : '' }}>Barishal
                                </option>
                            </select>

                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="store_address">Address</label>
                            <input type="text" value="{{ @$store['address'] }}" name="address" class="form-control"
                                id="store_address" placeholder="Dhaka, Bangladesh" required>
                            @error('address')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="store_latitude">Latitude</label>
                                    <input type="text" value="{{ @$store['latitude'] }}" name="latitude"
                                        class="form-control" id="store_latitude" placeholder="120.3424242" required>

                                    @error('longitude')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="store_longitude">Longitude</label>
                                    <input type="text" value="{{ @$store['longitude'] }}" name="longitude"
                                        class="form-control" id="store_longitude" placeholder="55.453453353" required>
                                    @error('longitude')
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
                                    <label class="form-label" for="store_open_at">Open At</label>

                                    <input type="time" value="{{ @$store['open_at'] }}" name="open_at"
                                        class="form-control" id="store_open_at" placeholder="10:00" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="store_close_at">Close At</label>
                                    <input type="time" value="{{ @$store['close_at'] }}" name="close_at"
                                        class="form-control" id="store_close_at" placeholder="20:00" required>
                                </div>
                            </div>
                        </div>


                        <div class="mb-3">
                            <label class="form-label" for="store_holidays">Holidays</label>
                            <input type="text" name="holidays" value="{{ @$store['holidays'] }}" class="form-control"
                                id="store_holidays" placeholder="Saturday, Sunday" required>

                            @error('holidays')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="store_contact_no">Phone</label>
                            <input type="text" name="phone" value="{{ @$store['phone'] }}" class="form-control"
                                id="store_contact_no" placeholder="+8801634234566" required>

                            @error('phone')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label class="form-label" for="instructions">Instructions</label>
                            <textarea name="instructions" id="instructions" class="form-control"
                                placeholder="You should first come to Rajdhani market more to reach us. Then....">
                            {{ @$store['instructions'] }} 
                            </textarea>
                            @error('instructions')
                                <div class="text-danger d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label class="form-label" for="store_image">Store Image</label>
                            <input type="file" accept="image/*" name="store_image" class="form-control"
                                id="store_image" placeholder="store image">

                            @error('store_image')
                                <div class="text-danger d-block">
                                    {{ $message }}
                                </div>
                            @enderror

                            <img id="store_image_prev" src="{{ url($store['store_image']) }}" width="200"
                                src="" alt="store image"
                                class="mt-2 {{ $store['store_image'] ? 'd-block' : 'd-none' }}" />


                        </div>


                        <div class="mb-3">
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="checkbox" name="published[]"
                                    {{ @$store['published'] ? 'checked' : '' }} id="published">
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
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDUPClCAvO-EIlmJajX4Sc3bpGgi57-LnE&callback=initAutocomplete&libraries=places"
        defer></script>

    <script>
        let autocomplete;
        let store_address;

        function initAutocomplete() {

            store_address = document.querySelector("#store_address");

            // Create the autocomplete object, restricting the search predictions to
            // addresses in the US and Canada.
            autocomplete = new google.maps.places.Autocomplete(store_address, {
                // componentRestrictions: {
                //     country: ["bd"]
                // },
                fields: ["address_components", "geometry"],
                types: ["address"],
            });

            store_address.focus();

            // When the user selects an address from the drop-down, populate the
            // address fields in the form.
            autocomplete.addListener("place_changed", fillInAddress);
        }

        function fillInAddress() {
            // Get the place details from the autocomplete object.
            const place = autocomplete.getPlace();
            const address = place.address_components[0].long_name;
            const store_lat = place.geometry.location.lat();
            const store_lng = place.geometry.location.lng();

            $("#store_address").val(address)
            $("#store_latitude").val(store_lat)
            $("#store_longitude").val(store_lng)
        }

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

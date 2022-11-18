@extends('layouts.admin')

@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Store /</span> Add Store</h4>

            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Store Information</h5>
                    <a class="btn btn-outline-primary float-end" href="{{ route('admin.stores') }}">View Store</a>
                </div>
                <div class="card-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Name</label>
                            <input type="text" class="form-control" name="name" id="basic-default-fullname"
                                placeholder="Apurba Jewellers">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="store_address">Address</label>
                            <input type="text" name="address" class="form-control" id="store_address"
                                placeholder="Dhaka, Bangladesh">
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="store_latitude">Latitude</label>
                                    <input type="text" name="latitude" class="form-control" id="store_latitude"
                                        placeholder="120.3424242">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="store_longitude">Longitude</label>
                                    <input type="text" name="longitude" class="form-control" id="store_longitude"
                                        placeholder="55.453453353">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="store_contact_no">Phone</label>
                            <input type="text" name="phone" class="form-control" id="store_contact_no"
                                placeholder="+8801634234566">
                        </div>


                        <div class="mb-3">
                            <label class="form-label" for="instructions">Instructions</label>
                            <textarea id="instructions" class="form-control"
                                placeholder="You should first come to Rajdhani market more to reach us. Then...."></textarea>
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
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB41DRUbKWJHPxaFjMAwdrzWzbVKartNGg&callback=initAutocomplete&libraries=places&v=weekly"
        defer></script>

    <script>
        let autocomplete;
        let store_address;

        function initAutocomplete() {
            store_address = document.querySelector("#store_address");

            // Create the autocomplete object, restricting the search predictions to
            // addresses in the US and Canada.
            autocomplete = new google.maps.places.Autocomplete(store_address, {
                componentRestrictions: {
                    country: ["us", "ca"]
                },
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
            let address1 = "";
            let postcode = "";

            // Get each component of the address from the place details,
            // and then fill-in the corresponding field on the form.
            // place.address_components are google.maps.GeocoderAddressComponent objects
            // which are documented at http://goo.gle/3l5i5Mr
            for (const component of place.address_components) {
                // @ts-ignore remove once typings fixed
                const componentType = component.types[0];

                switch (componentType) {
                    case "street_number": {
                        address1 = `${component.long_name} ${address1}`;
                        break;
                    }

                    case "route": {
                        address1 += component.short_name;
                        break;
                    }

                    case "postal_code": {
                        postcode = `${component.long_name}${postcode}`;
                        break;
                    }

                    case "postal_code_suffix": {
                        postcode = `${postcode}-${component.long_name}`;
                        break;
                    }

                    case "locality":
                        (document.querySelector("#locality")).value =
                            component.long_name;
                        break;

                    case "administrative_area_level_1": {
                        (document.querySelector("#state")).value =
                            component.short_name;
                        break;
                    }

                    case "country":
                        (document.querySelector("#country")).value =
                            component.long_name;
                        break;
                }
            }

            store_address.value = address1;
            postalField.value = postcode;

            // After filling the form with address components from the Autocomplete
            // prediction, set cursor focus on the second address line to encourage
            // entry of subpremise information such as apartment, unit, or floor number.
            address2Field.focus();
        }

        // declare global {
        //     interface Window {
        //         initAutocomplete: () => void;
        //     }
        // }
        // window.initAutocomplete = initAutocomplete;
        // export {};
    </script>
@endsection

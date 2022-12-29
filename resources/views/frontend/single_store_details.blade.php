@extends('layouts.app')

@section('content')
    <div class="untree_co-section">
        <div class="sub-banner" style="background: url({{ url($store['store_image']) }}) no-repeat 0px 0px !important">
        </div>
        <div class="container">

            <div class="block">
                <div class="d-flex justify-content-between" style="flex-wrap: wrap;">
                    <div>
                        <h4>
                            Address
                        </h4>
                        <h6>
                            {{ @$store['address'] }}
                        </h6>
                    </div>
                    <div>
                        <h4>
                            Phone
                        </h4>
                        <h6>
                            {{ @$store['phone'] }}
                        </h6>
                    </div>
                    <div>
                        <h4>
                            Holidays
                        </h4>
                        <h6>
                            {{ @$store['holidays'] }}
                        </h6>
                    </div>
                    <div>
                        <h4>
                            Open-Close
                        </h4>

                        <h6>Open At: <small>{{ @$store['open_at'] }}</small></h6>
                        <h6>Close At: <small>{{ @$store['close_at'] }}</small></h6>

                    </div>
                </div>
                <div>
                    <h4>Instructions</h4>
                    <p>{{ @$store['instructions'] }}</p>
                </div>
            </div>

        </div>
        <div class="map-w3ls">
            <div style="height: 460px" id="single_store_map"></div>
        </div>

    </div>

    <input type="hidden" name="latitude" id="latitude" value="{{ @$store['latitude'] }}">
    <input type="hidden" name="longitude" id="longitude" value="{{ @$store['longitude'] }}">
@endsection


@section('scripts')
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDUPClCAvO-EIlmJajX4Sc3bpGgi57-LnE&callback=initMap"></script>

    <script>
        function initMap() {
            let latitude = Number($("#latitude").val());
            let longitude = Number($("#longitude").val());

            let city = {
                lat: latitude,
                lng: longitude
            };

            console.log(city);

            let map = new google.maps.Map(
                document.getElementById('single_store_map'), {
                    zoom: 17,
                    disableDefaultUI: true,
                    //map styling
                    styles: [{
                            elementType: 'geometry',
                            stylers: [{
                                color: '#333333'
                            }]
                        },
                        {
                            elementType: 'labels.text.stroke',
                            stylers: [{
                                color: '#222222'
                            }]
                        },
                        {
                            elementType: 'labels.text.fill',
                            stylers: [{
                                color: '#eeeeee'
                            }]
                        },
                        {
                            featureType: 'administrative.locality',
                            elementType: 'labels.text.fill',
                            stylers: [{
                                color: '#eeeeee'
                            }]
                        },
                        {
                            featureType: 'poi',
                            elementType: 'labels.text.fill',
                            stylers: [{
                                color: '#cccccc'
                            }]
                        },
                        {
                            featureType: 'poi.park',
                            elementType: 'geometry',
                            stylers: [{
                                color: '#3a3a3a'
                            }]
                        },
                        {
                            featureType: 'poi.park',
                            elementType: 'labels.text.fill',
                            stylers: [{
                                color: '#777777'
                            }]
                        },
                        {
                            featureType: 'road',
                            elementType: 'geometry',
                            stylers: [{
                                color: '#212121'
                            }]
                        },
                        {
                            featureType: 'road',
                            elementType: 'labels',
                            stylers: [{
                                visibility: 'off'
                            }]
                        },
                        {
                            featureType: 'road.highway',
                            elementType: 'geometry',
                            stylers: [{
                                color: '#555555'
                            }]
                        },
                        {
                            featureType: 'road.highway',
                            elementType: 'geometry.stroke',
                            stylers: [{
                                color: '#222222'
                            }]
                        },
                        {
                            featureType: 'road.highway',
                            elementType: 'labels.text.fill',
                            stylers: [{
                                color: '#f3d19c'
                            }]
                        },
                        {
                            featureType: 'transit',
                            elementType: 'geometry',
                            stylers: [{
                                visibility: 'off'
                            }]
                        },
                        {
                            featureType: 'water',
                            elementType: 'geometry',
                            stylers: [{
                                color: '#bbbbbb'
                            }]
                        },
                        {
                            featureType: 'water',
                            elementType: 'labels.text.fill',
                            stylers: [{
                                color: '#777777'
                            }]
                        },
                        {
                            featureType: 'water',
                            elementType: 'labels.text.stroke',
                            stylers: [{
                                color: '#222222'
                            }]
                        }
                    ],
                    center: city
                }
            );

            let marker = new google.maps.Marker({
                position: city,
                map: map,
            });
        }
    </script>
@endsection

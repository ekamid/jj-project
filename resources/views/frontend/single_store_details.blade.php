@extends('layouts.app')

@section('content')
    <div class="sub-banner" style="background: url({{ url($store['store_image']) }}) no-repeat 0px 0px !important">
    </div>
    <div class="contact">
        <div class="container">
            <h3>{{ @$store['name'] }}</h3>
            <div class="col-md-3 col-sm-3 contact-left">
                <div class="address">
                    <h4>ADDRESS</h4>
                    <h5>{{ @$store['address'] }}</h5>
                </div>
                <div class="phone">
                    <h4>PHONE</h4>
                    <h5>{{ @$store['phone'] }}</h5>
                </div>
                <div class="phone">
                    <h4>Holidays</h4>
                    <h5>{{ @$store['holidays'] }}</h5>
                </div>
                <div class="phone">
                    <h4>Open-Close</h4>
                    <h5>Open At: <small>{{ @$store['open_at'] }}</small></h5>
                    <h5>Close At: <small>{{ @$store['close_at'] }}</small></h5>
                </div>
                <div class="email">
                    <h4>Instructions</h4>
                    <p>{{ @$store['instructions'] }}</p>
                </div>
            </div>
            <div class="col-md-9 col-sm-9 contact-right">
                <div class="map-w3ls">
                    <div style="height: 460px" id="single_store_map"></div>
                </div>
            </div>
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

@extends('layouts.app')

@section('content')
    <div class="store-wrapper">
        <div class="container">
            <div class="store-content">
                <div class="store-selection">
                    <h2 class="store-heading">Find Stores</h2>
                    {{-- <form class="form-inline">
                        <h2 class="store-heading">Find Stores</h2>
                        <div class="form-group mb-2">
                            <select class="form-control capitalize" id="exampleFormControlSelect1">
                                <option value="null">Choose City</option>
                                @foreach ($stores as $city => $store)
                                    <option value="{{ $city }}">{{ $city }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <select class="form-control" id="exampleFormControlSelect1">
                                <option value="null">Choose Store</option>
                                @foreach (array_values($stores)[0] as $store)
                                    <option latitude="{{ $store['latitude'] }}" longitude="{{ $store['longitude'] }}"
                                        value="{{ $store['id'] }}">
                                        {{ $store['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Find</button>
                    </form> --}}

                </div>

                {{-- <select id="cityselect" onchange="selectCity(event)">

                </select> --}}

                <div id="storeMap" class="store-map"></div>
            </div>
        </div>
    </div>

    <input type="hidden" name="get_stores_url" id="get_stores_url" value="{{ route('frontend.get_stores') }}" />
@endsection


@section('scripts')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDUPClCAvO-EIlmJajX4Sc3bpGgi57-LnE&v=3.exp&sensor=false"
        type="text/javascript"></script>


    <script>
        let url = "";

        $(document).ready(function() {
            console.log('Entered');
            url = $("#get_stores_url").val();
            console.log('Goyt URL');
            console.log(url);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "GET",
                url: url,
                // data: formData,
                dataType: 'json',
                success: function(data) {
                    console.log("Success :D");;
                    console.log(data);
                    initMap(data);
                },
                error: function(data) {
                    console.log("Error :(");

                    console.log(data);
                }
            });
        });



        let mapstyle = {
            background: [{
                featureType: "all",
                elementType: "labels.text.fill",
                stylers: [{
                    saturation: 36
                }, {
                    color: "#000000"
                }, {
                    lightness: 40
                }]
            }, {
                featureType: "all",
                elementType: "labels.text.stroke",
                stylers: [{
                    visibility: "on"
                }, {
                    color: "#000000"
                }, {
                    lightness: 16
                }]
            }, {
                featureType: "all",
                elementType: "labels.icon",
                stylers: [{
                    visibility: "off"
                }]
            }, {
                featureType: "administrative",
                elementType: "geometry.fill",
                stylers: [{
                    color: "#a42d2d"
                }]
            }, {
                featureType: "administrative",
                elementType: "geometry.stroke",
                stylers: [{
                    color: "#000000"
                }, {
                    lightness: 17
                }, {
                    weight: 1.2
                }]
            }, {
                featureType: "administrative.country",
                elementType: "geometry.fill",
                stylers: [{
                    gamma: "1.00"
                }, {
                    color: "#ca3d3d"
                }]
            }, {
                featureType: "landscape",
                elementType: "geometry",
                stylers: [{
                    color: "#000000"
                }, {
                    lightness: "20"
                }, {
                    gamma: "1"
                }, {
                    saturation: "0"
                }]
            }, {
                featureType: "poi",
                elementType: "geometry",
                stylers: [{
                    color: "#000000"
                }, {
                    lightness: "20"
                }]
            }, {
                featureType: "road.highway",
                elementType: "geometry.fill",
                stylers: [{
                    color: "#000000"
                }, {
                    lightness: 17
                }]
            }, {
                featureType: "road.highway",
                elementType: "geometry.stroke",
                stylers: [{
                    color: "#000000"
                }, {
                    lightness: 29
                }, {
                    weight: .2
                }]
            }, {
                featureType: "road.arterial",
                elementType: "geometry",
                stylers: [{
                    color: "#000000"
                }, {
                    lightness: 18
                }]
            }, {
                featureType: "road.local",
                elementType: "geometry",
                stylers: [{
                    color: "#000000"
                }, {
                    lightness: 16
                }]
            }, {
                featureType: "transit",
                elementType: "geometry",
                stylers: [{
                    color: "#000000"
                }, {
                    lightness: 19
                }]
            }, {
                featureType: "water",
                elementType: "geometry",
                stylers: [{
                    color: "#000000"
                }, {
                    lightness: "10"
                }]
            }]
        }

        function initMap(data) {

            let centerOn = {
                lat: data[0].latitude,
                lng: data[0].longitude
            };

            let map = new google.maps.Map(document.getElementById('storeMap'), {
                zoom: 8,
                styles: mapstyle.background,
                disableDefaultUI: true,
                center: centerOn
            });

            let markers = [];
            let contents = [];
            let infowindows = [];
            // let cities = document.getElementById('cityselect');

            for (let i = 0; i < data.length; i++) {

                markers[i] = new google.maps.Marker({
                    position: new google.maps.LatLng(data[i].latitude, data[i].longitude),
                    map: map,
                    index: i
                });


                contents[i] = data[i].name

                infowindows[i] = new google.maps.InfoWindow({
                    content: `<a href="/get-stores/${data[i].id}">${contents[i]}</a`,
                    maxWidth: 300
                });

                google.maps.event.addListener(markers[i], 'click', function() {
                    infowindows[this.index].open(map, markers[this.index]);
                    map.panTo(markers[this.index].getPosition());

                    for (let j = 0; j < markers.length; j++) {
                        if (j != this.index) {
                            infowindows[j].close(map, markers[j]);
                        }
                    }
                });

                // cities.options[cities.options.length] = new Option(data[i].name, i);
            }

            selectCity = function(evt) {
                let ind = evt.target.value;
                if (ind == "Район 1") {

                    let pos = new google.maps.LatLng(turkey);
                    map.panTo(pos);

                    for (let j = 0; j < markers.length; j++) {
                        infowindows[j].close(map, markers[j]);
                    }
                } else {
                    infowindows[ind].open(map, markers[ind]);
                    map.panTo(markers[ind].getPosition());

                    for (let j = 0; j < markers.length; j++) {
                        if (j != ind) {
                            infowindows[j].close(map, markers[j]);
                        }
                    }
                }
            }
        }
    </script>
@endsection

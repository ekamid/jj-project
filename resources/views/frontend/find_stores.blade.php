@extends('layouts.app')

@section('content')
    <div class="store-wrapper">
        <div class="container">
            <div class="store-content">
                <div class="store-selection">
                    <form class="form-inline">
                        <h2 class="store-heading">Find Stores</h2>
                        <div class="form-group mb-2">
                            <select class="form-control capitalize" id="exampleFormControlSelect1">
                                <option disabled>Choose City</option>
                                @foreach ($stores as $city => $store)
                                    <option value="{{ $city }}">{{ $city }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <select class="form-control" id="exampleFormControlSelect1">
                                <option disabled>Choose Store</option>
                                @foreach (array_values($stores)[0] as $store)
                                    <option latitude="{{ $store['latitude'] }}" longitude="{{ $store['longitude'] }}"
                                        value="{{ $store['id'] }}">
                                        {{ $store['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Find</button>
                    </form>

                </div>

                {{-- <select id="cityselect" onchange="selectCity(event)">

                </select> --}}

                <div id="storeMap" class="store-map"></div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false" type="text/javascript"></script>

    <script>
        var data = [{
            name: 'Район 1',
            lat: 36.8977988,
            lng: 30.6830822,
            content: 'Район 1 информация',
            content_en: 'Район 1 информация'
        }, ];
        var mapstyle = {
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

        function initMap() {

            // İlk açılışta haritayı ortalayacağı yer
            var turkey = {
                lat: 36.8977988,
                lng: 30.6830822
            };

            var map = new google.maps.Map(document.getElementById('storeMap'), {
                zoom: 13,
                styles: mapstyle.background,
                disableDefaultUI: true,
                center: turkey
            });

            var markers = [];
            var contents = [];
            var infowindows = [];
            var cities = document.getElementById('cityselect');

            for (var i = 0; i < data.length; i++) {

                // Haritaya eklenecek noktalar
                markers[i] = new google.maps.Marker({
                    position: new google.maps.LatLng(data[i].lat, data[i].lng),
                    map: map,
                    index: i
                });

                // Sitenin diline göre data'daki ingilizce içeriği çektiği yer. Buranın doğru çalışabilmesi için dilin html tagına lang eklenmeli
                if (document.documentElement.lang == "en") {
                    contents[i] = data[i].content_en
                } else {
                    contents[i] = data[i].content
                }

                infowindows[i] = new google.maps.InfoWindow({
                    content: contents[i],
                    maxWidth: 300
                });

                // pin'lere tıklanınca ne yapacağı
                google.maps.event.addListener(markers[i], 'click', function() {
                    infowindows[this.index].open(map, markers[this.index]);
                    map.panTo(markers[this.index].getPosition());

                    // tıklanılan haricindeki pencerelerin lapatılması
                    for (let j = 0; j < markers.length; j++) {
                        if (j != this.index) {
                            infowindows[j].close(map, markers[j]);
                        }
                    }
                });

                // select box'ın dinamik olarak data'dan doldurulması
                cities.options[cities.options.length] = new Option(data[i].name, i);
            }

            // şehir seçince ne yapılacağı
            selectCity = function(evt) {
                let ind = evt.target.value;
                if (ind == "Район 1") { // "Seçiniz" seçeneği seçilirse

                    // haritayı ortalıyor
                    var pos = new google.maps.LatLng(turkey);
                    map.panTo(pos);

                    // tüm info alanlarını kapatıyor
                    for (let j = 0; j < markers.length; j++) {
                        infowindows[j].close(map, markers[j]);
                    }
                } else {
                    // seçtiği şehri ortalıyor
                    infowindows[ind].open(map, markers[ind]);
                    map.panTo(markers[ind].getPosition());

                    // seçtiği şehrin haricindeki info alanlarını kapatıyor 
                    for (let j = 0; j < markers.length; j++) {
                        if (j != ind) {
                            infowindows[j].close(map, markers[j]);
                        }
                    }
                }
            }
        }
        initMap()
    </script>
@endsection

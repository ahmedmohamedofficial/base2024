<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&key={{ settings('google_places') }}&libraries=places&language={{ app()->getLocale() }}"></script>
<script>
    var map;
    var marker;
    var lat = document.getElementById('{{ $lat }}');
    var lng = document.getElementById('{{ $lng }}');
    var address = document.getElementById('{{ $address }}');
    var geocoder = new google.maps.Geocoder();
    var infowindow = new google.maps.InfoWindow();
    var myLatlng = new google.maps.LatLng(lat.value, lng.value);

    var icon = {
        url: "{{ asset('/') }}admin/img/marker-img.svg", // url
        scaledSize: new google.maps.Size(50, 50), // scaled size
        origin: new google.maps.Point(0, 0), // origin 
    };
    var currentLocation = {{ $currentLocation }}
    var selectedAddress = "";

    function initMap(latLng) {
        var myLatlng;
        if (lat.value === '' || lng.value === '') {
            myLatlng = latLng;
        } else if (currentLocation) {
            myLatlng = latLng;
        } else {
            myLatlng = new google.maps.LatLng(lat.value, lng.value)

        }

        var mapOptions = {
            zoom: 15,
            center: myLatlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        map = new google.maps.Map(document.getElementById("{{ $map }}"), mapOptions);
        marker = new google.maps.Marker({
            map: map,
            position: myLatlng,
            draggable: true,
            icon: icon
        });

        geocoder.geocode({
            'latLng': myLatlng
        }, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                if (results[0]) {
                    address.value = results[0].formatted_address;
                    lat.value = marker.getPosition().lat();
                    lng.value = marker.getPosition().lng();
                    infowindow.setContent(results[0].formatted_address);
                    infowindow.open(map, marker);
                }
            }
        });

        google.maps.event.addListener(marker, 'dragend', function() {
            geocoder.geocode({
                'latLng': marker.getPosition()
            }, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[0]) {
                        selectedAddress = results[0].address_components[1].long_name;
                        address.value = results[0].formatted_address;
                        lat.value = marker.getPosition().lat();
                        lng.value = marker.getPosition().lng();
                        infowindow.setContent(results[0].formatted_address);
                        infowindow.open(map, marker);
                    }
                }
            });
        });

        google.maps.event.addListener(map, 'mousedown', function() {
            $("#mapSearch").val("")
        });

        google.maps.event.addListener(map, 'mouseup', function(e) {x
            var geocoder = new google.maps.Geocoder();
            geocoder.geocode({
                'latLng': marker.position
            }, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[0]) {
                        selectedAddress = results[0].address_components[1].long_name;
                    }
                }
            });
        });


        const locationButton = document.createElement("button");
        locationButton.classList.add("custom-map-control-button");
        locationButton.setAttribute("type", "button");
        map.controls[google.maps.ControlPosition.TOP_CENTER].push(locationButton);
        locationButton.addEventListener("click", () => {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        const pos = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude,
                        };
                        marker.setPosition(pos); // Update marker position
                        map.setCenter(pos);
                        geocoder.geocode({
                            'location': pos
                        }, function(results, status) {
                            if (status === 'OK') {
                                if (results[0]) {
                                    address.value = results[0].formatted_address;
                                    infowindow.setContent(results[0].formatted_address);
                                    infowindow.open(map, marker);
                                    lat.value = pos.lat;
                                    lng.value = pos.lng;
                                } else {
                                    infowindow.setContent("No results found");
                                    infowindow.open(map, marker);
                                }
                            } else {
                                infowindow.setContent("Geocoder failed due to: " + status);
                                infowindow.open(map, marker);
                            }
                        });
                    },
                    () => {
                        handleLocationError(true, infowindow, map.getCenter());
                    }
                );
            } else {
                handleLocationError(false, infowindow, map.getCenter());
            }
        });

    }

    function initialize() {
        var input = document.getElementById('{{ $mapSearch }}');
        var autocomplete = new google.maps.places.Autocomplete(input, {
            types: []
        });

        google.maps.event.addListener(autocomplete, 'place_changed', function() {
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                return;
            }
            lat.value = place.geometry.location.lat();
            lng.value = place.geometry.location.lng();
            address.value = place.formatted_address; // Set the selected address here
            initMap(new google.maps.LatLng(place.geometry.location.lat(), place.geometry.location.lng()));
        });
    }

    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(
            browserHasGeolocation ?
            "Error: The Geolocation service failed." :
            "Error: Your browser doesn't support geolocation."
        );
        infoWindow.open(map);
    }

    google.maps.event.addDomListener(window, 'load', initialize);



    if (navigator.geolocation && currentLocation) {
        navigator.geolocation.getCurrentPosition(function(p) {
                var LatLng = new google.maps.LatLng(p.coords.latitude, p.coords.longitude);
                initMap(LatLng)
            },
            function(error) {
                initMap(myLatlng)
            });
    } else {
        initMap(myLatlng)
    }

    $('#set_address_btn').click(function() {
        $("#staticBackdrop").modal('hide');
    });

    $('#staticBackdrop').on('hidden.bs.modal', function() {
        $('#set_address_btn').prop('disabled', true)
    });
</script>

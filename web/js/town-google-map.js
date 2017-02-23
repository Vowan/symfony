var map;



function initMap() {

    var geocoder = new google.maps.Geocoder();



    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 11,
        center: {lat: -34.397, lng: 150.644}

    });

    var address = town + ", " + region;
    geocoder.geocode({'address': address}, function (results, status) {
        if (status === 'OK') {
            map.setCenter(results[0].geometry.location);

            $.getJSON(ajaxUrl + '/' + town + '/' + region)
                    .done(function (data) {
                        // console.log("second success", data);
                        data.realties.forEach(function (el) {
                            var mark = new google.maps.Marker({
                                map: map,
                                position: {lat: parseFloat(el['latitude']), lng: parseFloat(el['longitude'])},
                                icon: marker + "orange.png",
                            });

                            var infowindow = new google.maps.InfoWindow({
                                maxWidth: 160
                            });

                            google.maps.event.addListener(mark, 'click', (function (marker) {
                                return function () {
                                    infowindow.setContent('<br>цена ' + el['price']  + '<br>'
                                            + '<a href="'+data.realtyURL+'/'+el['uuid']+'">Подробнее</a>');
                                    infowindow.open(map, marker);
                                }
                            })(mark));
                        });
                    })
                    .fail(function () {
                        console.log("error");
                    })
                    .always(function () {
                        console.log("complete");
                    });
        } else {
            alert('Geocode was not successful for the following reason: ' + status);
        }
    });
}



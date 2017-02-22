var map

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
            
            console.log(ajaxUrl);

            $.getJSON(ajaxUrl+'/'+town+'/'+region, function () {
                console.log("success");
            })
                    .done(function () {
                        console.log("second success");
                    })
                    .fail(function () {
                        console.log("error");
                    })
                    .always(function () {
                        console.log("complete");
                    });

//            var marker = new google.maps.Marker({
//              map: map,
//              position: results[0].geometry.location
//            });
        } else {
            alert('Geocode was not successful for the following reason: ' + status);
        }
    });
}



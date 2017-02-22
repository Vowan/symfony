var autocomplete, marker;

function initMap() {

    if ('Ukraine' == town) {

        var centr = {lat: 48.379433, lng: 31.165579999999977};

        var zoom = 6;
    }

    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: zoom,
        center: centr
    });

    if (document.getElementById('autocomplete')) {

        autocomplete = new google.maps.places.Autocomplete(
                /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
                {types: ['address']});

        autocomplete.bindTo('bounds', map);

        autocomplete.addListener('place_changed', fillInAddress);

    }

    marker = new google.maps.Marker({
        map: map,
        // position: myLatLng,
    });

    var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        sublocality_level_1: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        // postal_code: 'short_name'
    };

}


function fillInAddress() {
    marker.setVisible(false);


//console.log(autocomplete);

    // Get the place details from the autocomplete object.
    var place = autocomplete.getPlace();

    // If the place has a geometry, then present it on a map.
    if (place.geometry.viewport) {
        map.fitBounds(place.geometry.viewport);
    } else {
        map.setCenter(place.geometry.location);
        map.setZoom(17);
    }
    marker.setIcon(({
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(35, 35)
    }));
    marker.setPosition(place.geometry.location);
    marker.setVisible(true);


    var latitude = place.geometry.location.lat();
    var longitude = place.geometry.location.lng();

    var form_elem_lat = $("input[data-id='latitude']");
    form_elem_lat.val(latitude);

    var form_elem_lng = $("input[data-id='longitude']");
    form_elem_lng.val(longitude);



    // Get each component of the address from the place details
    // and fill the corresponding field on the form.

    // var zag_address = document.getElementById('prop_address');

    // zag_address.textContent = document.getElementById('autocomplete').value;


    // console.log(document.getElementById('autocomplete').value);


    for (var i = 0; i < place.address_components.length; i++) {
        var addressType = place.address_components[i].types[0];

        //console.log(place.geometry.location.lat());

        if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            var form_elem = $("input[data-id='" + addressType + "']");
            form_elem.val(val);
            //console.log(form_elem);


        }
    }

}




//    var myLatLng = some_map_object[0];
//
//
//    infowindow = new google.maps.InfoWindow({
//        maxWidth: 160
//    });
//
//    some_map_object.forEach(function (prop, idx) {
//
//        var prop_type = prop['post_type']; 
//        var prop_icon;
//        var prop_type_ru;
//
//        switch (prop_type) {
//            case 'buy':
//                prop_icon = map_object['markers']['buy'];
//                prop_type_ru = 'куплю';
//                break;
//            case 'sell':
//                prop_icon = map_object['markers']['sell'];
//                prop_type_ru = 'продам';
//                break;
//            case 'project':
//                prop_icon = map_object['markers']['project'];
//                prop_type_ru = 'новострой';
//                break;
//            case 'rent_long':
//                prop_icon = map_object['markers']['rent_long'];
//                prop_type_ru = 'сдам длительно';
//                break;
//            case 'rent_short':
//                prop_icon = map_object['markers']['rent_short'];
//                prop_type_ru = 'сдам посуточно';
//                break;
//            case 'rent_rever':
//                prop_icon = map_object['markers']['rent_rever'];
//                prop_type_ru = 'сниму';
//                break;
//            case 'hostel':
//                prop_icon = map_object['markers']['hostel'];
//                prop_type_ru = 'хостел';
//                break;
//        }
//
//
//
//        var prop_marker = new google.maps.Marker({
//            map: map,
//            position: {lat: parseFloat(prop['lat']), lng: parseFloat(prop['lng'])},
//            icon: prop_icon,
//        });
//
//        google.maps.event.addListener(prop_marker, 'click', (function (marker, i, type) {
//            return function () {
//                infowindow.setContent(type + '<br>цена ' + some_map_object[i]['price'] + ' $<br> комнат ' + some_map_object[i]['rooms'] + '<br>'
//                        + '<a id="' + some_map_object[i]['real_id'] + '?prop_type=' + some_map_object[i]['post_type'] + '">Подробнее</a>');
//                infowindow.open(map, marker);
//            }
//        })(prop_marker, idx, prop_type_ru));
//
//
//    });
//







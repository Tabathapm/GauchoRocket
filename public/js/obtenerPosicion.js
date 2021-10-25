 function loadMap() {

        var mapOptions = {
        center:new google.maps.LatLng(-34.6686986,-58.5614947),
        zoom:12,
        panControl: false,
        zoomControl: false,
        scaleControl: false,
        mapTypeControl:false,
        streetViewControl:true,
        overviewMapControl:true,
        rotateControl:true,
        mapTypeId:google.maps.MapTypeId.ROADMAP
    };
        var map = new google.maps.Map(document.getElementById("mapa"),mapOptions);

        var marker = new google.maps.Marker({
        map: map,
        draggable:true,
        //icon:'/imagenes/logo_unlam.png'
    });

        google.maps.event.addListener(map, "rightclick", function(event) {
        var lat = event.latLng.lat();
        var lng = event.latLng.lng();
        var posicion = {
        "latitud" : lat,
        "longitud" : lng
    };
        //alert("Lat=" + lat + "; Lon=" + lng);
        $.ajax({
        data:  posicion,
        url:   'obtenerPosicion',
        type:  'post',
        dataType: "json",
        beforeSend: function () {
        $("#resultado").html("Cargando posicion...");
    },
        success:  function (response) {
        $("#latitud").val(response.latitud);
        $("#longitud").val(response.longitud);
    }
    });
    });


}

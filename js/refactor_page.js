var lat;
var lng;
var marker;

//функция для проверки строки на пустоту(отсылка на сверхов, ахаха)
function isBlank(str) {
    return (!str || /^\s*$/.test(str));
}

function updateLatLng() {
    //получаем из маркера долготу и ширину
    lat = marker.getPosition().lat();
    lng = marker.getPosition().lng();
    //с помощью Id на полях присваиваем нужные значения
    $('#lat').val(lat);
    $('#lng').val(lng);
}

//функция для инициализации карты гугловской и все что с ней связано
function initMap() {
    let saveBtn = document.getElementById('save');
    let uluru;
    let lat1 = document.getElementById('lat');
    let lng1 = document.getElementById('lng');

    uluru = {lat: 0, lng: 0};
    if (saveBtn != null && !isBlank(lat1.value)) {
        uluru = {lat: parseFloat(lat1.value), lng: parseFloat(lng1.value)};
    }
    //собстна обьявляем карту
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 4,
        center: uluru
    });
    //теперь обьявляем маркер(но пока что без позиции)
    marker = new google.maps.Marker({
        map: map,
        position: (saveBtn!=null && !isBlank(lat1.value))?uluru:null,
        draggable: true
    });
    //Listener для того чтобы когда двигался маркер менялись координаты в поле ввода
    marker.addListener('drag', function () {
        updateLatLng();
    });

    //находим поля с долготой и шириной по классам
    var arr = document.querySelectorAll('.inp');
    //теперь зададим им тригер
    arr.forEach(ar => {
        //собстна сам триггер не отличается для обоих полей
        // так как если вводятся значения в 1 поле то нужно обрабатывать оба поля
        ar.oninput = function() {
            //если оба поля пустые тогда нужно кикнуть из пати маркер(по условиям ТЗ)
            //---думаю можно упростить с помощью конкатенации---
            if (isBlank(arr[0].value) && isBlank(arr[1].value)){
                //убрали маркер, с помощью назначении ему карты ввиде null
                marker.setMap(null);
            }else {
                //когда же появилось что-то в полях мы снова возвращаем его
                marker.setMap(map);
                //получаем координаты с полей и задаем нужную позицию маркеру
                //---возможно нужно поменять верхнюю строку с нижней, то есть сначала---
                //---задать позицию, а уже потом показывать маркер, думаю это логично---
                var latlng = new google.maps.LatLng(arr[0].value, arr[1].value);
                marker.setPosition(latlng);
            }
        };
    })

    //           поисковая строка в том случае если клиент знает место
    //собстна получаем и назначаем поле поиска
    var searchBox = new google.maps.places.SearchBox(document.getElementById('search'));
    google.maps.event.addListener(searchBox, 'places_changed' , function () {

        var places = searchBox.getPlaces();

        var bounds = new google.maps.LatLngBounds();
        var i, place;

        for (i = 0; place = places[i] ; i++) {
            bounds.extend(place.geometry.location);
            marker.setPosition(place.geometry.location);

            updateLatLng();
        }

        map.fitBounds(bounds);
        map.setZoom(5);
    })

}

window.initMap = initMap;




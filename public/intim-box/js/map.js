function init_yandex_map(map_name) {

    if (typeof ymaps == 'undefined') {

        $.getScript("https://api-maps.yandex.ru/2.1/?lang=ru_RU", function (data, textStatus, jqxhr) {
            ymaps.ready(function () {

                var x = $('#'+map_name).attr('data-x')
                var y = $('#'+map_name).attr('data-y')

                init('map', x, y)

            })
        });
    } else {

        ymaps.ready(function () {

            var x = $('#'+map_name).attr('data-x')
            var y = $('#'+map_name).attr('data-y')

            init('map', x, y)

        })
    }

}

function init(map_name, x, y) {

    var myMap = new ymaps.Map(map_name, {
        center: [x, y],
        zoom: 13,
    });

    // Все виды меток
    // https://tech.yandex.ru/maps/doc/jsapi/2.1/ref/reference/option.presetStorage-docpage/


    // Собственное изображение для метки с контентом
    var placemark4 = new ymaps.Placemark([x, y], {
        // hintContent: 'Собственный значок метки с контентом',
    }, {
        // Опции.

        // Необходимо указать данный тип макета.
        iconLayout: 'default#image',

        // Своё изображение иконки метки.
        iconImageHref: '/img/map.svg',
        // Размеры метки.
        iconImageSize: [131, 62],
        // Смещение левого верхнего угла иконки относительно
        // её "ножки" (точки привязки).
        iconImageOffset: [-72, -62],
    });

    myMap.geoObjects.add(placemark4);

}

$(document).ready(function () {
    init_yandex_map('map');
});

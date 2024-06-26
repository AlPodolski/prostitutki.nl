function toggle_class_to_block(target, className) {
    var targetElement = document.getElementById(target);
    targetElement.classList.toggle(className);
}

function phone(object) {

    var id = object.getAttribute('data-id');
    var city = object.getAttribute('data-city');
    var phone = object.getAttribute('data-phone');
    var token = document.querySelector('meta[name="csrf-token"]').content;

    if (phone) {

        window.location.href = 'tel:+' + phone;

    } else {

        axios.post('/phone',
            {
                id: id,
                city: city
            },
            {
                headers: {'X-CSRF-TOKEN': token},
            })
            .then(function (response) {
                object.innerHTML = formatPhone(response.data);
                object.setAttribute('data-phone', response.data);
                window.location.href = 'tel:+' + response.data;
            })
            .catch(function (error) {
                console.log(error);
            });

    }

}

function show_sub_menu(obj) {
    obj.nextElementSibling.classList.toggle('show_sub_menu')
}

var slider = document.getElementById('age');

noUiSlider.create(slider, {
    start: [18, 80],
    connect: true,
    step: 1,
    format: wNumb({
        decimals: 0
    }),
    range: {
        'min': 18,
        'max': 80
    }
});

slider.noUiSlider.on('update', function (values, handle) {
    console.log(values);
    var age_from = document.getElementById('age-from')
    var age_to = document.getElementById('age-to')
    age_from.value = values[0];
    age_to.value = values[1];
});

var sliderVes = document.getElementById('ves');

noUiSlider.create(sliderVes, {
    start: [40, 100],
    connect: true,
    step: 1,
    format: wNumb({
        decimals: 0
    }),
    range: {
        'min': 40,
        'max': 100
    }
});

sliderVes.noUiSlider.on('update', function (values, handle) {
    console.log(values);
    var from = document.getElementById('ves-from')
    var to = document.getElementById('ves-to')
    from.value = values[0];
    to.value = values[1];
});

var sliderGrud = document.getElementById('grud');

noUiSlider.create(sliderGrud, {
    start: [0, 8],
    connect: true,
    step: 1,
    format: wNumb({
        decimals: 0
    }),
    range: {
        'min': 0,
        'max': 8
    }
});

sliderGrud.noUiSlider.on('update', function (values, handle) {
    console.log(values);
    var from = document.getElementById('grud-from')
    var to = document.getElementById('grud-to')
    from.value = values[0];
    to.value = values[1];
});


var sliderPrice = document.getElementById('price');

noUiSlider.create(sliderPrice, {
    start: [1500, 50000],
    connect: true,
    step: 100,
    format: wNumb({
        decimals: 0
    }),
    range: {
        'min': 1500,
        'max': 50000
    }
});

sliderPrice.noUiSlider.on('update', function (values, handle) {
    console.log(values);
    var from = document.getElementById('price-from')
    var to = document.getElementById('price-to')
    from.value = values[0];
    to.value = values[1];
});

function showFilter() {
    document.getElementById('filter').classList.toggle('show-filter')
}

function getMorePosts(object) {

    var url = object.getAttribute('data-url');
    var token = document.querySelector('meta[name="csrf-token"]').content;

    axios.post(url, {
        headers: {'X-CSRF-TOKEN': token},
    })
        .then(function (response) {

            var posts = document.getElementById('content');

            if (response.data.posts) posts.innerHTML += response.data.posts

            if (response.data.next_page) object.setAttribute('data-url', response.data.next_page)
            else object.remove()

        })
        .catch(function (error) {
            console.log(error);
        });

}

function setSort() {

    var select = document.getElementById('sort-select');

    if (select.value) {
        document.cookie = 'sort=' + select.value;
    }

    window.location.href = location.pathname + location.search;

}

arrowTop.onclick = function () {
    window.scrollTo(pageXOffset, 0);
    // после scrollTo возникнет событие "scroll", так что стрелка автоматически скроется
};

window.addEventListener('scroll', function () {
    arrowTop.hidden = (pageYOffset < 500);
});


document.addEventListener('DOMContentLoaded', function () {

    var singleGallery = $('#gallery');
    singleGallery.lightGallery();

});

function formatPhone(phone) {

    phone = phone.toString();

    var lenPhone = phone.length;
    var tt = phone.split('');
    if (lenPhone == 11) {
        tt.splice(0, "", "+");
        tt.splice(2, "", "(");
        tt.splice(6, "", ")");
        tt.splice(10, "", "-");
        tt.splice(13, "", "-");

    } else if (lenPhone == 12) {
        tt.splice(2, "", "(");
        tt.splice(6, "", ")");
        tt.splice(10, "", "-");
        tt.splice(13, "", "-");
    } else if (lenPhone == 10) {
        tt.splice(0, "", "+7(");
        tt.splice(4, "", ")");
        tt.splice(8, "", "-");
        tt.splice(11, "", "-");
    }

    phone = tt.join('');

    return phone;

}

function showSearchForm(){
    document.getElementById('search').classList.toggle('open-search')
}
function add_to_favorite(object) {

    var id = $(object).attr('data-id');

    $.ajax({
        type: 'POST',
        url: "/favorite/add", //Путь к обработчику
        data: 'id=' + id,
        response: 'text',
        dataType: "html",
        cache: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name = "csrf-token"]').attr('content')
        },
        success: function (data) {

            $(object).toggleClass('catalog-item__favorite_add');

        }
    })

}

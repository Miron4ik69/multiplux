var places = [];
var currentPrice = null;

function setPlace(e) {

    const div = $(e);
    var place = div.data().place;
    var row = div.data().row;
    var price = div.data().price;


    if (div.hasClass('set')) {
        div.toggleClass('set');

        var data = {
            "place": place,
            "row": row
        };

        for(var i = 0; i <= places.length; i++) {
            if (JSON.stringify(places[i] ) === JSON.stringify(data)) {
                places.splice(i, 1);
            }
        }
    } else {
        div.toggleClass('set');

        places.push({
            "place": place,
            "row": row
        });
    }

    const endprice = places.length * price + ' грн';

    currentPrice = places.length * price;
    $("#price").text(endprice);

}

$("#confirm-button").on("click", function () {
    if(places.length <= 0) {
        UIkit.modal.alert('Выберите хотя-бы одно место');
    } else {
        $("#endprice").text(currentPrice + 'грн');
        UIkit.modal("#modal-sections").show();
    }
});

$('#deposited').on("keyup", function () {
    var oddmoney = $(this).val() - currentPrice;
    if( oddmoney >= 0 ) {
        $("#oddmoney").text(oddmoney + 'грн');
    }
});


$('#submit-button').on('click', function () {
    var data = {
        places: places,
        pay: currentPrice,
        reservationId: $("#reservationId").val(),
        movieId: movieId
    };

    $.ajax({
        url: '/admin-payment',
        method: 'post',
        data: data,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function() {
            UIkit.modal('#modal-sections').hide();
            var loading = '';
            loading += '<div id="loading" style="position: absolute; width: 100%; height: 100vh; display: flex; align-items: center; justify-content: center; z-index: 1020;">\n' +
                '    <span uk-spinner="ratio: 4.5" style="z-index: 1010;"></span>\n' +
                '    <div style="background: black; position: absolute; width: 100%; height: 100vh; opacity: 0.3"></div>\n' +
                '</div>'

            $(document.body).prepend(loading);
        }
    }).done((response) => {
        $('#loading').hide();
        var loading = '';
        loading += '<div style="position: absolute; width: 100%; height: 100vh; display: flex; align-items: center; justify-content: center; z-index: 1020;">\n' +
            '    <span uk-icon="icon: check; ratio: 4.5" style="z-index: 1010;"></span>\n' +
            '    <div style="background: black; position: absolute; width: 100%; height: 100vh; opacity: 0.3"></div>\n' +
            '</div>'
        setInterval(function () {
            window.location.href='/cashbox';
        }, 2000)

        $(document.body).prepend(loading);
    });
});

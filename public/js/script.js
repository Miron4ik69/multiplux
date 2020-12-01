$('body').on('change', function () {
    player.stopVideo();
});


function sendAjax(id, url) {
    $('#iframe-modal').attr('src', '');
    $.ajax({
        url: url,
        method: 'post',
        data: "movieId=" + id,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }).done((movie) => {
       setMovie(movie);
    });
}

function setMovie(request) {

    const uniq = Math.random().toString(36).substring(2);
    const url = "/reservation/" + request[0].id + "/" + uniq;

    $("#modal-movie-button").attr('href', url);
    $("#modal-movie-title").text(request[0].title);
    $("#modal-movie-age").text("Возраст: " + request[0].age);
    $("#modal-movie-director").text("Режисер: " + request[0].director);
    $("#modal-movie-hire").text("Период проката: " + request[0].start_hire + " - " + request[0].end_hire);
    $("#modal-movie-rating").text("Рейтинг: " + request[0].rating);
    $("#modal-movie-language").text("Язык: " + request[0].language);
    $("#modal-movie-duration").text("Продолжительность: " + request[0].duration);
    $("#modal-movie-country").text("Производство: " + request[0].country);
    $("#modal-movie-description").text(request[0].description);
    $("#modal-movie-image").css('background-image', 'url(/storage/' + request[0].image + ')');
}

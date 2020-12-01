$(document).ready(function () {
   startTimer();
});

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

function startTimer() {
    var reservationId = $("#reservationId").val();
    var sevenMinutes = Cookies.get(reservationId) || 60 * 7,
        display = $('#time');
    var timer = sevenMinutes, minutes, seconds;
    var timerID = setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        Cookies.set(reservationId, sevenMinutes--);

        // document.cookie = reservationId + "=" + sevenMinutes--;
        // window.localStorage.setItem(reservationId, sevenMinutes--);

        display.text(minutes + ":" + seconds);

        if (--timer < 0) {
            clearInterval(timerID);
            display.textContent = "";
            $.ajax({
                url: '/reservationCancel',
                method: 'post',
                data: "delete=" + reservationId,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            }).done((response) => {
                Cookies.remove(reservationId);
                window.location.href = "/reservationCancel";
            });
        }
    }, 1000);
}

$("#confirm-button").on("click", function () {
   if(places.length <= 0) {
       UIkit.modal.alert('Выберите хотя-бы одно место');
   } else {
       UIkit.modal("#modal-sections").show();
   }
});
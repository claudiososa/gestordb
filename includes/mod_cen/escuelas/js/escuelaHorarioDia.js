$(document).ready(function() {
/*
  var time = $('#timepicker').timepicker('showWidget');

    $('#timepicker').timepicker('setTime', '12:45 AM');

    $('#myModal').on('show.bs.modal', function (e) {
      $('#timepicker').timepicker().on('show.timepicker', function(e) {
          console.log('The time is ' + e.time.value);
          console.log('The hour is ' + e.time.hours);
          console.log('The minute is ' + e.time.minutes);
          console.log('The meridian is ' + e.time.meridian);
        });

    });



  $('#timepicker').timepicker().on('hide.timepicker', function(e) {
  console.log('The time is ' + e.time.value);
  console.log('The hour is ' + e.time.hours);
  console.log('The minute is ' + e.time.minutes);
  console.log('The meridian is ' + e.time.meridian);
});


$('#timepicker').timepicker().on('changeTime.timepicker', function(e) {
  console.log('The time is ' + e.time.value);
  console.log('The hour is ' + e.time.hours);
  console.log('The minute is ' + e.time.minutes);
  console.log('The meridian is ' + e.time.meridian);
});

/*
  $('#horaInicio').timepicker({
      minuteStep: 1,
      secondStep: 5,
      showInputs: false,
      showSeconds: true,
      showMeridian: false
  });




  //$("#horaInicio").timepicker().on('show.bs.modal', function(event) {
      // prevent datepicker from firing bootstrap modal "show.bs.modal"

    //  event.stopPropagation();
  //});


//$('#teachers').on('click', '.profesor', function(){

/*$('input.timepicker').timepicker({
  timeFormat: 'h:mm p',
  interval: 10,
  minTime: '7',
  maxTime: '11:50pm',
  defaultTime: '8',
  startTime: '08:00',
  dynamic: false,
  dropdown: true,
  scrollbar: true
})
*/
/*
  $('.agregarHora').click(function(){
    //$($(this).parent().siblings('form')).append('aaaa')
    $('.agregarHora').attr('disabled',true)
    $($(this).parent()).append(`
      <button id="btnHoraCatedra" type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">
      Hora Catedra
      </button>`)



      /*$('.timepicker').timepicker({
        timeFormat: 'h:mm p',
        interval: 10,
        minTime: '7',
        maxTime: '11:50pm',
        defaultTime: '7',
        startTime: '07:00',
        dynamic: false,
        dropdown: true,
        scrollbar: true
      });

      $('#horaInicio').timepicker({
        timeFormat: 'h:mm p',
        interval: 10,
        minTime: '7',
        maxTime: '11:50pm',
        defaultTime: '7',
        startTime: '07:00',
        dynamic: false,
        dropdown: true,
        scrollbar: true
      });
    //$($(this).parent().('form')).html('<input type="text" name="" value="holaa">')
//    $('.timepicker').timepicker()
    //$('#horaFinal').timepicker()
    //$($(this).parent().siblings('form')).append('aaa')
    */

    /*
    $('#myModal').on('hidden.bs.modal', function (e) {
      $("#btnHoraCatedra").remove()
      $("#myModal").remove()
      $(".agregarHora").removeAttr('disabled')
    });



    $('#myModal').on('show.bs.modal', function (e) {
      $('#horaInicio').timepicker().on('show.timepicker', function(e) {
          console.log('The time is ' + e.time.value);
          console.log('The hour is ' + e.time.hours);
          console.log('The minute is ' + e.time.minutes);
          console.log('The meridian is ' + e.time.meridian);
        });


      //$('.timepicker').timepicker();
      //$('#horaInicio').timepicker();
    });



/*
    $('#horaFinal').timepicker({
    timeFormat: 'h:mm p',
    interval: 10,
    minTime: '7',
    maxTime: '11:50pm',
    defaultTime: '8',
    startTime: '08:00',
    dynamic: false,
    dropdown: true,
    scrollbar: true
    });
*/
  //})



});

$(document).ready(function() {

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

  $('.agregarHora').click(function(){
    //$($(this).parent().siblings('form')).append('aaaa')
    $('.agregarHora').attr('disabled',true)
    $($(this).parent()).append(`
      <button id="btnHoraCatedra" type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">
      Hora Catedra
      </button>`)
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
  })

  $('.timepicker').timepicker({
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

});

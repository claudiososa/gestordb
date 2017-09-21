$(document).ready(function() {

  $('.agregarHora').click(function(){
    $($(this).parent()).append('aaaa')
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

$('.horaFinal').timepicker({
  timeFormat: 'h:mm p',
  interval: 10,
  minTime: '8',
  maxTime: '11:50pm',
  defaultTime: '7',
  startTime: '08:00',
  dynamic: false,
  dropdown: true,
  scrollbar: true
});
});

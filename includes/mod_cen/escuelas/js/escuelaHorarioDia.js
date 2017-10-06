$(document).ready(function() {



  $('.agregarHora').click(function(){
    //$($(this).parent().siblings('form')).append('aaaa')
    $('.agregarHora').attr('disabled',true)

    $($(this).parent()).append(`
      <button id="btnHoraCatedra" type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">
      Hora Catedra
      </button>`);

      $('#myModal').on('hidden.bs.modal', function (e) {
        $("#btnHoraCatedra").remove()
        //$("#myModal").remove()
        $(".agregarHora").removeAttr('disabled')
      });

      $('#myModal').on('show.bs.modal', function (e) {
        //alerta()

        //<script src="js/bootstrap-clockpicker.min.js"></script>
      });

    //$($(this).parent().('form')).html('<input type="text" name="" value="holaa">')
//    $('.timepicker').timepicker()
    //$('#horaFinal').timepicker()
    //$($(this).parent().siblings('form')).append('aaa')




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



});

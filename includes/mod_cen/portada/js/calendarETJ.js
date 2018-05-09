$(document).ready(function(){
		    $('.divOculto').show()
        if (screen.width<1024) {
          $('.calendar').addClass('table-responsive')
        }
        $(function () {
          $('[data-toggle="popover"]').popover({ html : true })
        })

				$('.headPanel').click(function(event) {
						/* Act on the event */
						// alert("hola");
						// var $this=$(this)
						$(this).parent().parent().find('.divOculto').toggle()
				});
});

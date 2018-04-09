

			$(document).ready(function(){
				//alert("llego hasta aqui");

				//});
         $('.divOculto').hide()

        if (screen.width<1024) {
          $('.calendar').addClass('table-responsive')
// alert ('hola')
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
//         $('.headPanel').click(function(event) {
//         // //   var $this=$(this)
//         // // $(this).find
// 				// ('.divOculto').toggle()
// alert('hola')
//           // $('.divOculto').toggle()
//         });


			});


$(document).ready(function() {
  $(".bodyprof").hide()
  $(".ocultartr").hide()


  $("#0078").click(function(event) {
    $(".ocultartr").toggle()
    	});



  $(document).on('click', ".panelprof", function(){
    var $this = $(this);
    if(!$this.hasClass('.panel-collapsed')) {
      	$this.closest('.panel').find('.panel-body').slideDown();
        $this.addClass('.panel-collapsed');
    		$this.find('i').removeClass('.glyphicon glyphicon-chevron-down').addClass('.glyphicon glyphicon-chevron-up');
    	} else {
    		$this.closest('.panel').find('.panel-body').slideUp();

        $this.removeClass('.panel-collapsed');
    		$this.find('i').removeClass('.glyphicon glyphicon-chevron-up').addClass('.glyphicon glyphicon-chevron-down');
    	}
  })
});

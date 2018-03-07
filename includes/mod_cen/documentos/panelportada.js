$(document).ready(function() {

$('.panel-body').hide();



//.on agrega la funcion evento click a ....
$(document).on('click', '#panel1 , #panel2 , #panel3 , #panel4 , #panel5 , #panel6 , #panel7' , 'span.clickable', function(){
  //var $this indica que posee un objeto jQuery.la seleccion se guarda en la variable

    var $this = $(this);
//hasClass( className ): Determina si los elementos coincidentes tiene asignada la clase dada.
	if(!$this.hasClass('.panel-collapsed')) {
//closest   Dado un objeto jQuery que representa un conjunto de elementos DOM, el método .closest() busca a través de estos elementos y sus antepasados ​​en el árbol DOM y construye un nuevo objeto jQuery a partir de los elementos coincidentes.

//find encuentra elementos coincidentes, filtrados por un selector, un objeto jQuery o un elemento.

//slideup los elementos coincidentes tienn un movimiento deslizante hacia arriba .
  	$this.closest('.panel').find('.panel-body').slideDown();

		$this.addClass('.panel-collapsed');
		$this.find('i').removeClass('.glyphicon glyphicon-chevron-down').addClass('.glyphicon glyphicon-chevron-up');
	} else {
		$this.closest('.panel').find('.panel-body').slideUp();

    $this.removeClass('.panel-collapsed');
		$this.find('i').removeClass('.glyphicon glyphicon-chevron-up').addClass('.glyphicon glyphicon-chevron-down');
	}
});

});

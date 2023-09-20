$(function(){
	$('#search_form').submit(function(e){
		e.preventDefault();
	})

	$('#search').keyup(function(){
		var envio = $('#search').val();

		$('#resultado').html('');

		$.ajax({
			type: 'POST',
			url: '/app/submits/buscadordeusuarios.php',
			data: ('search='+envio),
			success: function(resp){
				if(resp!=""){
					$('#resultado').html(resp);
				}
			}
		})
	})
})
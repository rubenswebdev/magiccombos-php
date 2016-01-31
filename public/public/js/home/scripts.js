
$( "#busca" ).keypress(function() {							
	$(function() {
		$( "#busca" ).autocomplete({
			source: function(request, response) {
				$.ajax({ url: base_url+"ajax/buscar_cartas",
				data: { term: $("#busca").val()},
				dataType: "json",
				type: "POST",
				success: function(data){
					response(data);
				}
			});
		},
		minLength: 2
		});
	});
});
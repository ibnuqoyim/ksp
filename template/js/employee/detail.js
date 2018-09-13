// JavaScript Document
jQuery(document).ready(function(){
	$(document).on('click',".delete",function() {
		var id = $(this).attr("field");
		$("#id").val(id);
	});

	$(document).on('click',".btn-hapus",function() {
		var id = $("#id").val();
		$.ajax({
			type : "POST",
			url : base_url + "index.php/"+controller+"/delete_data",
			data : {
				id : id
			},
			cache : false,
			dataType : "html",
			success : function(data) {
				$("#id").val('');
				window.location = base_url + 'index.php/'+controller
			},
			error : function(xhr, ajaxOptions, thrownError) {
				alert(xhr.statusText);
				alert(thrownError);
			}
		});
	});

});


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

jQuery(document).ready(function(){
	$(document).on('click',".delete_deposit",function() {
		var id = $(this).attr("field");
		$("#id_deposit").val(id);
	});

	$(document).on('click',".btn-hapus-deposit",function() {
		var id = $("#id_deposit").val();
		$.ajax({
			type : "POST",
			url : base_url + "index.php/"+controller+"/delete_data_deposit",
			data : {
				id : id
			},
			cache : false,
			dataType : "html",
			success : function(data) {
				$("#id_deposit").val('');
				location.reload();
			},
			error : function(xhr, ajaxOptions, thrownError) {
				alert(xhr.statusText);
				alert(thrownError);
			}
		});
	});

});

jQuery(document).ready(function(){
	$("#form_edit").hide();
});

function edit_deposit(depositid){
	var id = depositid;
	$.ajax({
		type : "POST",
		url : base_url + "index.php/"+controller+"/detail_deposit_ajax",
		data : {
			id : id
		},
		cache : false,
		dataType : "json",
		success : function(data) {

			$("#form_edit").show();
			$("#form_display").hide();

			$('#frm_id_deposit').val(data.id);
			$('#date').val(data.date);

			$('#pokok').val(data.pokok);
			$('#pokok').formatCurrency({ symbol:"", });

			$('#wajib').val(data.wajib);
			$('#wajib').formatCurrency({ symbol:"", });

			$('#sukarela').val(data.sukarela);
			$('#sukarela').formatCurrency({ symbol:"", });

		},
		error : function(xhr, ajaxOptions, thrownError) {
			alert(xhr.statusText);
			alert(thrownError);
		}
	});
}

function batal(){
	$("#form_edit").hide();
	$("#form_display").show();
	$('#frm_id_deposit').val('');
	$('#date').val('');
	$('#pokok').val('');
	$('#wajib').val('');
	$('#sukarela').val('');

}

function form_perubahan(){
	$("#form_perubahan").show();
}
function batal_perubahan(){
	$("#form_perubahan").hide();
	$('#perubahan_date').val('');
	$('#perubahan_wajib').val('');
	$('#perubahan_sukarela').val('');
}
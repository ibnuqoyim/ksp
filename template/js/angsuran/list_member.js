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
				location.reload();
			},
			error : function(xhr, ajaxOptions, thrownError) {
				alert(xhr.statusText);
				alert(thrownError);
			}
		});
	});
});




// JavaScript Document
jQuery(document).ready(function(){

	$(document).on('click',".sorting",function() {
		var sort_by = $(this).attr("field");
		var sort_order = $(this).attr("name");

		$("#hid_sort_by").val(sort_by);
		$("#hid_sort_order").val(sort_order);
		
		loda_data(0);
		
	});

	$(".btn_search").click(function() {//KEYWORDS
		loda_data(0);
	});

	$(document).on("keypress","#txt_keywords",function(event) {//KEYWORDS
		search_data(event, this);
	});

	$(document).on("click", ".pagination ul > li > a",function() {//paging
		var hal = $(this).attr("id");
		$("#hid_paging").val(hal);
		$(this).removeAttr("href");
		var page = $("#hid_paging").val();
		loda_data(page);
	});
});

function search_data(e, input){
	var code = (e.keyCode ? e.keyCode : e.which);
	if(code == 13) { //Enter keycode
		loda_data(0);
	}
}

function loda_data(page,jaminid){
	var sort_by = $("#hid_sort_by").val();
	var sort_order = $("#hid_sort_order").val();
	var keywords = $("#txt_keywords").val();
	//var pinjamanid = $("#pinjamanid").val();
	//var memberid = $("#memberidx").val();
	//var idpinjaman = $("#txt_pinjaman").val();
	
	//alert(jaminid);

	$.ajax({
		type : "POST",
		url : base_url + "index.php/angsurans/load_data_member",
		data : {
			page : page,
			sort_by : sort_by,
			sort_order : sort_order,
			keywords : keywords,
			jaminid : jaminid
		},
		cache : false,
		dataType : "html",
		success : function(data) {
			$("#data_entries").html("");
			$("#data_entries").html(data);
		},
		beforeSend : function() {
			$("#data_entries").html("<div id=\"loading\" align=\"center\"><img src=\""+base_url+"template/img/ajax-loader.gif\"/></div>");
		},
		error : function(xhr, ajaxOptions, thrownError) {
			alert(xhr.statusText);
			alert(thrownError);
		}
	});
}
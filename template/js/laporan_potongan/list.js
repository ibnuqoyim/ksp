// JavaScript Document
jQuery(document).ready(function(){

	$('#tgl_dari').datepicker({
		format: "mm/yyyy",
		startView: "year", 
		viewMode: "months",
		minViewMode: "months"
	})

	$('#tgl_sampai').datepicker({
		format: "mm/yyyy",
		startView: "year", 
		viewMode: "months",
		minViewMode: "months"
	})

	$(document).on('click',".sorting",function() {
		var sort_by = $(this).attr("field");
		var sort_order = $(this).attr("name");

		$("#hid_sort_by").val(sort_by);
		$("#hid_sort_order").val(sort_order);
		
		loda_data(0);
		
	});

	$(document).on('click',".btn_search",function() {//KEYWORDS
		loda_data(0);
	});

	$(document).on("click", ".pagination ul > li > a",function() {//paging
		var hal = $(this).attr("id");
		$("#hid_paging").val(hal);
		$(this).removeAttr("href");
		var page = $("#hid_paging").val();
		loda_data(page);
	});
});

function loda_data(page){
	var memberid = $("#memberid").val();
	var companyid = $("#companyid").val();

	var sort_by = $("#hid_sort_by").val();
	var sort_order = $("#hid_sort_order").val();
	var tgl_dari = $("#tgl_dari").val();
	var tgl_sampai = $("#tgl_sampai").val();

	$.ajax({
		type : "POST",
		url : base_url + "index.php/"+controller+"/load_data",
		data : {
			memberid : memberid,
			companyid:companyid,
			page : page,
			sort_by : sort_by,
			sort_order : sort_order,
			tgl_dari:tgl_dari,
			tgl_sampai:tgl_sampai,
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



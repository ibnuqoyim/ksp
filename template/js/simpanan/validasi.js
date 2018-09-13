jQuery(document).ready(function () {
    form_validation.init();



	get_default_simpanan();
	jQuery('#memberid').on('change', function(){
		get_default_simpanan();
	});


});

jQuery('#date').datepicker().on('changeDate', function(ev){
	get_default_simpanan();
});

function get_default_simpanan(){
	var date = $('#date').val();
	var memberid = $('#memberid').val();
	
	if(date!='' && memberid!=''){

		$.ajax({
			type : "POST",
			url : base_url + "index.php/"+controller+"/get_default_simpanan",
			data : {
				date : date,
				memberid : memberid,
			},
			cache : false,
			dataType : "json",
			success : function(data) {
	
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

}

var form_validation = function () {

    var handleValidate = function () {
		$("#form-tambah").validate({
			ignore: ":hidden:not(.chosen)",
            errorElement: 'span',
            errorClass: 'help-block',
            rules: {
				date:{
					required:true,
					/*remote:{
						url: base_url + "index.php/"+controller+"/check_date",
						data: {memberid:$('#memberid').val()},
						type: "post"
						}*/
				},
                memberid: { required: true, },
                pokok: { required: true, },
                wajib: { required: true, },
                sukarela: { required: true, },
            },
            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').removeClass('has-success').addClass('has-error'); // set error class to the control group
            },
            unhighlight: function (element) { // revert the change done by hightlight
                $(element)
                    .closest('.form-group').removeClass('has-error'); // set error class to the control group
            }
        });
    }
    return {
        init: function () {
            handleValidate();
        }
    }
}(jQuery);


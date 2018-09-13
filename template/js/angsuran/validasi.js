jQuery(document).ready(function () {
    form_validation.init();

	get_detail_information();
	jQuery('#loanid').on('change', function(){
		get_detail_information();
	});


});

function get_detail_information(){
	var loanid = $('#loanid').val();
	var installmentid = $('#installmentid').val();
	
	if(loanid!=''){

		$.ajax({
			type : "POST",
			url : base_url + "index.php/"+controller+"/get_detail_information",
			data : {
				loanid : loanid,
				installmentid : installmentid,
			},
			cache : false,
			dataType : "json",
			success : function(data) {
	
				$('.anggota').html("");
				$('.anggota').html(data.no_member+' - '+data.name);

				$('.angsuran_ke').html("");
				$('.angsuran_ke').html(data.angsuran_ke+' / '+data.lama_angsuran);
	
				$('#transaction').val('');
				$('#transaction').val(data.angsuran_ke);

				$('#total_transaction').val('');
				$('#total_transaction').val(data.lama_angsuran);

				$('#amount').val(data.perbulan);
				$('#amount').formatCurrency({ symbol:"", });
	
	
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
				},
                loanid: { required: true, },
                amount: { required: true, },
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


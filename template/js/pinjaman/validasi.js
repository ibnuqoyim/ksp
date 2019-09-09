jQuery(document).ready(function () {
    form_validation.init();

	get_maksimal_pinjam();
	angsuran_perbulan();
	//bunga_persen();
	jQuery('#memberid').on('change', function(){
		get_maksimal_pinjam();
	});
	//jQuery('.flag').on('change', function(){
	//	bunga_persen();
	//});
	//jQuery('#lama_angsuran').on('change', function(){
	//	bunga_persen();
	//});
	jQuery('#bunga').on('change', function(){
		angsuran_perbulan();
	});
	jQuery('#amount').on('keyup', function(){
		bunga_persen();
	});

});


function get_maksimal_pinjam(){
	var date = $('#date').val();
	var memberid = $('#memberid').val();
	
	if(date!='' && memberid!=''){

		$.ajax({
			type : "POST",
			url : base_url + "index.php/"+controller+"/get_maksimal_pinjam",
			data : {
				date : date,
				memberid : memberid,
			},
			cache : false,
			dataType : "html",
			success : function(data) {
	
				$('#maksimal').html(data);
	
			},
			error : function(xhr, ajaxOptions, thrownError) {
				alert(xhr.statusText);
				alert(thrownError);
			}
		});
	}

}

function bunga_persen(){
	var date = $('#date').val();
	
	$('#bunga').val(date.getFullYear());
	angsuran_perbulan();
}

function angsuran_perbulan(){
	var flag = $('.flag:checked').val();
	var lama = parseFloat($('#lama_angsuran').val());
	var amount = parseFloat(newText($('#amount').val()));
	var bunga_persen = parseFloat(newText($('#bunga').val()));
	if(flag=='Tahun'){
		var bunga = (amount) * (bunga_persen/100);
		var total_pinjam = amount+bunga;
		var perbulan = total_pinjam/(lama*12);
	} else {
		var bunga = (amount) * (bunga_persen*lama);
		var total_pinjam = amount+(bunga/100);
		var perbulan = total_pinjam/lama;
	}
	if(isNaN(perbulan)){
		perbulan = 0;
	}
	$('#perbulan').val(perbulan).formatCurrency({ symbol:"", });
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
                amount: { required: true, },
                lama_angsuran: { required: true, },
                flag: { required: true, },
                bunga: { required: true, },
                perbulan: { required: true, },
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


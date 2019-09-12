/*jQuery(document).ready(function () {
    form_validation.init();

	get_maksimal_pinjam();
	angsuran_perbulan();
	//bunga_persen();
	jQuery('#memberid').on('change', function(){
		get_maksimal_pinjam();
	});
	//jQuery('.flag').on('change', function(){
		//bunga_persen();
	//});
	jQuery('#lama_angsuran').on('change', function(){
		angsuran_perbulan();
	});
	//jQuery('#bunga').on('change', function(){
	//	angsuran_perbulan();
	//});
	jQuery('#amount').on('keyup', function(){
		angsuran_perbulan();
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
						}
				},
                memberid: { required: true, },
                amount: { required: true, },
                lama_angsuran: { required: true, },
                //flag: { required: true, },
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
*/
	function setbunga()
	{
		var theday =  document.getElementById('date').value;
		var d = new Date(theday);
		var d1 = new Date (2022,9,8); 
		var thn = d.getFullYear();
		
		if (d < d1)
		{
			document.getElementById('bunga').value = 0.02 ;
			//document.getElementById('date').value = d;
		}
		else if (d > d1)
		{
			document.getElementById('bunga').value = 0.05;
			//document.getElementById('date').value = d;
		}
		
		
	}
	
	function hitung_perbulan(){
	
	var lama = document.getElementById('lama_angsuran').value;
	var amount = document.getElementById('amount').value;
	var bunga_persen = document.getElementById('bunga').value;
	var amount2 = toFloat(amount);
	
	
	
	var bunga = (amount2) * (bunga_persen/100);
	var total_pinjam = amount2+bunga;
	var perbulan = total_pinjam/lama;
	
	var perbulangS = perbulan.toString();
	var perbln = perbulangS.split('.');
	//alert(perbln[0]);
	document.getElementById('perbulan').value = formatter.format(perbulan);
	//alert();
	alert(aku);
}	

function toFloat(x) {
  var y = x.split(',');
  var z = y.join("");
  return parseFloat(z);
}

function max_pinjaman()
{
	var date = document.getElementById('date').value;
	var memberid = document.getElementById('memberid').value;
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
	var maxi = document.getElementById('maksimal').value;
	
}
const formatter = new Intl.NumberFormat('en-US', {
  style: 'currency',
  currency: 'IDR',
  minimumFractionDigits: 2
})

function cek_maks()
{
	var amount = toFloat(document.getElementById('amount').value);
	
	if (amount < aku) 
	{
		//alert("yes");
	}
	else{
		//alert("no");
		document.getElementById('peringatan').innerHTML = "Amount melebihi maksimal pinjam, silahkan kurangi";
	}
}
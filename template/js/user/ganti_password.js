jQuery(document).ready(function () {
    form_validation.init();
});

var form_validation = function () {

    var handleValidate = function () {
        $("#form-tambah").validate({
            errorElement: 'span',
            errorClass: 'help-block',
            rules: {
                password_lama: {
                    required: true,
					remote:{
						url: base_url + "index.php/"+controller+"/check_password_lama",
						data: {username:$('#username').val()},
						type: "post"
						}
                },
                password_baru: {
                    required: true,
					minlength: 5,
                },
				"conf_password_baru"	:{
					required:true,
					equalTo: "#password_baru",
				},
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

jQuery(document).ready(function () {
    form_validation.init();
    form_validation_edit.init();
});

var form_validation = function () {

    var handleValidate = function () {
        $("#form-tambah").validate({
			ignore: ":hidden:not(.chosen)",
            errorElement: 'span',
            errorClass: 'help-block',
            rules: {
                roleid: { required: true,},
                employeeid: { required: true,},
				username:{
						required:true,
						minlength: 3,
						remote:{
							url: base_url + "index.php/"+controller+"/check_username",
							//data: {username:$('#username').val()},
							type: "post"
							}
				},

                password: {
                    required: true,
                    minlength: 5
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

var form_validation_edit = function () {

    var handleValidate = function () {
        $("#form-edit").validate({
            errorElement: 'span',
            errorClass: 'help-block',
            rules: {
                roleid: { required: true,},
                employeeid: { required: true,},
				username:{
						required:true,
						minlength: 3,
						remote:{
							url: base_url + "index.php/"+controller+"/check_username",
							//data: {username:$('#username').val()},
							type: "post"
							}
				},

                password: {
                    required: false,
                    minlength: 5
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

jQuery(document).ready(function () {
    form_validation.init();
    form_validation_perubahan.init();
});

var form_validation = function () {

    var handleValidate = function () {
		$("#form-tambah").validate({
            errorElement: 'span',
            errorClass: 'help-block',
            rules: {
                name: { required: true, },
                gender: { required: true, },
                companyid: { required: true, },
                date: { required: true, },
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


var form_validation_perubahan = function () {

    var handleValidate = function () {
		$("#form-perubahan").validate({
            errorElement: 'span',
            errorClass: 'help-block',
            rules: {
                perubahan_date: { required: true, },
                perubahan_pokok: { required: true, },
                perubahan_wajib: { required: true, },
                perubahan_sukarela: { required: true, },
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
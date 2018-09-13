jQuery(document).ready(function () {
    form_validation.init();
});

var form_validation = function () {

    var handleValidate = function () {
		$("#form-tambah").validate({
            errorElement: 'span',
            errorClass: 'help-block',
            rules: {
                name: { required: true, },
                gender: { required: true, },
                email: { required: false,email: true, },
                status: { required: true, },
                photo: {accept: "png|jpe?g|gif"},
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
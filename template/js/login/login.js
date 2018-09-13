jQuery(document).ready(function () {
    form_validation.init();
});

var form_validation = function () {

    var handleValidate = function () {
        $("#login-form").validate({
            errorElement: 'span',
            errorClass: 'help-block',
            rules: {
                username: {
                    required: true,
                    minlength: 3
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

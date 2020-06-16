"use strict";

// Class Definition
var KTLoginGeneral = function() {

    var login = $('#kt_login');

    var handleSignInFormSubmit = function() {
        $('#kt_login_signin_submit').click(function(e) {
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');

            form.validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true
                    }
                }
            });

            if (!form.valid()) {
                return;
            }

            btn.addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);
            $('#login-form').submit();
        });
    }

    var handleSignUpFormSubmit = function() {
        $('#kt_login_signup_submit').click(function(e) {
            e.preventDefault();

            var btn = $(this);
            var form = $(this).closest('form');

            form.validate({
                rules: {
                    name: {
                        required: true,
                        maxlength: 80,
                    },
                    email: {
                        required: true,
                        email: true,
                    },
                    student_id: {
                        required: true,
                        pattern: '^[P][0-9]{1,8}?$',
                    },
                    ic_number: {
                        required: true,
                        pattern: '(([[1-9]{2})(0[1-9]|1[0-2])(0[1-9]|[12][0-9]|3[01]))-([0-9]{2})-([0-9]{4})'
                    },
                    phone_number: {
                        required: true,
                        pattern: '^(01)[0-46-9]*[0-9]{7,8}$'
                    },
                    password: {
                        required: true,
                        minlength: 16,
                    },
                    password_confirmation: {
                        required: true,
                        minlength: 16,
                        equalTo: '#password'
                    }
                }
            });

            if (!form.valid()) {
                return;
            }

            btn.addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);
            $('#register-form').submit();
        });
    }

    var handleForgotFormSubmit = function() {
        $('#kt_login_forgot_submit').click(function(e) {
            e.preventDefault();

            var btn = $(this);
            var form = $(this).closest('form');

            form.validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    }
                }
            });

            if (!form.valid()) {
                return;
            }

            btn.addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);
            $('#forgot-form').submit();
        });
    }

    // Public Functions
    return {
        // public functions
        init: function() {
            handleSignInFormSubmit();
            handleSignUpFormSubmit();
            handleForgotFormSubmit();
        }
    };
}();

// Class Initialization
jQuery(document).ready(function() {
    KTLoginGeneral.init();
});

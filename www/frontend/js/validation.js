function sendForm(form) {
    $.ajax({
        type: form.method,
        url: form.action,
        data: $(form).serialize(),
        success: function (response) {
            if (response.error) {
                alert('Системна помилка. Будь ласка, спробуйте ще раз.');
                window.location.reload();
                return false;
            }
            $('#popup_answer').show();
            $('#popup_answer_wrap').removeClass('animate-away');
            $('#popup_answer_wrap').addClass('animate-in');
        },
        error: function (xhr, error) {
            alert('Системна помилка. Будь ласка, спробуйте ще раз.');
            window.location.reload();
            return false;
        }
    });
}


$('#contact-form').validate({
    validClass: "success-validate",
    errorClass: "error-validate",
    errorElement: "span",

    rules: {
        name: {
            required: true,
            minlength: 2
        },
        phone: {
            required: true,
            minlength: 2,
            maxlength: 30,
        }
    },
    submitHandler: function (form) {
        form.submit();
        // sendForm(form);
        return false;
    }
});


$('#popup-form').validate({
    validClass: "success-validate",
    errorClass: "error-validate",
    errorElement: "span",

    rules: {
        name: {
            required: true,
            minlength: 2
        },
        phone: {
            required: true,
            minlength: 2,
            maxlength: 30,
        }
    },
    submitHandler: function (form) {
        form.submit();
        // sendForm(form);
        return false;
    }

});


// $('.phone-mask').mask('+38(000)-00-00-000',{placeholder: "+38"});
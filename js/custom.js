$("#save").validate({
    rules: {
        name: {
            minilength:2
        }
    },
    messages: {
        required: "Please enter your name",
        minlength: "Name at least 2 characters"

    },

    submitHandler: function(form) {
        form.submit();
    }
});
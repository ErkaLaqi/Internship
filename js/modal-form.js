$.validator.addMethod("passwordRule", function (value, element){
    return /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/.test(value);
}, 'Password must contain at least one uppercase, one lowercase, one digit, one special character')

$("#modalForm").validate({

    rules: {
        name: {
            required: true,
            lettersOnly: true
        },
        lastname: {
            required: true,
            lettersOnly: true
        },
        birthday: "required",
        phone: {
            required: true,
            minlength: 8,
            digit: true
        },
        email: {
            required: true,
            email: true
        },
        password: {
            required: true,
            minlength: 8
        },
        confirmPassword: {
            required: true,
            minlength: 8,
            equalTo: "#password"
        },

    },
    messages: {
        name: {
            required: "Please enter user firstname!",
            lettersOnly: "Name should include letters only!"
        },
        lastname: {
            required: "Please enter user lastname!",
            lettersOnly: "Lastname should include letters only!"
        },
        birthday: "Please enter user birthday!",
        phone: {
            required: "Please enter user phone number!",
            minlength: "Phone should have at least 10 digits",
            digit: "Phone number must contain only numbers!"
        },
        password: {
            required: "Please provide a password!",
            minlength: "Password should be at least 8 characters long"
        },
        confirmPassword: {
            required: "Please confirm password!",
            minlength: "Password should be at least 8 characters long",
            equalTo: "Password does not match, please enter the same password as above!"
        }

    }

});
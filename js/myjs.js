$(document).ready(function(){


})

//Insert Record in Database
function Insert_record(){

    $(document).on('click','#submit', function (){
        var name = $('#name').val();
        var lastname = $('#lastname').val();
        var birthday = $('#birthdayname').val();
        var phone = $('#phone').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var confirmPassword = $('#confirmPassword').val();
        console.log(name,lastname,birthday,phone,email,password,confirmPassword);


    })
}
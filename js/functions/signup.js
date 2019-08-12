$('#submit_signup').on('click',function () {
    $user_signup = $('#user_signup').val();
    $pass_signup = $('#pass_signup').val();
    $repass_signup = $('#repass_signup').val();
    if ($user_signup == '' || $pass_signup =='' || $repass_signup == '')
    {
        $('#formSignup .alert').removeClass('hidden');
        $('#formSignup .alert').html('Vui lòng điền đầy đủ thông tin !');
    }
    else
    {
        $.ajax({
            url : 'signup.php',
            type : 'POST',
            data : {
                user_signup : $user_signup,
                pass_signup : $pass_signup,
                repass_signup : $repass_signup
            }, success: function (data) {
                $('#formSignup .alert').html(data);

            }
        });
    }
});
$('.password').click(function (e) {
    var btn = $(this);
    var pass = $(btn.data('password'));

    if (pass.attr('type') === 'password')
    {
        pass.attr('type', 'text');
        btn.removeClass('btn-outline-primary').addClass('btn-primary');
        btn.find('i').removeClass('fa-eye').addClass('fa-eye-slash');
    }else{
        pass.attr('type', 'password');
        btn.addClass('btn-outline-primary').removeClass('btn-primary');
        btn.find('i').addClass('fa-eye').removeClass('fa-eye-slash');
    }

});

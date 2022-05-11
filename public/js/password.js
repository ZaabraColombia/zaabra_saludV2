$('.password').click(function (e) {
    var btn = $(this);
    var pass = $(btn.data('password'));
    var clas = $(this).data('class');

    if (pass.attr('type') === 'password')
    {
        pass.attr('type', 'text');
        btn.removeClass('btn-outline-' + clas).addClass('btn-' + clas);
        btn.find('i').removeClass('fa-eye').addClass('fa-eye-slash');
    }else{
        pass.attr('type', 'password');
        btn.addClass('btn-outline-' + clas).removeClass('btn-' + clas);
        btn.find('i').addClass('fa-eye').removeClass('fa-eye-slash');
    }

});

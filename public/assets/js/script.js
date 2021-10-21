// Inicialiação das funções
$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#form-login').find('input').on('keyup', function (e) {
        if (e.keyCode == 13) {
            $('#btn-login').trigger('click');
        }
    });

    $(document).on('click', '#btn-login', function () {
        var btn = $(this);
        var form = $('#form-login').serialize();
        var url = $('#form-login').attr('action');
        btn.html('<div class="spinner-border text-light" role="status"></div>');
        btn.prop('disabled', true);
        $('#form-login').find('input').prop('disabled', true);
        $('#form-login').find('.invalid-feedbeck').remove();

        var cpf = $('#form-login').find('.cpf').val();

        var isValidCpf = true;
        if(cpf){
            // Testa a validação
            if ( valida_cpf_cnpj( cpf ) == false ) {
                isValidCpf = false;
                $('#form-login').find('[name="cpf"]').focus().parent().append('<span class="invalid-feedbeck">O campo cpf está incorreto</span>');;
                btn.html('ENTRAR');
                btn.prop('disabled', false);
                $('#form-login').find('input').prop('disabled', false);
            }
        }

        if(isValidCpf){
            $.ajax({
                url: url,
                type: 'POST',
                data: form,
                success: (data) => {
                    // console.log(data);

                    window.location.href = data;
                },
                error: (err) => {
                    // console.log(err);
                    var errors = err.responseJSON.errors;

                    btn.html('ENTRAR');
                    btn.prop('disabled', false);
                    $('#form-login').find('input').prop('disabled', false);

                    if (errors) {
                        // console.log(errors);
                        $.each(errors, (key, value) => {
                            $('#form-login').find('[name="' + key + '"]').parent().append('<span class="invalid-feedbeck">' + value[0] + '</span>');
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: err.responseJSON.invalid
                        });
                    }
                }
            });
        }
    });

    // Btn para salvar
    $(document).on('click', '.btn-save', function(e) {
        var btn = $(this);
        var btnText = $(this).html();
        var route = $(this).data('route');
        var target = $(this).data('target');

        var form_dados = new FormData($(target)[0]);

        btn.html('<div class="spinner-border text-light" role="status"></div>');
        btn.prop('disabled', true);
        $(target).find('input').prop('disabled', true);
        $(target).find('.invalid-feedbeck').remove();

        $.ajax({
            url: route,
            type: 'POST',
            data: form_dados,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {
                // console.log(data);

                if(data[0] == 'success') {
                    switch(data[1]){
                        case 'local':
                            Swal.fire({
                                icon: 'success',
                                title: 'Dados atualizados com sucesso!'
                            });
                        break;
                        case 'redirect':
                            Swal.fire({
                                icon: 'success',
                                title: 'Dados atualizados com sucesso!'
                            });

                            setTimeout(() => {window.location.href = data[2]}, 2000);
                        break;
                        case 'step':
                            btn.html(btnText);
                            btn.prop('disabled', false);
                            $(target).find('input').prop('disabled', false);
                            if(data[2] == 'next') $(target).find('.next').trigger('click');

                            if(data[2] == 'finish') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Dados atualizados com sucesso!'
                                });
    
                                setTimeout(() => {window.location.href = data[3]}, 2000);
                            }
                        break;
                    }
                }
            },
            error: (err) => {
                // console.log(err);
                var errors = err.responseJSON.errors;

                btn.html(btnText);
                btn.prop('disabled', false);
                $(target).find('input').prop('disabled', false);

                if (errors) {
                    // console.log(errors);
                    $.each(errors, (key, value) => {
                        $(target).find('[name="' + key + '"]').parent().append('<span class="invalid-feedbeck">' + value[0] + '</span>');
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: err.responseJSON.invalid
                    });
                }
            }
        });
    });

    // Cookies-Idade
    $('.btn-yes-cookie-idade').on('click', function(){
        $('.cookie-idade').css({
            'width': '0',
            'transition': '.6s width',
        });
        setCookie('cookie_maior18', 'SIM');
    });

    $(function(){
        if(!getCookie('cookie_maior18')){
            var width = $(window).width();
            $('.cookie-idade').find('.container').css('min-width', width);

            $('.cookie-idade').css('width', '100%');
        }
    })
});

function setCookie(name, value, duration) {
    var cookie = name + "=" + escape(value) +
    ((duration) ? "; duration=" + duration.toGMTString() : "");

    document.cookie = cookie;
}

function getCookie(name) {
    var cookies = document.cookie;
    var prefix = name + "=";
    var begin = cookies.indexOf("; " + prefix);

    if (begin == -1) {

        begin = cookies.indexOf(prefix);

        if (begin != 0) {
            return null;
        }

    } else {
        begin += 2;
    }

    var end = cookies.indexOf(";", begin);

    if (end == -1) {
        end = cookies.length;                        
    }

    return unescape(cookies.substring(begin + prefix.length, end));
}

function deleteCookie(name) {
    if (getCookie(name)) {
        document.cookie = name + "=" + "; expires=Thu, 01-Jan-70 00:00:01 GMT";
    }
}
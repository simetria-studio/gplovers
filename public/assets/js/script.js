// Inicialiação das funções
$(document).ready(function() {
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
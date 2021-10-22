// Inicialiação das funções
$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.select2').select2();

    $('[name="tamanho"]').mask('0,00', {reverse: true});
    $('[name="peso"]').mask('000,00', {reverse: true});

    $(function(){
        if($('[name="estado"]')){
            $.ajax({
                url: '/buscaEstado',
                type: 'GET',
                success: (data) => {
                    // console.log(data);
                    for(var i=0; data.length>i; i++){
                        $('[name="estado"]').append('<option value="'+data[i].sigla+'" data-estado_id="'+data[i].id+'">'+data[i].sigla+' - '+data[i].titulo+'</option>');
                    }
                }
            });
        }
    });

    // Busca das cidades/municipios
    $(document).on('change', '[name="estado"]', function(){
        let estado_id = $(this).find(':selected').data('estado_id');
        let select = $(this).parent().parent().find('select[name="cidade"]');

        $.ajax({
            url: '/buscaCidade/'+estado_id,
            type: 'GET',
            success: (data) => {
                // console.log(data);
                select.empty();
                select.append('<option value="">- Selecione a Cidade -</option>');

                for(var i=0; data.length>i; i++){
                    select.append('<option value="'+data[i].titulo+'" data-cidade_id="'+data[i].id+'">'+data[i].titulo+'</option>');
                }
            }
        });
    });

    // Busca das cidades/municipios
    $(document).on('change', '[name="cidade"]', function(){
        let cidade_id = $(this).find(':selected').data('cidade_id');

        $.ajax({
            url: '/buscaBairro/'+cidade_id,
            type: 'GET',
            success: (data) => {
                // console.log(data);
                if(data.length == 0){
                    $('.bairro_select').addClass('d-none').removeAttr('name');
                    $('.bairro_input').removeClass('d-none').attr('name', 'bairro');
                }else{
                    $('.bairro_select').removeClass('d-none').attr('name', 'bairro');
                    $('.bairro_input').addClass('d-none').removeAttr('name');
                }

                $('.bairro_select').empty();
                $('.bairro_select').append('<option value="">- Selecione o Bairro -</option>');

                for(var i=0; data.length>i; i++){
                    $('.bairro_select').append('<option value="'+data[i].titulo+'">'+data[i].titulo+'</option>');
                }
            }
        });
    });

    $(function(){
        if($('[name="estado"]').data('local') !== ''){
            setTimeout(() => {
                $('[name="estado"]').val($('[name="estado"]').data('local'));
                $('[name="estado"]').trigger('change');

                setTimeout(() => {
                    $('[name="cidade"]').val($('[name="cidade"]').data('local'));
                    $('[name="cidade"]').trigger('change');

                    setTimeout(() => {
                        $('[name="bairro"]').val(($('[name="bairro"]').data('local')).replace('__', ' '));
                    }, 2200);
                }, 1600);
            }, 1000);
        }
    });

    $('#form-login').find('input').on('keyup', function (e) {
        if (e.keyCode == 13) {
            $('#btn-login').trigger('click');
        }
    });

    // Telefone/Celeular
    var behavior = function (val) {
        return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
    },
    options_fone = {
        onKeyPress: function (val, e, field, options_fone) {
            field.mask(behavior.apply({}, arguments), options_fone);
        }
    };
    $('[name="telefone"]').mask(behavior, options_fone);

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
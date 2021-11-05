// Inicialiação das funções
$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click', '.btn-lightbox-image', function(e){
        e.preventDefault();

        console.log($(this).attr('href'));
        $.slimbox($(this).attr('href'));

    });

    $(document).on('keyup focus', '[data-autocomplete="true"]', function(){
        var thiss = $(this);
        var tabela = $(this).data('tabela');

        $.ajax({
            url: '/buscaAutocomplete',
            type: 'POST',
            data: {tabela: tabela, nome: thiss.val()},
            success: (data) => {
                thiss.autocomplete({
                    source: data
                });
            }
        });
    });

    $(document).on('click', '.btn-pesquisa', function(){
        var data = {};
        $('.nav-filtro').css({'height': 0});
        $('.nav-filtro').find('.nav-filtro-selecao').css({'height': 0});

        $('.pesquisa').each(function(){
            data[$(this).attr('name')] = $(this).val();
        });
        $('.clientes').empty().html('<div class="div-spinner"><div class="spinner-border text-danger" style="width: 15rem; height: 15rem;" role="status"><span class="visually-hidden">Loading...</span></div></div>');

        $.ajax({
            url: '/buscaAnuncios',
            type: 'POST',
            data: data,
            success: (data) => {
                // console.log(data);
                $('.clientes').empty();

                $.each(data, (key, value) => {
                    // console.log(value);
                    if(value.fotos.length > 0){
                        var route = '';
                        $.ajax({url:'/geraSlug',type:'POST', data:{nome: value.data.nome, id: value.id},async: false,success: (data)=> {route = data.route;}});

                        var foto_random = Math.floor(Math.random() * (value.fotos.length));

                        $('.clientes').append(
                            '<div class="card mb-5">'+
                                '<div class="imagem">'+
                                    '<a href="'+route+'">'+
                                        '<img src="/storage/user_'+value.id+'/'+(value.fotos[foto_random].path)+'" />'+
                                    '</a>'+
                                '</div>'+
                                '<div class="descricao">'+
                                    '<div class="text-center">'+
                                        '<p>'+((value.data.nome.split(' '))[0])+', '+value.data.idade+' Anos</p>'+
                                        '<p>'+value.local.cidade+'/'+value.local.estado+'</p>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'
                        );
                    }
                });
            }
        });
    });

    $('.select2').select2();

    $('.real').mask('000.000,00', {reverse: true});
    $('[name="tamanho"]').mask('0,00', {reverse: true});
    $('[name="peso"]').mask('000,00', {reverse: true});
    $('.horas').mask('00:00', {reverse: true});

    $(document).on('click', '.btn-filtro', function(e) {
        e.preventDefault();
        var height_total = $(window).height();
        var height_header = $('.header').height();
        var height_nav_filter = $('.nav-filtro').height();

        if(height_nav_filter == '0'){
            $('.nav-filtro').css({'height': (height_total - height_header)});
            $('.nav-filtro').find('.nav-filtro-selecao').css({'height': (height_total - height_header)});
            $('body').css('overflow', 'hidden');
        }else{
            $('.nav-filtro').css({'height': 0});
            $('.nav-filtro').find('.nav-filtro-selecao').css({'height': 0});
            $('body').css('overflow', 'auto');

            $('.btn-pesquisa').trigger('click');
        }
    });

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
        if($('[name="estado"]').data('local')){
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

    $(document).on('click', '[name="24horas"]', function(){
        if($(this).prop('checked')){
            $('.horario').parent().addClass('d-none');
        }else{
            $('.horario').parent().removeClass('d-none');
        }
    });
    $(function(){
        if($('[name="24horas"]').prop('checked')){
            $('.horario').parent().addClass('d-none');
        }else{
            $('.horario').parent().removeClass('d-none');
        }
    });

    // Adicionando imagens
    // Adicionando imagem
    $(document).on('click', '.btn-add-foto', function(e){
        e.preventDefault();
        $(this).parent().find('.add-foto').trigger('click');
    });
    $(document).on('change', '.add-foto', function(){
        $(this).removeClass('add-foto');

        $(this).parent().find('.btn-add-foto').removeClass('btn-c-purple btn-add-foto').addClass('btn-c-purple btn-remove-foto').html('x');

        $(this).parent().parent().append(
            '<div class="col-6 col-md-3 mb-2">'+
                '<button type="button" class="btn btn-c-purple btn-add-foto">+</button>'+
                '<input type="file" class="d-none add-foto" name="foto[]">'+
                '<div class="foto"></div>'+
            '</div>'
        );

        var form_img = $(this).parent();

        var preview = form_img.find('.foto');
        var files   = $(this).prop('files');

        function readAndPreview(file) {
            // Make sure `file.name` matches our extensions criteria
            if ( /\.(jpe?g|png|gif)$/i.test(file.name) ) {
                var reader = new FileReader();

                reader.addEventListener("load", function () {
                var image = new Image();
                image.classList = 'rounded img-fluid';
                // image.height = 180;
                image.title = file.name;
                image.src = this.result;
                preview.append( image );
                }, false);

                reader.readAsDataURL(file);
            }
        }

        if (files) {
            [].forEach.call(files, readAndPreview);
        }
    });
    $(document).on('click', '.btn-remove-foto', function(){
        $(this).parent().remove();
    });

    $('#primeiro').on('click', function () {
        var card = $('#primeiro').attr('checked', true);
        if (card) {
            // console.log('e true');
            $('#card').removeClass("d-none");
        } else {
            console.log('e falso');
        }

    });
    $('#segundo').on('click', function () {
        var money = $('#segundo').attr('checked', true);
        if (money) {
            // console.log('e true');
            $('#card').addClass("d-none");
        } else {
        }
    });

    $(document).on('click', '.form-check-label', function(){
        $('.form-check-label').removeClass('active');

        $(this).addClass('active');
    });

    // Checkout
    $(document).on('click', '#btnCheckout', function () {
        var route = $(this).data('route');
        var dados = $('#form-checkout').serialize();

        var metodo = $('[name="metodo"]:checked').val();

        var isValid = true;
        if(metodo == 'card'){
            $('.req').each(function () {
                if ($(this).val() == '') {

                    isValid = false;
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid');
                }
            });
        }

        if (isValid) {
            $.ajax({
                url: route,
                type: 'POST',
                data: dados,
                success: (data) => {
                    console.log(data);
                    if (data[0] == 'success') {
                        window.location.href = data[1];
                    }

                },
                error: (err) => {
                    //   console.log(err.responseJSON);
                    if (err.responseJSON == 'refused') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Algo de Errado!',
                            text: "Compra não autorizada, certifique que todos os dados estão corretos"

                        });
                    }

                }

            });
        }
    });

    // Novo cache
    $(document).on('click', '.btn-new-cache', function(){
        var caches = $('.caches');
        var cache_inputs = parseInt($('.caches').find('.cache_inputs').val()) || 0;

        var cache = 0;
        caches.find('.cache').each(function(){
            if($(this).hasClass('d-none') == false) cache += 1;
        });

        if($(caches.find('.cache')[cache]).hasClass('d-none')) {
            $(caches.find('.cache')[cache]).removeClass('d-none');
            $(caches.find('.cache')[cache-1]).find('.btn-remove-cache').parent().addClass('d-none');
            $(caches.find('.cache')[cache]).find('.btn-remove-cache').parent().removeClass('d-none');
        }

        if(cache == cache_inputs) $(this).addClass('d-none');
    });
    $(document).on('click', '.btn-remove-cache', function(){
        $('.btn-new-cache').removeClass('d-none');
        var btn = $(this);
        var cache_atual = btn.parent().parent();
        var cache_previous = btn.parent().parent().prev();

        btn.parent().addClass('d-none');
        cache_atual.addClass('d-none').find('input').val('');
        cache_previous.find('.btn-remove-cache').parent().removeClass('d-none');
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
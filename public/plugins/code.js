import QrScanner from "/plugins/qr-scanner.min.js";
QrScanner.WORKER_PATH = '/plugins/qr-scanner-worker.min.js';

$(document).on('click', '#copia', function(){
   let code = $('#code').attr('src');
    QrScanner.scanImage(code)
    .then(result => {
        navigator.clipboard.writeText(result);
        $('#copia').css({
            'background-color':'green',
            'color':'white'
        }).html('Copiado <i class="fas fa-check"></i>');
    })
});

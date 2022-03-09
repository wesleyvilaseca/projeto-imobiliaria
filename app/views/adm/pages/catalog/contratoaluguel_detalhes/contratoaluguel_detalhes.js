function modal_repasse(contrato_id, fatura_id, status_repasse) {
    $.ajax({
        type: 'POST',
        data: {
            fatura_id, status_repasse, contrato_id
        },
        url: `${base_url}admin-catalog-contratoalugueldetalhes/getmodalRepasse`,
        beforeSend: function () {
            console.log('procurando...');
        },
        success: function (response) {
            if (!response.success) {
                $(".taxas").css("display", "none");
                $(".content_modal_repasse").html('');
                return helper.error({ mensagem: response.msg });
            }


            $(".content_modal_repasse").html(response.data);
            var myModal_ = new bootstrap.Modal(document.getElementById('modal_repasse'))
            myModal_.show()

        },
        error: function () {
            console.log('erro na operação!');
        }
    });
}

function modal_fatura(fatura_id, contrato_id) {
    $.ajax({
        type: 'POST',
        data: {
            fatura_id, contrato_id
        },
        url: `${base_url}admin-catalog-contratoalugueldetalhes/getmodalFatura`,
        beforeSend: function () {
            console.log('procurando...');
        },
        success: function (response) {
            if (!response.success) {
                $(".taxas").css("display", "none");
                $(".content_modal_fatura").html('');
                return helper.error({ mensagem: response.msg });
            }


            $(".content_modal_fatura").html(response.data);
            var myModal = new bootstrap.Modal(document.getElementById('modal_fatura'))
            myModal.show()

        },
        error: function () {
            console.log('erro na operação!');
        }
    });
}

function close_modal(id) {
    return $(`#${id}`).hide('modal');
}
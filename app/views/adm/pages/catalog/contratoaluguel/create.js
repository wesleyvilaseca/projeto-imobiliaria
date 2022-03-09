function selectlocador(locador_id = null) {
    var locador = $("#locador_id").val() ? $("#locador_id").val() : locador_id ? locador_id : null;
    if (locador) {
        $.ajax({
            type: 'POST',
            data: {},
            url: `${base_url}admin-catalog-contratoaluguel/getImoveis/${locador}`,
            beforeSend: function () {
                console.log('procurando...');
            },
            success: function (response) {
                if (!response.success) {
                    $(".taxas").css("display", "none");
                    $(".selectimovel").html('');
                    return helper.error({ mensagem: response.msg });
                }
                $(".selectimovel").html(response.data);

                if (imovel_id) {
                    $("#imovel_id").val(imovel_id);
                    selectimovel();
                }
            },
            error: function () {
                console.log('erro ao atualizar!');
            }
        });
    } else {
        $(".taxas").css("display", "none");
    }
}

function selectimovel() {
    if ($("#imovel_id").val()) {
        $(".taxas").css("display", "block");
    } else {
        $(".taxas").css("display", "none");
    }
}

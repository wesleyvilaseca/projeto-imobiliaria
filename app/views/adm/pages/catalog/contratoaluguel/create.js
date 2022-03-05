function selectlocador() {
    if ($("#locador_id").val()) {
        $.ajax({
            type: 'POST',
            data: {},
            url: `${base_url}admin-catalog-contratoaluguel/getImoveis/${$("#locador_id").val()}`,
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
            },
            error: function () {
                console.log('erro ao atualizar!');
            }
        });
    }else {
        $(".taxas").css("display", "none");
    }
}

function selectimovel() {
    if ($("#imovel_id").val()) {
        $(".taxas").css("display", "block");
    }else {
        $(".taxas").css("display", "none");
    }
}
/**
 * by wesley vila seca sanches
 * git: github.com/wesleyvilaseca
 */

 var helper = {
    cssLoad: function () {
        let url = base_url + 'assets/principal-cadastro-login/css/load.css';
        var link = document.createElement('link');
        link.setAttribute('type', 'text/css');
        link.setAttribute('rel', 'stylesheet');
        link.setAttribute('title', 'cssLoad');
        link.setAttribute('href', url);
        document.getElementsByTagName("head").item(0).appendChild(link);
    },
    removeCssLoad: function () {
        $('link[title="cssLoad"]').remove();
    },
    select2: function (input) {
        if (Array.isArray(input)) {
            for (var i in input) {
                $(`#${input[i][0]}`).val((input[i][2]) ? input[i][2] : null).select2({
                    placeholder: (input[i][1]) ? input[i][1] : '',
                    allowClear: true,
                    multiple: (input[i][3]) ? input[i][3] : false,
                });
            }
        } else {
            helper.error({
                mensagem: 'Dev! as referências de input do tipo' +
                    'select2, precisa ser em array: ex : [["id-input", "placeholder"],["id-input2, placeholder"]]'
            });
        }
    },
    reloadtable: function (id) {
        $(`#${id}`).DataTable().ajax.reload();
    },
    clearforms: function (data = null, formid = null, clearallforms = false) {
        if (data) {
            if (data.form) {
                $(`#${data.form}`).find(':input').not(':button, :submit, :reset, :checkbox, :radio'/*, :hidden */).val(null);
                // $(`#${data.form}`).find(':checkbox, :radio').prop('checked', false);
                $(`#${data.form}`).find('.select2').val(null).trigger('change');
                // $('.select2').val(null).trigger('change');
                if ($("#img-preview").length) {
                    var img = document.getElementById("img-preview");
                    img.querySelector(".img-preview-text").style.display = "block";
                    img.querySelector(".img-preview-img").style.display = "none";
                }
            }

            if (clearallforms) {
                $(':input').not(':button, :submit, :reset, :hidden, :checkbox, :radio').val(null);
                $(':checkbox, :radio').prop('checked', false);
            }

            if (data.modal)
                $("#" + data.modal).modal('hide');

            if (data.table)
                helper.reloadtable(data.table);

            if (data.redirect)
                window.location.href = data.redirect;
        }

        if (formid) {
            $(`#${formid}`).find(':input').not(':button, :submit, :reset, :hidden, :checkbox, :radio').val(null);
            $('.select2').val(null).trigger('change');
            //$(`#${formid}`).find(':checkbox, :radio').prop('checked', false);
        }

    },
    replace: function (obj, find, replace) {
        return obj = obj.replace(find, replace);
    },
    tooltip: function () { $('[data-toggle="tooltip"]').tooltip({ html: true }) },
    valores: function (obj, precisao, prefixo = '') {
        for (var i in obj) {
            $("#" + obj[i]).maskMoney({ prefix: prefixo, precision: precisao, allowNegative: true, thousands: '.', decimal: ',', affixesStay: false });
        }
    },
    editor: function (obj) {
        for (var i in obj) {
            tinymce.init({
                selector: '#' + obj[i],
                language: "pt_BR",
                language_url: base_url + "assets/adm/js/plugins/tinymce/langs/pt_BR.js",
                //plugins: 'a11ychecker advcode casechange formatpainter linkchecker autolink lists checklist media permanentpen powerpaste table advtable tinymcespellchecker',
                toolbar_mode: 'floating',
                height: "300",
                branding: false,
                mobile: { menubar: true }
                //toolbar: a11ycheck addcomment showcomments casechange checklist code formatpainter pageembed permanentpen table
                //plugins: 'a11ychecker advcode casechange formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
            });
        }
    },
    error: function (data) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            html: data.mensagem,//(data.mensagem) ? data.mensagem : 'Aconteceu um erro interno, tente mais tarde',
            onAfterClose: () => {
                if (data.input) {
                    if (Array.isArray(data.input)) {
                        for (var i in data.input) {
                            if ($(`#${data.input[i]}`).hasClass('select2')) {
                                $(`#${data.input[i]}`).select2('open');
                            } else {
                                var input = document.getElementById(data.input[i]);
                                input.focus();
                                input.classList.add('is-invalid');
                                let rmverro = function () {
                                    input.classList.remove('is-invalid');
                                    clearInterval(interval);
                                }
                                let interval = setInterval(rmverro, 8000);
                            }
                        }

                    } else {
                        if ($(`#${data.input}`).hasClass('select2')) {
                            $(`#${data.input}`).select2('open');
                        } else {
                            var input = document.getElementById(data.input);
                            input.focus(); input.classList.add('is-invalid');
                            let rmverro = function () {
                                input.classList.remove('is-invalid');
                                clearInterval(interval);
                            }
                            let interval = setInterval(rmverro, 8000);
                        }
                    }
                }

                if (data.tab) {
                    $('.nav a[href="#' + data.tab + '"]').tab('show');
                }

                if (data.invalid_token) {
                    window.location.href = data.redirect;
                }
            }
        });
    },
    success: function (data) {
        Swal.fire({
            icon: 'success',
            title: '',
            html: data.mensagem,
        }).then((result) => {
            if (result.isConfirmed) {
                if (data.reload) return location.reload();

                if (data.redirect) return window.location.href = data.redirect;
            }
        });
    },
    b64: function (str) {
        return btoa(encodeURIComponent(str).replace(/%([0-9A-F]{2})/g,
            function toSolidBytes(match, p1) {
                return String.fromCharCode('0x' + p1);
            }));
    },
    b64D: function (str) {
        // Going backwards: from bytestream, to percent-encoding, to original string.
        return decodeURIComponent(atob(str).split('').map(function (c) {
            return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
        }).join(''));
    },
    convertFormJson: function (form) {
        var form_cad = form;
        var obj_cadastro = {};
        form_cad.forEach((value, key) => {
            obj_cadastro[key] = value
        });
        return obj_cadastro;
    },
    getpoliticacookies: function () {
        let cookies = helper.getLocalStorage('cookies');//localStorage.getItem("cookies");
        if (cookies != 1 || cookies == null) {
            let html = `<div class="cookies-container">
                    <div class="cookies-content">
                    <div class="row">
                    <div class="col-sm-10">
                    <p>Utilizamos cookies e tecnologias semelhantes, ao continuar navegando, você concorda com com a nossa <a>Política de Privacidade</a></p>
                    </div>
                    <div class="col-sm-2">
                    <input type="button" class="btn btn-warning btn-block" value="ok" onclick="helper.politicacookies()"> 
                    </div>
                    </div>
                    </div>
                    </div>`;
            return html;
        } else {
            return false;
        }
    },
    politicacookies: function () {
        helper.setLocalStorage('cookies', 1)
        //localStorage.setItem("cookies", 1);
        return $('.cookies-container').fadeOut();
    },
    rAjax: function (obj, isform = false, retorno = false, encode64 = false, loader = true) {
        if (isform) {
            var form = (encode64) ? helper.b64(JSON.stringify(obj)) : JSON.stringify(obj);
        }
        if (retorno) {
            if (loader) cssLoad();
            return $.ajax({
                url: obj.route,
                type: 'POST',
                dataType: 'json',
                data: { formulario: (isform) ? form : null },
            });
        } else {
            cssLoad();
            $.ajax({ url: obj.route, type: 'POST', dataType: 'json', data: { formulario: (isform) ? form : null } });
        }
    },
    rAjax_arquivo: function (file, obj, retorno = false, encode64 = false) {
        cssLoad();
        if (retorno) {
            return $.ajax({
                url: `${obj.route}/${(encode64) ? helper.b64(JSON.stringify(obj)) : obj}`,
                type: 'POST',
                dataType: 'json',
                data: file,
                cache: false,
                contentType: false,
                processData: false
            });
        }

    },
    setLocalStorage: function (key, value, isobj = true) {
        return localStorage.setItem(key, (isobj) ? JSON.stringify(value) : value);
    },
    deleteStorage: function (key) {
        return localStorage.removeItem(key);
    },
    getLocalStorage: function (key) {
        let dados = localStorage.getItem(key);
        if (dados) { return dados; }
        else { return false; }
    },
    getUrlVars: function () {
        var vars = {};
        var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi,
            function (m, key, value) {
                vars[key] = value;
            });
        return vars;
    },
    getInFor: function (arr, key, value) {
        for (var i = 0, iLen = arr.length; i < iLen; i++) {
            if (arr[i][key] == value) return arr[i];
        }
    },
    recaptchav3: function (input) {
        grecaptcha.ready(function () {
            grecaptcha.execute(sitekey, { action: 'submit' }).then(function (token) {
                document.getElementById(input).value = token;
            });
        });
    },
    string_to_slug: function (str) {
        str = str.replace(/^\s+|\s+$/g, ''); // trim
        str = str.toLowerCase();

        // remove accents, swap ñ for n, etc
        var from = "àáãäâèéëêìíïîòóöôùúüûñç·/_,:;";
        var to = "aaaaaeeeeiiiioooouuuunc------";

        for (var i = 0, l = from.length; i < l; i++) {
            str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
        }

        str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
            .replace(/\s+/g, '-') // collapse whitespace and replace by -
            .replace(/-+/g, '-'); // collapse dashes

        return str;
    }
}

helper.crip = {
    Encripta: function (dados) {
        var mensx = "";
        var l;
        var i;
        var j = 0;
        var ch;
        ch = "assbdFbdpdgodPdpfPdAAdpeoseslsQQEcDDldiVVkadiedkdkLLnmlove";
        for (i = 0; i < dados.length; i++) {
            j++;
            l = (this.Asc(dados.substr(i, 1)) + (this.Asc(ch.substr(j, 1))));
            if (j == 50) {
                j = 1;
            }
            if (l > 255) {
                l -= 256;
            }
            mensx += (this.Chr(l));
        }
        return mensx;
    },

    Descripta: function (dados) {
        var mensx = "";
        var l;
        var i;
        var j = 0;
        var ch;
        ch = "assbdFbdpdgodPdpfPdAAdpeoseslsQQEcDDldiVVkadiedkdkLLnmlove";
        for (i = 0; i < dados.length; i++) {
            j++;
            l = (this.Asc(dados.substr(i, 1)) - (this.Asc(ch.substr(j, 1))));
            if (j == 50) {
                j = 1;
            }
            if (l < 0) {
                l += 256;
            }
            mensx += (this.Chr(l));
        }
        return mensx;
    },

    Asc: function (String) {
        return String.charCodeAt(0);
    },

    Chr: function (AsciiNum) {
        return String.fromCharCode(AsciiNum);
    }
}

/**
 * Obfuscate a plaintext string with a simple rotation algorithm similar to
 * the rot13 cipher.
 * @param  {[type]} key rotation index between 0 and n
 * @param  {Number} n   maximum char that will be affected by the algorithm
 * @return {[type]}     obfuscated string
 */
String.prototype.obfs = function (key, n = 126) {
    // return String itself if the given parameters are invalid
    if (!(typeof (key) === 'number' && key % 1 === 0)
        || !(typeof (key) === 'number' && key % 1 === 0)) {
        return this.toString();
    }

    var chars = this.toString().split('');

    for (var i = 0; i < chars.length; i++) {
        var c = chars[i].charCodeAt(0);

        if (c <= n) {
            chars[i] = String.fromCharCode((chars[i].charCodeAt(0) + key) % n);
        }
    }

    return chars.join('');
};

/**
 * De-obfuscate an obfuscated string with the method above.
 * @param  {[type]} key rotation index between 0 and n
 * @param  {Number} n   same number that was used for obfuscation
 * @return {[type]}     plaintext string
 */
String.prototype.defs = function (key, n = 126) {
    // return String itself if the given parameters are invalid
    if (!(typeof (key) === 'number' && key % 1 === 0)
        || !(typeof (key) === 'number' && key % 1 === 0)) {
        return this.toString();
    }

    return this.toString().obfs(n - key);
};
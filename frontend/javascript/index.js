function onLoadPage() {

    var query = location.search.slice(1);
    var partes = query.split('&');
    var data = {};

    partes.forEach(function(parte) {
        var chaveValor = parte.split('=');
        var chave = chaveValor[0];
        var valor = chaveValor[1];
        data[chave] = valor;

        if (valor == 1)
            alert("Enviado");
        if (valor == 2)
            alert("Erro");
    });
}

function validateForm() {

    var date = document.getElementById("date").value
    var text = document.getElementById("text").value
    var textArea = document.getElementById("textarea").value

    if (!validadeDate(date)) {
        alert("Digite uma data valida (mm-dd-YYYY)")
        return false
    }
    if (!validateText(text)) {
        alert("O texto deve possuir apenas letras minúsculas e espaços, com até 144 caracteres.")
        return false
    }
    if (!validateTextArea(textArea)) {
        alert("O texto grande deve possuir apenas letras maiúsculas, números e espaços, com até 255 caracteres.")
        return false
    }

    return true

}

function validadeDate(date) {

    // document.getElementById("date").value = dateFormated // Warning: The specified value "mm-dd-YYYY" does not conform to the required format, "yyyy-MM-dd".

    //<input type="date"> - VALORES
    // https://developer.mozilla.org/pt-BR/docs/Web/HTML/Element/Input/data

    // ....formato da data mostrada será escolhido baseado na localização definida no navegador do usuário, 
    // enquanto que a data em value sempre será formatado como yyyy-mm-dd.

    //MINHA CONCLUSÃO É DE QUE NÃO É POSSÍVEL SE TER UM CAMPO DE DATA NO FORMATO SOLICITADO NO EXERCICIO 4 ("mm-dd-YYYY")
    //ENTÃO NÃO VEJO COMO SERIA POSSÍVEL REALIZAR TAL VALIDAÇÃO UTILIZANDO O CAMPO DATE SEM AUXILIO DE QUALQUER BIBLIOTECA
    //SENDO ASSIM CRIEI UM CAMPO TIPO TEXTO APENAS COM A VALIDAÇÃO DO FORMATO

    if (!date) return false

    var month = date.substr(0, 2)
    var day = date.substr(3, 2)
    var year = date.substr(6, 9)
    var dateComp = month + "-" + day + "-" + year

    if (date === dateComp)
        return true
    else
        return false
}

function validateText(text) {
    var ret = false

    ret = text === null ? false : true

    if (ret === false) return ret

    var i = text.length <= 144 ? text.length : 0

    if (i === 0) return ret = false

    var character = ""

    while (i--) {
        character = text.charAt(i)
        ret = character.charCodeAt() >= 97 && character.charCodeAt() <= 122 || character.charCodeAt() == 32 ? true : false

        if (ret === false) return ret
    }

    return ret
}

function validateTextArea(textArea) {
    var ret = false

    ret = textArea === null ? false : true

    if (ret === false) return ret

    var i = textArea.length <= 255 ? textArea.length : 0

    if (i === 0) return ret = false

    var character = ""

    //Deveria Utilizar expressão regular
    while (i--) {
        character = textArea.charAt(i)
        console.log(character)
        ret = character.charCodeAt() >= 48 && character.charCodeAt() <= 57 || character.charCodeAt() >= 65 && character.charCodeAt() <= 90 ||
            character.charCodeAt() == 32 ? true : false

        if (ret === false) return ret
    }

    return ret
}

function maskDate(chars) {

    var v = chars.value;
    if (v.match(/^\d{2}$/) !== null) {
        chars.value = v + '-';
    } else if (v.match(/^\d{2}\-\d{2}$/) !== null) {
        chars.value = v + '-';
    }

}
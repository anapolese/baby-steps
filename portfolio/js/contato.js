function validaForm() {
    var email      = document.getElementById('email'),
        erro       = document.getElementsByTagName('span')[0],
        nome       = document.getElementById('name'),
        message    = document.getElementById('message'),
        regEx      = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/; 

    if (nome.value == '') {
        
        erro.innerHTML = '* Preencha campo nome';
        nome.focus();
        return false;

    } else if (email.value == '') {
        
        erro.innerHTML = '* Preencha campo email';
        email.focus();
        return false;

    } else if (regEx.test(email.value) == false) {
        
        erro.innerHTML = '* Preencha um email válido';
        email.focus();
        return false;

    } else if (message.value == '') {
        
        erro.innerHTML = '* Preencha campo mensagem';
        message.focus();
        return false;
    };
    
    return true;
};
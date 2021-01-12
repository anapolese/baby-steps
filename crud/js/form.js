let name = document.querySelector('#nome'),
    abbr = document.querySelector('#sigla'),
    err  = document.querySelector('#err');

function testInputs(){ 
   
   let emptyName = name.value === '',
       emptyAbbr = abbr.value === '';

   if (emptyName === true) {
      err.innerHTML = 'Campo NOME deve ser preenchido';
      name.focus();
      err.classList.remove('hidden');
      return false;
   } else if (emptyAbbr === true){
      err.innerHTML = 'Campo SIGLA deve ser preenchido';
      abbr.focus();
      err.classList.remove('hidden');
      return false;
   } else {
      return true; 
   }
    
}

name.focus();

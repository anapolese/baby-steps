let func     = document.querySelector('#funcionario'),
    gen      = document.querySelector('#genero'),
    nasc     = document.querySelector('#nascimento'),
    sal      = document.querySelector('#salario'),
    admissao = document.querySelector('#admissao'),
    dpto     = document.querySelector('#departamento'),
    form     = document.querySelector('form'),
    err      = document.querySelector('#err');


let funcAge = nasc.value;
console.log(funcAge);

function testInputs(){ 
   
   let emptyName   = func.value === '',
       emptyGen    = gen.value === '0',
       emptyNasc   = nasc.value === '',
       emptySal    = sal.value === '',
       emptyAdm    = admissao.value === '',
       emptyDpto   = dpto.value === '0';
   

    if (emptyName === true) {
      err.innerHTML = 'Campo nome deve ser preenchido';
      func.focus();
      err.classList.remove('hidden');
      return false;
   } else if (emptyGen === true){
      err.innerHTML = 'Campo GENERO deve ser preenchido';
      gen.focus();
      err.classList.remove('hidden');
      return false;
   } else if (emptyNasc === true){
      err.innerHTML = 'Campo DATA DE NASCIMENTO deve ser preenchido';
      nasc.focus();
      err.classList.remove('hidden');
      return false;
   } else if (emptySal === true){
      err.innerHTML = 'Campo SALÁRIO deve ser preenchido';
      sal.focus();
      err.classList.remove('hidden');
      return false;
   } else if (emptyAdm === true){
      err.innerHTML = 'Campo ADMISSAO deve ser preenchido';
      admissao.focus();
      err.classList.remove('hidden');
      return false;
   } else if (emptyDpto === true){
      err.innerHTML = 'Campo DEPARTAMENTO deve ser preenchido';
      dpto.focus();
      err.classList.remove('hidden');
      return false;
   } else {
      return true; 
   }
    
}

func.focus();


function testValue(event) {}
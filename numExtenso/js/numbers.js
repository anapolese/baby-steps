var hundreds    = ['Cento', 'Duzentos', 'Trezentos', 'Quatrocentos', 'Quinhentos', 'Seiscentos', 'Setecentos', 'Oitocentos', 'Novecentos'],
    tens        = ['Vinte', 'Trinta', 'Quarenta', 'Cinquenta', 'Sessenta', 'Setenta', 'Oitenta', 'Noventa'], 
    exceptions  = {0: 'Zero', 100: 'Cem'},
    tensExcep   = ['Dez', 'Onze', 'Doze', 'Treze', 'Quatorze', 'Quinze', 'Dezesseis', 'Dezessete', 'Dezoito', 'Dezenove'],
    units       = ['', 'Um', 'Dois', 'Três', 'Quatro', 'Cinco', 'Seis', 'Sete', 'Oito', 'Nove'],
    slider      = document.querySelector('#myRange'),
    number      = document.querySelector('#number'),
    writtenNum  = document.querySelector('#writtenNumber');

function updateValue() {
    number.value = slider.value;
    writtenNum.value = testNumber(number.value);
}


function testNumber(a) {
    if (exceptions[a]) return exceptions[a];
    else if (a.length === 1) return unit(a);
    else if (a.length === 2) return ten(a);
    else if (a.length === 3) return hundred(a);
    else return 'Ops... Eu ainda não aprendi esse número'
}

function unit(a) {
   return units[a];
}

function ten(a) {
    if (a[0] === '1') return tensExcep[parseInt(a[1])]; 
    else if ((a[0] !== '1') && (a[1] === '0')) return tens[parseInt(a[0]-2)];
    else return tens[parseInt(a[0]-2)] + ' e ' + units[parseInt(a[1])];
}

function hundred(a) {
    //centenas INTEIRAS
    if ((a[1] === '0') && (a[2] === '0')) return hundreds[parseInt(a[0]-1)]; 
    // centenas + unidades
    else if ((a[1] === '0') && (a[2] !== '0')) return hundreds[parseInt(a[0]-1)]+ ' e ' + units[parseInt(a[2])];
    // centenas + carac especiais
    else if ((a[1] === '1')) return hundreds[parseInt(a[0]-1)] + ' e ' + tensExcep[parseInt(a[2])];
    //centenas + dezenas
    else if ((a[1] !=='0') && (a[2] === '0')) return hundreds[parseInt(a[0]-1)] + ' e ' + tens[parseInt(a[1]-2)];
    //centenas + dezenas compostas
    else return hundreds[parseInt(a[0]-1)] + ' e ' + tens[parseInt(a[1]-2)] + ' e ' + units[parseInt(a[2])];
}

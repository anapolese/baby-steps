var centena        = ['Cento', 'Cem', 'Duzentos', 'Trezentos', 'Quatrocentos', 'Quinhentos', 'Seiscentos', 'Setecentos', 'Oitocentos', 'Novecentos'],
    dezena         = ['Vinte', 'Trinta', 'Quarenta', 'Cinquenta', 'Sessenta', 'Setenta', 'Oitenta', 'Noventa'],
    numEspeciais   = ['Dez', 'Onze', 'Doze', 'Treze', 'Catorze', 'Quinze', 'Dezesseis', 'Dezessete', 'Dezoito', 'Dezenove'],
    unidade        = ['Zero', 'Um', 'Dois', 'Três', 'Quatro', 'Cinco', 'Seis', 'Sete', 'Oito', 'Nove'],
    slider         = document.querySelector('#myRange'),
    numAtual       = document.querySelector('#number'),
    writtenNum     = document.querySelector('#writtenNumber');

function updateValue() {
    numAtual.value = slider.value;
    testNumber(numAtual.value);
}


function testNumber(a) {
    if (a.length === 1) unidades(a);
    else if (a.length === 2) dezenas(a);
    else centenas(a);
}

function unidades(a) {
    writtenNum.value = unidade[parseInt(a)];
}

function dezenas(a) {
    if (a[0] === '1') writtenNum.value = numEspeciais[parseInt(a[1])]; 
    else if ((a[0] !== '1') && (a[1] === '0')) writtenNum.value = dezena[parseInt(a[0]-2)];
    else writtenNum.value = dezena[parseInt(a[0]-2)] + ' e ' + unidade[parseInt(a[1])];
}

function centenas(a) {
    //centenas INTEIRAS
    if ((a[0] !== '0') && (a[1] === '0') && (a[2] === '0')) writtenNum.value = centena[parseInt(a[0])]; 
    // cento + unidades
    else if ((a[0] === '1') && (a[1] === '0') && (a[2] !== '0')) writtenNum.value = centena[0] + ' e ' + unidade[parseInt(a[2])];
    //cento + carac especiais
    else if ((a[0] === '1') && (a[1] === '1')) writtenNum.value = centena[0] + ' e ' + numEspeciais[parseInt(a[2])];
    //cento + dezenas
    else if ((a[0] === '1') && (a[1] !== '1') && (a[1] !=='0') && (a[2] === '0')) writtenNum.value = centena[0] + ' e ' + dezena[parseInt(a[1]-2)];
    //cento + dezenas compostas
    else if ((a[0] === '1') && (a[1] !== '1') && (a[1] !=='0')  && (a[2] !== '0')) writtenNum.value = centena[0] + ' e ' + dezena[parseInt(a[1]-2)] + ' e ' + unidade[parseInt(a[2])];
    //centenas + carac especiais
    else if ((a[0] !== '1') && (a[1] === '1')) writtenNum.value = centena[parseInt(a[0])] + ' e ' + numEspeciais[parseInt(a[2])];
    //centenas + unidades
    else if ((a[0] !== '1') && (a[1] === '0') && (a[2] !== '0')) writtenNum.value = centena[parseInt(a[0])] + ' e ' + unidade[parseInt(a[2])];
    //centenas COMPOSTAS
    else if ((a[0] !== '1') && (a[1] !== '1') && (a[2] !== '0')) writtenNum.value = centena[parseInt(a[0])] + ' e ' + dezena[parseInt(a[1]-2)]+ ' e ' + unidade[parseInt(a[2])];
    else writtenNum.value = centena[parseInt(a[0])] + ' e ' + dezena[parseInt(a[1]-2)];
}
'use strict';

window.addEventListener('load',() => {
  fetchUsers();
  preventFormSubmit();
  activateInputs();
  totalUser.innerHTML = 'Nenhum usuário filtrado';
  statsArea.innerHTML = 'Nada a ser exibido';
});

let inputText   = document.querySelector('#searchFor'),
    button      = document.querySelector('#search'),
    totalUser   = document.querySelector('#numResults'),
    statsArea   = document.querySelector('#statsResults'),
    ul          = document.querySelector('#statsUl'),
    showUsers   = document.querySelector('#searchResults'),
    globalUsers = [],
    newSearch,
    found;

async function fetchUsers() {
  const response = await fetch('https://randomuser.me/api/?seed=javascript&results=100&nat=BR&noinfo');
  const json = await response.json();
  globalUsers = json.results.map(user => { 
      return {
        id: user.login.uuid,
        gender: user.gender,
        name: user.name.first,
        lastName: user.name.last,
        age: user.dob.age,
        photo: user.picture.thumbnail
        }
    });
};

function preventFormSubmit() {
  function handleFormSubmit(event){
    event.preventDefault();
  }
  var form = document.querySelector('form');
  form.addEventListener('submit', handleFormSubmit);
}

function activateInputs() {

  function handleTyping(event) {
    const text    = event.target.value.trim();
    const hasText = text.length !== 0;
  
    if (hasText === true) {
      button.disabled = false;
      if (event.key === 'Enter') {
        searchPeople(text);
        clearInput();
      }
    } else {
      button.disabled = true;
    }
  };

  
  button.addEventListener('click', (event) => {
    if (event.type === 'click'){
      searchPeople(inputText.value);
      clearInput();
    };
  });
  
  inputText.addEventListener('keyup', handleTyping);

};

function searchPeople(newName) {  
  newSearch = newName.toLowerCase();
  found =  globalUsers.map(user => { 
    return {
      id: user.id,
      gender: user.gender,
      name: user.name.toLowerCase(),
      lastName: user.lastName.toLowerCase(),
      age: user.age,
      photo: user.photo
      }
  }).filter(user => user.name.includes(newSearch) === true || user.lastName.includes(newSearch))
  .sort((a, b) => {
    return a.name.length - b.name.length;
  });

  while (ul.firstChild) {
    ul.firstChild.remove();
  }

  while (showUsers.firstChild) {
    showUsers.firstChild.remove();
  }

  render(found);
}

function render(users) {
  renderUsers(users);
  renderStatistics(users);
  renderTotal(users);
}

function renderUsers(users) {
  if(users.length >= 1) {
    for(var i = 0; i < users.length; i++) {

      var photo = users[i].photo,
          name  = `${ucUpper(users[i].name)} ${ucUpper(users[i].lastName)}`,
          age   = users[i].age,
          div   = document.createElement('div'),
          p     = document.createElement('p'),
          img   = document.createElement('img');

          img.src = photo;
          img.classList.add('circle');
          p.innerText = `${name}, ${age}`;
          p.classList.add('fixMe');
          div.classList.add('col');
          div.classList.add('s7');
      
          div.appendChild(img);
          div.appendChild(p);
          showUsers.appendChild(div);  
    }
  }
}


function renderStatistics(users) {
  if(users.length >= 1) {
  const male = users.filter(person => {
    return person.gender === 'male';
  });

  const female = users.filter(person => {
    return person.gender === 'female';
  });

  const sumAges = users.reduce((accumulator, current) => {
    return accumulator + current.age;
  }, 0);

  const avgAges = Number(Math.round(sumAges/users.length+'e'+2)+'e-'+2);

  var stats = [`Sexo Masculino: ${male.length}`, `Sexo Feminino: ${female.length}`, `Soma Idades: ${sumAges}`, `Média Idades: ${avgAges}`];
  
    for(var i = 0; i < stats.length; i++) {
      var info = stats[i],
          li   = document.createElement('li');

      li.textContent = info;
      ul.appendChild(li);
    }
  }    
}

function clearInput() {
  inputText.value = '';
  inputText.focus();
  button.disabled = true;
}

// função displaying texto de apoio sobre busca

function renderTotal(users) {
  if(users.length === 0) {
    totalUser.innerHTML = 'Desculpe, nenhum usuário foi encontrado...';
    statsArea.innerHTML = 'Nada a ser exibido.'
  } else if(users.length === 1) {
    totalUser.innerHTML = `${users.length} usuário encontrado`;
    statsArea.innerHTML = 'Estatística'
  } else {
    totalUser.innerHTML = `${users.length} usuários encontrados`;
    statsArea.innerHTML = 'Estatísticas'
  }  
}

//função capitalize words
function ucUpper(str) {
  var splitStr = str.toLowerCase().split(' ');
  for (var i = 0; i < splitStr.length; i++) {
      splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);     
  }
  return splitStr.join(' '); 
}
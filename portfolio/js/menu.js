var burger = document.getElementById('burger');

function controlaMenu() {
    var menu = document.getElementById('menu');

    if (menu.classList.contains('mostraMenu')) {
        menu.classList.remove('mostraMenu');
    } else {
        menu.classList.add('mostraMenu');
    };
    

    //implementaçao usando JS
    // var menu     = document.getElementById('menu');
    // if (menu.style.display == 'block') {
    //     menu.style.display = 'none';
    // } else {
    //     menu.style.display = 'block';
    // };
    

};

burger.onclick = controlaMenu;


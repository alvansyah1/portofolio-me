/* LOADER */

window.onload = function(){

    const loader =
    document.getElementById('loader');

    loader.style.opacity = '0';

    setTimeout(()=>{

        loader.style.display = 'none';

    },500);
};

/* THEME */

const themeBtn =
document.getElementById('themeToggle');

themeBtn.onclick = () => {

    document.body.classList.toggle('light');

    localStorage.setItem(
        'theme',
        document.body.classList.contains('light')
        ? 'light'
        : 'dark'
    );
};

if(localStorage.getItem('theme') === 'light'){

    document.body.classList.add('light');
}

/* PARTICLE */

for(let i=0;i<40;i++){

    let p =
    document.createElement('div');

    p.classList.add('particle');

    p.style.left =
    Math.random()*100+'vw';

    p.style.animationDuration =
    (10 + Math.random()*10)+'s';

    p.style.opacity =
    Math.random();

    document.body.appendChild(p);
}

/* AOS */

AOS.init({
    duration:1000,
    once:true
});
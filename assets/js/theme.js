const body = document.body;

const themeBtn = document.getElementById('themeToggle');

themeBtn.onclick = () => {

    body.classList.toggle('light');

    localStorage.setItem(
        'theme',
        body.classList.contains('light')
        ? 'light'
        : 'dark'
    );
};

if(localStorage.getItem('theme') === 'light'){
    body.classList.add('light');
}
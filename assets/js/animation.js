const cards = document.querySelectorAll('.fade-up');

window.addEventListener('scroll', () => {

    cards.forEach(card => {

        const top = card.getBoundingClientRect().top;

        if(top < window.innerHeight - 100){

            card.classList.add('show');

        }

    });

});
const burger = document.querySelector('#burger');
const close = document.querySelector('#close');
const menu = document.querySelector('#menu');

burger.addEventListener('click', () => {
    burger.classList.add('hidden');
    close.classList.remove('hidden');
    menu.classList.remove('slide-exit');
    menu.classList.add('slide-enter');
    menu.style.display = 'block'; 
});

close.addEventListener('click', () => {
    burger.classList.remove('hidden');
    close.classList.add('hidden');
    menu.classList.remove('slide-enter');
    menu.classList.add('slide-exit');
    
    setTimeout(() => {
        menu.style.display = 'none';
    }, 500); 
});

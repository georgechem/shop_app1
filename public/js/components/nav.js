// Get from DOM Two elements which represents TWO icons
let navBook = document.getElementById('navBook');
let navUser = document.getElementById('navUser');
// Get from DOM user navigation
/**
 * panelUser Id represents two elements with the same Id
 * however logic in template allow to display only one at a time
 * so always dealing with one object
 * @type {HTMLElement}
 */
let panelUser = document.getElementById('panelUser');
// Get from DOM book navigation
let panelBooks = document.getElementById('panelBooks');


/**
 * User action
 */
navUser.addEventListener('click', function(){
    panelUser.classList.toggle('hidden');
    gsap.from(panelUser, {duration: 1, opacity: 0});
    // add hidden class to all others menus
    panelBooks.classList.add('hidden');

});

navBook.addEventListener('click', function(){
    panelBooks.classList.toggle('hidden');
    gsap.from(panelBooks, {duration: 1, opacity: 0});
    // add hidden class to all others menus
    panelUser.classList.add('hidden');
});


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
// Get from DOM user navigation, DOM BUTTON USER
    let panelUser = document.getElementById('panelUser');
// Get from DOM book navigation, DOM BUTTON BOOK
    let panelBooks = document.getElementById('panelBooks');


    /**
     * User action USER BUTTON, DOM BUTTON USER -- ACTION CLICK
     */
    navUser.addEventListener('click', function(){
        if(panelUser.classList.contains('hidden')){
            panelUser.classList.remove('hidden');
        }else{
            panelUser.classList.add('hidden');
            panelUser.style.opacity = 1;
        }
        gsap.from(panelUser, {duration: 1, opacity: 0});
        // add hidden class to all others menus
        panelBooks.classList.add('hidden');

    });
    /**
     * User action BOOK BUTTON, DOM BUTTON BOOK -- ACTION CLICK
     */
    navBook.addEventListener('click', function(){
        if(panelBooks.classList.contains('hidden')){
            panelBooks.classList.remove('hidden');
        }else{
            panelBooks.classList.add('hidden');
            panelBooks.style.opacity = 1;
        }
        gsap.from(panelBooks, {duration: 1, opacity: 0});
        // add hidden class to all others menus
        panelUser.classList.add('hidden');
    });




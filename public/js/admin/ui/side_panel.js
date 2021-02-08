let sidePanel = document.getElementById('side_panel');
let buttonClose = document.getElementById('button_close')
let buttonOpen = document.getElementById('button_open');

buttonClose.addEventListener('click', function(){
    sidePanel.classList.add('left');
    buttonOpen.classList.remove('left');
});
buttonOpen.addEventListener('click', function(){
    sidePanel.classList.remove('left');
    buttonOpen.classList.add('left');
});

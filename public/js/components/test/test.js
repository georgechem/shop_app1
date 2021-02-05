console.log('ok');
let input = document.getElementById('text_area');
let submit = document.getElementById('submit')

let message_block = document.getElementById('sent');

submit.addEventListener('click', function(e){
    e.preventDefault();
    let element = document.createElement('div');
    element.classList.add('sent__message');
    element.innerText = input.value+' ! ';
    message_block.appendChild(element);
    input.value = '';
});

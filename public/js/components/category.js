
let plusButton = document.querySelectorAll('.img_width--left');

plusButton.forEach((item)=>{
   item.addEventListener('click', function(e){
      e.preventDefault();
      let message = document.getElementById(`message${item.id}`);
      removeClasses(message);
      message.classList.add('message');
      message.classList.add('mes1');
      message.innerText = item.getAttribute('data');
      setTimeout(function(){
         removeClasses(message);
         message.classList.add('hidden');
      }, 2000);

   });
});

let infoButton = document.querySelectorAll('.img_width--right');

infoButton.forEach((item)=>{
   item.addEventListener('click',function(e){
      e.preventDefault();
      let message = document.getElementById(`message${item.name}`);
      message.classList.toggle('hidden');
      message.classList.add('mes2');
      message.innerText = item.getAttribute('data');

   });
});
let removeClasses = function(item){
   item.classList = [];
   item.classList.add('message');
}

let loader = document.getElementById('loader_slider');

//let dot = document.createElement('div');
//dot.classList.add('loader__slider__block');


//loader.appendChild(dot);
let counter = 0;
let x = 0;
let pageLoader = setInterval(function(){
    let dot = document.createElement('div');
    dot.classList.add('loader__slider__block');
    dot.style.width = `25px`;
    dot.style.height = `25px`;
    dot.style.margin = `4px`;
    let dimensions = parseInt(dot.style.width.slice(0,2));
    let margin = parseInt(dot.style.width.slice(0,1));
    let repeat = Math.floor(window.innerWidth/(25+8));
    console.log(dot.style.left);
    let x = counter * 30;
    dot.style.left = `${x}px`;
    //console.log(dimensions);
    if(counter*repeat > window.innerWidth){
        clearInterval(pageLoader);
    }
    loader.appendChild(dot);
    counter++;

    //console.log(window.innerWidth);
}, 100);

pageLoader;

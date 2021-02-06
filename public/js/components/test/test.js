let container = document.getElementById('div');



let dot = document.createElement('div');
dot.classList.add('dot');



container.appendChild(dot);

/**
 * center for DOT inside box
 * @type {string}
 * dot.style.top = '62.5px';
 dot.style.left = '62.5px';
 */
function moveRight(){
    let x = 0;
    let y = 0;
    let offset = 62.5;
    let factor_y = 1;
    let factor_x = 1;
    let width = container.offsetWidth - dot.offsetWidth;
    console.log(width);
    let animate = setInterval(function(){
        if(x >= width || x < 0){
            factor_x = - factor_x;
            //clearInterval(animate);
        }
        dot.style.left = `${x}px`;
        dot.style.top = `${y+offset}px`;
        x += 1 * factor_x;
        y += 1 * factor_y;
        if (y <= 0 || y > offset){
            factor_y *= -1;
        }


    }, 1);
}
moveRight();

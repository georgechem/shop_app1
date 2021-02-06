let container = document.getElementById('div');



let dot = document.createElement('div');
dot.classList.add('dot');
let dot1 = document.createElement('div');
dot1.classList.add('dot');


container.appendChild(dot);
container.appendChild(dot1);

/**
 * center for DOT inside box
 * @type {string}
 * dot.style.top = '62.5px';
 dot.style.left = '62.5px';
 */
function moveRight(item, x1, y1, opacity){
    console.log(dot);
    let x = x1;
    let y = y1;
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
        item.style.left = `${x}px`;
        item.style.top = `${y+offset}px`;
        item.style.opacity = opacity;
        x += 4 * factor_x;
        y += 4 * factor_y;
        if (y <= 0 || y > offset){
            factor_y *= -1;
        }


    }, 50);
}
moveRight(dot, 0, 0, 1);
moveRight(dot1, 20, 20, 0.5);


let container = document.getElementById('div');


let balls = []
let dot = document.createElement('div');
dot.classList.add('dot');
let dot1 = document.createElement('div');
dot1.classList.add('dot');


container.appendChild(dot);
container.appendChild(dot1);

for(i = 1; i < 330; i++){
    let ball = document.createElement('div');
    ball.classList.add('dot');
    balls.push(ball);


}
balls.forEach(function(val){
    container.appendChild(val);
    moveRight(val,Math.random()*300, Math.random()*300, Math.max(0.3, Math.random()));
});

/**
 * center for DOT inside box
 * @type {string}
 * dot.style.top = '62.5px';
 dot.style.left = '62.5px';
 */
function moveRight(item, x1, y1, opacity){
    //console.log(dot);
    let x = x1;
    let y = y1;
    let offset = 300;
    let factor_y = 1;
    let factor_x = 1;
    let width = container.offsetWidth - item.offsetWidth;
    //console.log(width);
    let animate = setInterval(function(){
        if(x >= width || x < 0){
            factor_x = - factor_x;
            //clearInterval(animate);
        }
        item.style.left = `${x}px`;
        item.style.top = `${y+offset}px`;
        item.style.opacity = opacity;
        x += 4*(Math.random()) * factor_x;
        y += 4*(Math.random()) * factor_y;
        if (y <= 0 || y > offset){
            factor_y *= -1;
        }


    }, 10);
}
moveRight(dot, 20, 20, 0.8);
moveRight(dot1, 40, 40, 1);


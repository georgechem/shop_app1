let container = document.getElementById('div1');


let balls = []


for(i = 1; i < 50; i++){
    let ball = document.createElement('div');
    ball.classList.add('dot');
    balls.push(ball);


}
balls.forEach(function(val){
    container.appendChild(val);
    moveRight(val,Math.random()*300, Math.random()*100, Math.max(0.3, Math.random()), Math.random());
});

/**
 * center for DOT inside box
 * @type {string}
 * dot.style.top = '62.5px';
 dot.style.left = '62.5px';
 */
function moveRight(item, x1, y1, opacity, scale){
    //console.log(dot);
    let r = 0;
    let g = 0;
    let b = 0;
    let r1 = 0;
    let g1 = 0;
    let b1 = 0;
    let x = x1;
    let y = y1;
    let offset = 200;
    let factor_y = 1;
    let factor_x = 1;
    let width = (container.offsetWidth - item.offsetWidth-35);
    //console.log(width);
    let animate = setInterval(function(){
        if(x >= width || x < 0){
            factor_x = - factor_x;
            //clearInterval(animate);
        }
        item.style.left = `${x}px`;
        item.style.top = `${y+offset}px`;
        item.style.opacity = opacity;
        item.style.transform = `scale(${scale})`;
        r1 = Math.max(Math.random()*255, 200);
        g1 = Math.max(Math.random()*255, 200);
        b1 = Math.max(Math.random()*255, 250);
        r = Math.min(r1, 0);
        g = Math.min(g1, 0);
        b = Math.min(b1, 50);
        item.style.backgroundColor = `rgb(${r}, ${g}, ${b})`;
        x += 4*(Math.random()) * factor_x;
        y += 4*(Math.random()) * factor_y;
        if (y <= 0 || y > offset){
            factor_y *= -1;
        }


    }, 10);
}



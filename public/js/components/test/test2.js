let banner = document.getElementById('banner');
let img = document.getElementById('img1');

function animateImageRight(img, x)
{

    let animateRandomImageRight = setInterval(function(){

        img.style.right = `${x}px`;
        if (x < 0 - img.width) {
            clearInterval(animateRandomImageRight);
        }
        x -= 10;
    }, 5);
}


function animateImageCenter(img){
    let x = 0;
    let animateRandomImage = setInterval(function(){

        if(x > Math.min((window.innerWidth/2+(img.width/2)), 1200)){
            setTimeout(animateImageRight, 2500, img, window.innerWidth - x)
            clearInterval(animateRandomImage);
        }
        x += 10;
        img.style.right = `${window.innerWidth - x}px`;
    }, 5);
}

function getRandomBook(){
    fetch('https://localhost:8000/getRandomBook')
        .then(response => response.json())
        .then((data) => {
            img.src = `books/${data.book_id}.png`;
            animateImageCenter(img);
        })
        .catch(e => console.log('API ERROR'))
}
getRandomBook();
setInterval(getRandomBook, 4500);


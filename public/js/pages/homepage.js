// API Query
let counter = 1;
let start = 1;
let width = window.innerWidth;
let total = 1;
if(width > 500 && width <= 700){
    total = 2;
}
else if(width > 700 && width <= 870){
    total = 3;
}
else if(width > 870 && width <= 1100){
    total = 4;
}else if(width > 1100){
    total = 5;
}
console.log(width);
let oldChildren = [];


// DOM elements
let latestContent = document.getElementById('latestContent');
// controls
let latestLeft = document.getElementById('latestLeft');
let latestRight = document.getElementById('latestRight');
/**
 * when on production should be
 * https://www.serverapp.eu/public/index.php/googleBooks/...
  */
let getBooks = function(start, total){
    fetch(`https://localhost:8000/googleBooks/${start}/${total}/subject=web+intitle=php`)
        .then((response)=>{
            return response.json();
        })
        .then((data)=>{
            if(oldChildren.length === data.length){
                oldChildren.forEach((child)=>{
                    latestContent.removeChild(child);
                })
                oldChildren = [];
            }
            data.forEach((item)=>{
                // generate main content element <div>
                let mainContent = document.createElement('div');
                mainContent.classList.add('latest__content__main');
                // generate <img> element & fill with content from API
                let imgObject = document.createElement('img');
                imgObject.classList.add('latest__content__img');
                imgObject.src = item.volumeInfo.imageLinks.thumbnail;
                // generate <p> element & fill with content from API
                let titleObject = document.createElement('p');
                titleObject.classList.add('latest__content__title');
                titleObject.innerText = item.volumeInfo.title;
                // append created nodes to parent present in html template
                // append <img>
                mainContent.appendChild(imgObject);
                // append <p>
                mainContent.appendChild(titleObject);

                // add all content to main node
                latestContent.appendChild(mainContent);
                oldChildren.push(mainContent);

                //console.log(item);
            })
            //latestContentImg[0].src = data[0].volumeInfo.imageLinks.thumbnail;
        });
}
getBooks(start, total);
latestRight.addEventListener('click', function(){
        counter = start + total;
        start = counter;
        getBooks(start, total);
});

latestLeft.addEventListener('click', function(){
    counter = start - total;
    start = counter;
    if(start < 1){
        start = 1;
    }
    getBooks( start, total);
});

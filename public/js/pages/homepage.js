// API Query
let counter = 0;
let start = 0;
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
let oldChildren = [];
let totalItems = 0;


// DOM elements
let latestContent = document.getElementById('latestContent');
// controls
let latestLeft = document.getElementById('latestLeft');
let latestRight = document.getElementById('latestRight');
/**
 * when on production should be
 * https://www.serverapp.eu/public/index.php/googleBooks/...
 *
 * tmp API:
  */`https://localhost:8000/googleBooks/${start}/${total}/subject=web+intitle=php`
let getBooks = function(start, total){
    fetch(`https://localhost:8000/myBooks/${start}/${total}/test`)
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
            totalItems = data[0].count;
            data.forEach((item)=>{
                // generate main content element <div>
                let mainContent = document.createElement('div');
                mainContent.classList.add('latest__content__main');
                // generate <img> element & fill with content from API
                let imgObject = document.createElement('img');
                imgObject.classList.add('latest__content__img');
                imgObject.src = item.imageLink;
                //imgObject.src = item.volumeInfo.imageLinks.thumbnail;
                // generate <p> element & fill with content from API
                let titleObject = document.createElement('p');
                titleObject.classList.add('latest__content__title');
                titleObject.innerText = item.title.slice(0,15);
                //titleObject.innerText = item.volumeInfo.title;
                // append created nodes to parent present in html template
                // append <img>
                mainContent.appendChild(imgObject);
                // append <p>
                mainContent.appendChild(titleObject);

                // add all content to main node
                latestContent.appendChild(mainContent);
                oldChildren.push(mainContent);

            })

        });
}
getBooks(start, total);
latestRight.addEventListener('click', function(){

    if ((start + total) < (totalItems - total)){
        counter = start + total;
    }
    start = counter;
    console.log(start, total, totalItems);
    getBooks(start, total);
});

latestLeft.addEventListener('click', function(){
    counter = start - total;
    start = counter;
    if(start < 0){
        start = 0;
        counter = start;
    }
    console.log(start, total, totalItems);
    getBooks( start, total);
});

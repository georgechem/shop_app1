// API Query
let counter = 1;
let start = 1;
let total = 5;
let status = true;
let oldChildren = [];

let booksApi = `https://localhost:8000/googleBooks/${start}/${total}/php`;
// DOM elements
let latestContent = document.getElementById('latestContent');
// controls
let latestLeft = document.getElementById('latestLeft');
let latestRight = document.getElementById('latestRight');

let getBooks = function(start, total, status){
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
                mainContent.style.position = 'relative';
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

                //console.log(imgObject);
            })
            //latestContentImg[0].src = data[0].volumeInfo.imageLinks.thumbnail;
        });
}
getBooks(start, total, status);
latestRight.addEventListener('click', function(){
        counter = start + total;
        start = counter;
        getBooks(start, total, status);
});


let a;
// API Query
/**
 * Set initial values responsible for pagination
 * @type {number}
 */
let counter = 0;
let start = 0;
let width = window.innerWidth;
let total = 1;
let disable_controls = false;
/**
 * Check width to optimize amount of book loaded
 */
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
/**
 * variable which will holds old children from DOM
 * allow secure removal
 * @type {*[]}
 */
let oldChildren = [];
/**
 * represents all items available after query
 * @type {number}
 */
let totalItems = 0;


// DOM elements
let latestContent = document.getElementById('latestContent');
// controls
let latestLeft = document.getElementById('latestLeft');
let latestRight = document.getElementById('latestRight');
/**
 * when on production should be for title
 * https://www.serverapp.eu/public/index.php/myBooks/${start}/${total}/php...
 *
  */
let getBooks = function(start, total){
    fetch(`https://localhost:8000/myBooks/${start}/${total}/python`)
        .then((response)=>{
            return response.json();
        })
        .then((data)=>{

            totalItems = data[0].count;
            data.forEach((item)=>{
                // generate main content element <div>
                let mainContent = document.createElement('div');
                mainContent.classList.add('latest__content__main');
                // generate <img> element & fill with content from API
                let imgObject = document.createElement('img');
                imgObject.classList.add('latest__content__img');
                imgObject.src = item.imageLink;
                // generate <p> element & fill with content from API
                let titleObject = document.createElement('p');
                titleObject.classList.add('latest__content__title');
                titleObject.innerText = item.title.slice(0,15);
                // append created nodes to parent present in html template
                // append <img>
                mainContent.appendChild(imgObject);
                // append <p>
                mainContent.appendChild(titleObject);
                /**
                 * remove old children just before appending new on that
                 * guarantees the best User Experience, as pictures replaced
                 * instantly
                 */
                if(oldChildren.length === data.length){
                    oldChildren.forEach((child)=>{
                        latestContent.removeChild(child);
                    })
                    oldChildren = [];
                }
                // add all content to main node
                latestContent.appendChild(mainContent);

                oldChildren.push(mainContent);
            })


        })
        .catch((e)=>{
            let mainContent = document.createElement('div');
            mainContent.classList.add('latest__content__main');
            let titleObject = document.createElement('p');
            titleObject.classList.add('latest__content__title');
            titleObject.innerHTML ='Image(s) could not be loaded<p></p><cite>Apology</cite></p>';
            // append <p>
            mainContent.appendChild(titleObject);
            // add all content to main node
            latestContent.appendChild(mainContent);
            //disable latest navigation - it will be automatically enabled
            //when page refresh and API responds correctly
            disable_controls = true;

        });
}
getBooks(start, total);
latestRight.addEventListener('click', function(){
    if(disable_controls === true){
        return;
    }
    if ((start + total) < (totalItems - total)){
        counter = start + total;
    }
    start = counter;
    //console.log(start, total, totalItems);
    getBooks(start, total);
});

latestLeft.addEventListener('click', function(){
    if(disable_controls === true){
        return;
    }
    counter = start - total;
    start = counter;
    if(start < 0){
        start = 0;
        counter = start;
    }
    //console.log(start, total, totalItems);
    getBooks( start, total);
});

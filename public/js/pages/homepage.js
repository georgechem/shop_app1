// API Query
let booksApi = `https://localhost:8000/googleBooks/1/5/subject=web+intitle=php`;
// DOM elements
let latestContent = document.getElementById('latestContent');
let latestContentImg = document.querySelectorAll('.latest__content__img');

function getBooks(){
    fetch(booksApi)
        .then((response)=>{
            return response.json();
        })
        .then((data)=>{
            //console.log(data[0].volumeInfo.imageLinks);

            data.forEach((item, key)=>{
                let imgObject = document.createElement('img');
                imgObject.classList.add('latest__content__img');
                imgObject.src = item.volumeInfo.imageLinks.thumbnail;
                latestContent.appendChild(imgObject);
                //console.log(item, key);
            })
            //latestContentImg[0].src = data[0].volumeInfo.imageLinks.thumbnail;
        });
}
getBooks();



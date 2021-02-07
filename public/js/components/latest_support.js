let click = new Event('click');
let previous = 0;
let acc = [start, total, counter];


function moveLatestRight(){
    let moveLatestRightInterval = setInterval(function(){
        previous = start;
        latestRight.dispatchEvent(click);
        if (previous === start){
            clearInterval(moveLatestRightInterval);
            start = acc[0];
            total = acc[1];
            counter = acc[2];
            setTimeout(runLatest, 1500);
        }

    }, 4000);
}


function runLatest(){
    setTimeout(moveLatestRight, 1000);
}
runLatest();


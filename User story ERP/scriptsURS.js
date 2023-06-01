// scripts for the buttons and the timer

let timerId;
let timer = 0;
let start = document.querySelector('#start');
let stop = document.querySelector('#stop');
let reset = document.querySelector('#reset');
document.getElementById("demo").innerHTML = timer  ;

function time() {
    console.log(++timer)
    document.getElementById("demo").innerHTML = timer  ;
};

// start button
const startBtn = document.querySelector ("#start");
startBtn.addEventListener("click", function(event) {
    myInterval = setInterval(time, 1000);
    console.log("start button press")
});

//stop button
const stopBtn = document.querySelector ("#stop");
stopBtn.addEventListener("click", function(event) {
    clearInterval(myInterval)
    console.log("test 2")
});
const resetBtn = document.querySelector ("#reset")
resetBtn.addEventListener("click", function(event){
    timer = 0
    console.log(timer)
    document.getElementById("demo").innerHTML = timer  ;
});


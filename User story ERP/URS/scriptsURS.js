// scripts for the buttons and the timer

let timerId;
let timer = 0;
let start = document.querySelector('#start');
let stop = document.querySelector('#stop');
let reset = document.querySelector('#reset');
document.getElementById("demo").innerHTML = timer;

function time() {
    console.log(++timer)
    document.getElementById("demo").innerHTML = timer;
};
function check() {
    if ( truefalse === 'true') {
        myInterval = setInterval(time, 1000)
    }
    else {
    clearInterval(myInterval)
}};

function stopfunction() {
    clearInterval(myInterval)
    console.log("test 2")
    document.getElementById("start").style.display = "unset";
    document.getElementById("stopbtn").style.display = "none";
};
// start button
// bug with timer cuz you can spam click the button
const startBtn = document.querySelector("#start");
startBtn.addEventListener("click", function (event) {
    myInterval = setInterval(time, 1000);
    console.log("start button press")
    document.getElementById("start").style.display = "none";
    document.getElementById("stopbtn").style.display = "unset";
});

//stop button
const stopBtn = document.querySelector("#stopbtn");
stopBtn.addEventListener("click", function (event) {
    stopfunction()
});
const resetBtn = document.querySelector("#reset")
resetBtn.addEventListener("click", function (event) {
    timer = 0
    console.log(timer)
    document.getElementById("demo").innerHTML = timer;
    stopfunction()
});


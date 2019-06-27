var cursorState = false;
var modalState = false;
var killModal;
var canvas = document.getElementById("canvas");
var ctx = canvas.getContext("2d");
var trails = [];
var dead = [];
var canvasWidth = window.innerWidth;
function init() {
  window.requestAnimationFrame(draw);
}
function scale() {
  var scale = window.innerWidth / canvasWidth;
  var len = trails.length;
  for (var i = 0; i < len; i++) {
    trails[i].position = Math.round(trails[i].position * scale);
  }
  canvasWidth = window.innerWidth;
}
function draw() {
  canvas.height = window.innerHeight;
  canvas.width = window.innerWidth;
  if (canvasWidth !== window.innerWidth) {
    scale();
  }
  if (trails[0]) {
    let len = trails.length;
    for (var i = 0; i < len; i++) {
      if (trails[i].age < 0) {
        dead.push(i);
      }
    }
    for (var i = dead.length - 1; i >= 0; i--)
      trails.splice(dead[i], 1);
    dead = [];
  }
  var newPixel = {};
  let trailLength = 60;
  newPixel.age = window.innerHeight + trailLength;
  newPixel.position = Math.floor((Math.random() * window.innerWidth) + 1);
  newPixel.velocity = Math.floor((Math.random() * 5) + 2);
  trails.push(newPixel);
  let leng = trails.length;
  for (var i = 0; i < leng; i++) {
    ctx.fillStyle = "#FFF";
    ctx.fillRect(trails[i].position, window.innerHeight - trails[i].age + trailLength, 1, 1);
    var gradient = ctx.createLinearGradient(trails[i].position, window.innerHeight - trails[i].age + trailLength, trails[i].position, window.innerHeight - trails[i].age);
    gradient.addColorStop(0, "#00a0a0");
    gradient.addColorStop(1, "#000");
    ctx.fillStyle = gradient;
    ctx.fillRect(trails[i].position, window.innerHeight - trails[i].age, 1, trailLength);
    trails[i].age -= trails[i].velocity;
  }
  window.requestAnimationFrame(draw);
}
function blink() {
  if (cursorState === true) {
    document.getElementById("cursor").style.visibility = "hidden";
    cursorState = false;
    var link = document.querySelector("link[rel*='icon']") || document.createElement("link");
    link.rel = "icon";
    link.href = "favicoff.ico";
    document.getElementsByTagName("head")[0].appendChild(link);
  } else {
    document.getElementById("cursor").style.visibility = "visible";
    cursorState = true;
    var link = document.querySelector("link[rel*='icon']") || document.createElement("link");
    link.rel = "icon";
    link.href = "favicon.ico";
    document.getElementsByTagName("head")[0].appendChild(link);
  }
}
function modalToggle() {
  if (modalState === false) {
    clearTimeout(killModal);
    document.getElementById("body").style.opacity = 0.2;
    document.getElementById("modal").style.visibility = "visible";
    document.getElementById("catch").style.visibility = "visible";
    document.getElementById("modal").style.opacity = 1;
    modalState = true;
  } else {
    document.getElementById("body").style.opacity = 1;
    killModal = setTimeout(function(){document.getElementById("modal").style.visibility = "hidden"},3000);
    document.getElementById("catch").style.visibility = "hidden";
    document.getElementById("modal").style.opacity = 0;
    modalState = false;
  }
}
function catchModal() {
  document.getElementById("body").style.opacity = 1;
  killModal = setTimeout(function(){document.getElementById("modal").style.visibility = "hidden"},3000);
  document.getElementById("catch").style.visibility = "hidden";
  document.getElementById("modal").style.opacity = 0;
  modalState = false;
}
document.onkeydown = function(evt) {
    evt = evt || window.event;
    var isEscape = false;
    if ("key" in evt) {
        isEscape = (evt.key == "Escape" || evt.key == "Esc");
    }
    if (isEscape) {
        catchModal();
    }
}
setTimeout(function(){document.getElementById("wish").innerHTML="<span class='halfStyle' data-content='w'>w</span>_"},180);
setTimeout(function(){document.getElementById("wish").innerHTML="<span class='halfStyle' data-content='w'>w</span><span class='halfStyle' data-content='i'>i</span>_"},360);
setTimeout(function(){document.getElementById("wish").innerHTML="<span class='halfStyle' data-content='w'>w</span><span class='halfStyle' data-content='i'>i</span><span class='halfStyle' data-content='s'>s</span>_"},540);
setTimeout(function(){document.getElementById("wish").innerHTML="<span class='halfStyle' data-content='w'>w</span><span class='halfStyle' data-content='i'>i</span><span class='halfStyle' data-content='s'>s</span><span class='halfStyle' data-content='h'>h</span><span id='cursor'>_</span>";setInterval(blink,500);},720);
function play() {
  audio = document.getElementById("player");
  audio.volume = 0.1;
  audio.loop = true;
  audio.play();
}
setTimeout(play, 0);
init();
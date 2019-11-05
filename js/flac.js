var modalState = false;
var killModal;
function redraw() {
  draw(0, "#690099");
}
function store(name, value) {
  sessionStorage.setItem(name, value);
}
function retrieve(name) {
  return sessionStorage.getItem(name);
}
function createSession() {
  store("played", 0.0);
  store("volume", 0.1);
  store("track", JSON.stringify([]));
  store("playlist", JSON.stringify([]));
  store("index", 0);
  store("state", false);
}
const audio = document.getElementById("player");
function addFolder() {
  var tracks = document.querySelectorAll("#song");
  for (var i = 0; i < tracks.length; i++) {
    document.querySelectorAll("#song")[i].onclick();
  }
}
function updatePlaylist(url) {
  let playlist = JSON.parse(retrieve("playlist"));
  let art = "";
  if (document.getElementById("data")) {
    art = document.getElementById("data").value;
  }
  let item = [url, art];
  playlist.push(item);
  store("playlist", JSON.stringify(playlist));
  if (playlist.length == 1) {
    play(0);
    document.getElementById("reset").hidden = false;
  }
}
function removeIndex(index) {
  let playlist = JSON.parse(retrieve("playlist"));
  playlist.splice(index, 1);
  store("playlist", JSON.stringify(playlist));
  populateModal();
}
function updateArt() {
  let art = JSON.parse(retrieve("track"))[1];
  if (art != "") {
    document.getElementById("cover").src = art;
    document.getElementById("cover").hidden = false;
  } else {
    document.getElementById("cover").src = "data:null";
    document.getElementById("cover").hidden = true;
  }
}
function play(index) {
  let data = JSON.parse(retrieve("playlist"))[index];
  document.getElementById("track").innerHTML = decodeURI(data[0].split("/").pop().split(".").slice(0,-1).join("."));
  audio.src = decodeURI(data[0]);
  audio.play();
  let track = [data[0], data[1]];
  store("track", JSON.stringify(track));
  store("index", index);
  updateArt(index);
}
function reset() {
  createSession();
  location.reload(true);
}
function populateModal() {
  let playlist = JSON.parse(retrieve("playlist"));
  let modal = document.getElementById("contents");
  while (modal.firstChild) {
    modal.removeChild(modal.firstChild);
  }
  for (var i = 0; i < playlist.length; i++) {
    let deleter = document.createElement("a");
    deleter.classList = "delete";
    deleter.innerHTML = "X";
    deleter.setAttribute("onclick", "removeIndex(" + i + ")");
    modal.appendChild(deleter);
    let item = document.createElement("a");
    item.innerHTML = decodeURI(playlist[i][0].split("/").pop().split(".").slice(0,-1).join("."));
    item.setAttribute("onclick", "play(" + i + ")");
    modal.appendChild(item);
    modal.appendChild(document.createElement("br"));
  }
}
window.addEventListener("unload", function() {
  store("progress", audio.currentTime);
  store("trails", JSON.stringify(trails));
});
document.getElementsByClassName("visual")[0].addEventListener("mouseover", function() {
  document.getElementsByClassName("next")[0].hidden = false;
});
document.getElementsByClassName("visual")[0].addEventListener("mouseout", function() {
  document.getElementsByClassName("next")[0].hidden = true;
});
audio.onvolumechange = function() {
  store("volume", audio.volume);
};
audio.onplay = function() {
  store("state", true);
};
audio.onpause = function() {
  store("state", false);
}
audio.addEventListener("ended", function() {
  let playlist = JSON.parse(retrieve("playlist"));
  let index = JSON.parse(retrieve("index"));
  if (!playlist.length < 1) {
    if (!playlist[index + 1]) {
      play(0);
    } else {
      play(index + 1);
    }
  } else {
    document.getElementById("track").innerHTML = "N/A";
    document.getElementById("cover").src = "data:null";
    document.getElementById("cover").hidden = true;
  }
});
function init() {
  var trailsExist = retrieve("trails");
  if (!trailsExist) {
    createSession();
  } else {
    trails = JSON.parse(trailsExist);
    audio.volume = retrieve("volume");
    let track = JSON.parse(retrieve("track"));
    if (!track.length < 1) {
      audio.src = decodeURI(track[0]);
      audio.currentTime = retrieve("progress");
      if (JSON.parse(retrieve("state"))) {
        audio.play();
      }
      document.getElementById("track").innerHTML = decodeURI(track[0].split("/").pop().split(".").slice(0,-1).join("."));
      document.getElementById("reset").hidden = false;
      document.getElementById("playlist").hidden = false;
      updateArt();
    }
  }
  window.requestAnimationFrame(redraw);
}
function modalToggle() {
  populateModal();
  if (modalState === false) {
    clearTimeout(killModal);
    document.getElementById("body").style.opacity = 0.2;
    document.getElementById("modal").style.visibility = "visible";
    document.getElementById("catch").style.visibility = "visible";
    document.getElementById("modal").style.opacity = 1;
    modalState = true;
  } else {
    document.getElementById("body").style.opacity = 1;
    killModal = setTimeout(function(){document.getElementById("modal").style.visibility = "hidden"}, 1000);
    document.getElementById("catch").style.visibility = "hidden";
    document.getElementById("modal").style.opacity = 0;
    modalState = false;
  }
}
function catchModal() {
  document.getElementById("body").style.opacity = 1;
  killModal = setTimeout(function(){document.getElementById("modal").style.visibility = "hidden"}, 1000);
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
init();

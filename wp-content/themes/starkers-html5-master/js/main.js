function toggleMute() {
  var video = document.getElementById('bgvid');
  var muteBtn = document.getElementById('mute');

  if (video.muted === false) {
    video.muted = true;
    muteBtn.src = "/outdoors/wp-content/uploads/mute.png";
    unfade(document.getElementById('home-text'));
    unfade(document.getElementById('about-mtn'));
    muteBtn.style.webkitAnimationPlayState = "running";
  } else {
    video.muted = false;
    muteBtn.src = "/outdoors/wp-content/uploads/speaker.png";
    fade(document.getElementById('home-text'));
    fade(document.getElementById('about-mtn'));
    muteBtn.style.webkitAnimationPlayState = "paused";
  }
}

function fade(element) {
  var op = 1;  // initial opacity
  var timer = setInterval(function () {
      if (op <= 0.1){
          clearInterval(timer);
          element.style.visibility = 'hidden';
      }
      element.style.opacity = op;
      element.style.filter = 'alpha(opacity=' + op * 100 + ")";
      op -= op * 0.1;
  }, 10);
}

function unfade(element) {
  var op = 0.1;  // initial opacity
  element.style.visibility = 'visible';
  var timer = setInterval(function () {
      if (op >= 1){
          clearInterval(timer);
      }
      element.style.opacity = op;
      element.style.filter = 'alpha(opacity=' + op * 100 + ")";
      op += op * 0.1;
  }, 10);
}

function loopMainVideo() {
  document.getElementById('bgvid').play();
  if (document.getElementById('bgvid').muted === false) {
    toggleMute();
  }
}

function showActivityDesc(event) {
  var stringId = event.target.id;
  var activityId = stringId[stringId.length-1];

  var html = document.getElementById("activity-text-" + activityId).innerHTML;
  var descElement;

  if (activityId == 1 || activityId == 2 || activityId == 3) {
    descElement = document.getElementById("activity-desc-" + 1);
    console.log("first desc");

  } else if (activityId == 4 || activityId == 5 || activityId == 6) {
    descElement = document.getElementById("activity-desc-" + 2);

  } else {
    descElement = document.getElementById("activity-desc-" + 3);
  }

  if (descElement.innerHTML != html) {
    descElement.innerHTML = html;
    descElement.style.display = 'block';
  } else {
    descElement.innerHTML = '';
    descElement.style.display = 'none';
  }
}

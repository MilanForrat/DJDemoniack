var video1 = document.getElementById("header_video_1");   
var video2 = document.getElementById("header_video_2");   
var video3 = document.getElementById("header_video_3");    
var audio = document.getElementById("audioMix");
var screenSize430 = window.matchMedia("(max-width: 430px)")
var screenSize1000 = window.matchMedia("(max-width: 1000px)")
var playButton = document.getElementById('audioControl')


// Pause and play the video, and change the button text
function videoController() {
  if (video1.paused) {
        video1.play();
        video1.style.display = "block";
        playButton.innerHTML = "Quitter l'expérience !";
        if (screenSize430.matches){ // If media query matches
            video2.play();
            video2.style.display = "block";
            video3.play();
            video3.style.display = "block";
        }
        if (screenSize1000.matches){ // If media query matches
            video3.play();
            video3.style.display = "block";  
        }
  } else {
        video1.pause();
        video1.style.display = "none";
        video2.pause();
        video2.style.display = "none";
        video3.pause();
        video3.style.display = "none";
        playButton.innerHTML = "Entrez dans l'expérience !";
  }
}

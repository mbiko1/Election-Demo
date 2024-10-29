const texts = [
    "Make a Difference! Every vote counts in shaping Malawi's tomorrow. Participate in this election and secure the future you want to see.",
    "Your Voice, Your Power! Voting online is quick, easy, and secure. Be part of Malawi’s democratic journey—make your voice heard today.",
    "Empower Change! Your vote is your opportunity to influence the leadership and policies that impact you. Vote securely online and be part of the change.",
    "Shape the Nation! Stand up for what you believe in by casting your vote. Every choice matters in building a stronger, better Malawi.",
    "One Nation, One Future! Voting is not just a right, but a responsibility. Secure your future by casting your vote online—your decision matters."
];

let currentIndex = 0;
const slideshowText = document.getElementById('textTrans');

// Function to change the text
function changeText() {
    // Fade out the current text
    slideshowText.style.opacity = 0;
    
    setTimeout(() => {
        // Change the text after the fade-out effect
        slideshowText.innerHTML = `<i id="ArrowIcon" class="fas fa-caret-right"></i> ${texts[currentIndex]}`;
        
        // Fade back in
        slideshowText.style.opacity = 1;
        // Update the index for the next text
        currentIndex = (currentIndex + 1) % texts.length;
    }, 1000); // Time to match the CSS transition duration
}

// Set the interval for changing text (every 4 seconds)
setInterval(changeText, 4000);

let countDownDate = new Date("Sep 16, 2025 00:00:00").getTime(); 
   let count = setInterval(function(){
    let now = new Date().getTime();
    let range = countDownDate - now;

    let days = Math.floor(range / (1000*60*60*24));
    let hours = Math.floor((range % (1000*60*60*24))/(1000*60*60));
    let minutes = Math.floor((range % (1000*60*60))/(1000*60));
    let Seconds = Math.floor((range % (1000*60))/1000);

   document.getElementById("days").innerHTML = days;
   document.getElementById("hours").innerHTML = hours;
   document.getElementById("minutes").innerHTML = minutes;
   document.getElementById("seconds").innerHTML = Seconds;
   },1000);


  const placeholderText = "Email the Support center for any kind of special help. click help! ";
  const inputField = document.getElementById("help");
  let currentIndexo = 0;

  function typePlaceholder() {
    if (currentIndexo < placeholderText.length) {
      inputField.placeholder += placeholderText[currentIndexo];
      currentIndexo++;
      setTimeout(typePlaceholder, 100); 
    }
  }

  
  window.onload = typePlaceholder;
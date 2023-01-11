
export const init = () => {
  scrollFunction();
  fadeOutonScroll();

};
/**
 *
 */
function scrollFunction() {
  const courseTitle = document.querySelector('.sectionname');
  const customTopNav = document.getElementById("custom-top-nav");
  //const progressBar = document.querySelector('.mooin-progress-bar');

  var prevScrollpos = window.pageYOffset;
  window.onscroll = function() {
    var currentScrollPos = window.pageYOffset;
    if (prevScrollpos > currentScrollPos) {
      courseTitle.style.opacity = 1;
      customTopNav.style.height = "10rem";
      //progressBar.style.bottom = "translateY(0)";
    } else {
      courseTitle.style.opacity = 0;
      customTopNav.style.height = "5rem";
      //progressBar.style.transform = "translateY(-3rem)";
    }
    prevScrollpos = currentScrollPos;
  };


}



/**
 *
 */
function fadeOutonScroll() {
// Get the container element
const titleOverlay = document.querySelector('.title-overlay');


// Add an event listener for the scroll event
window.addEventListener('scroll', () => {
  // Get the current scroll position
  const scrollPos = window.scrollY;

  // If the scroll position is greater than a certain threshold, apply the .fade-out-active class to the container
  if (scrollPos > 100) {
    titleOverlay.classList.add('fade-out-active');

  } else {
    titleOverlay.classList.remove('fade-out-active');
  }
});
}

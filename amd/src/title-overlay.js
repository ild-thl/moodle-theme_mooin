
// export const init = () => {

//   fadeOutTitleOverlay();

// };

/**
 * Fadeout the Course Titleoverlay in mobile View
 */
export function fadeOutTitleOverlay() {
// Get the container element
const titleOverlay = document.querySelector('.title-overlay');


// Add an event listener for the scroll event
window.addEventListener('scroll', () => {
  // Get the current scroll position
  const scrollPos = window.scrollY;

  // If the scroll position is greater than a certain threshold, apply the .fade-out-active class to the container
  if (scrollPos > 130) {
    titleOverlay.classList.add('fade-out-active');

  } else {
    titleOverlay.classList.remove('fade-out-active');
  }
});
}

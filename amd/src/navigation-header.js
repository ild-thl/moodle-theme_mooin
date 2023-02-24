/**
 * Scrollheader function
 */
export function scrollHeader() {
  //const body = document.body;
  const scrollUp = "scroll-up";
  const scrollDown = "scroll-down";
  let lastScroll = 0;
  const navigationHeader = document.getElementById("custom-top-nav");
  //const navigationHeader = document.getElementById("region-main-box");
  //const navigationHeader = document.querySelector(".single-section");

  window.addEventListener("scroll", () => {
    const currentScroll = window.pageYOffset;
    if (currentScroll <= 0) {
      navigationHeader.classList.remove(scrollUp);
      return;
    }

    if (currentScroll > lastScroll && !navigationHeader.classList.contains(scrollDown)) {
      // down
      navigationHeader.classList.remove(scrollUp);
      navigationHeader.classList.add(scrollDown);
    } else if (
      currentScroll < lastScroll &&
      navigationHeader.classList.contains(scrollDown)
    ) {
      // up
      navigationHeader.classList.remove(scrollDown);
      navigationHeader.classList.add(scrollUp);
    }
    lastScroll = currentScroll;
  });
}

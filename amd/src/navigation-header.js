/**
 * Scrollheader function
 */
export function scrollHeader() {
  //const body = document.body;
  const scrollUp = "scroll-up";
  const scrollDown = "scroll-down";
  let lastScroll = 0;
  const navigationHeader = document.getElementById("custom-top-nav");
  const title = document.getElementById("sectionname-container");
  //const titleHeight = title.offsetHeight + 20;
  const breadcrumbContainer = document.getElementById("mooin-breadcrumb-container");

  //const navigationHeader = document.getElementById("region-main-box");
  //const navigationHeader = document.querySelector(".single-section");

  window.addEventListener("scroll", () => {
    const currentScroll = window.pageYOffset;
    var titleHeight = title.offsetHeight + 20;
    if (currentScroll <= 0) {
      navigationHeader.classList.remove(scrollUp);
      return;
    }

    if (currentScroll > lastScroll && !navigationHeader.classList.contains(scrollDown)) {
      // down
      navigationHeader.classList.remove(scrollUp);
      navigationHeader.classList.add(scrollDown);
      navigationHeader.style.transform = "translateY(-" + titleHeight + "px)";
      breadcrumbContainer.style.transform = "translateY(" + titleHeight + "px)";
      title.style.transform = "translateY(" + titleHeight + "px)";
    } else if (
      currentScroll < lastScroll &&
      navigationHeader.classList.contains(scrollDown)
    ) {
      // up
      navigationHeader.classList.remove(scrollDown);
      navigationHeader.classList.add(scrollUp);
      navigationHeader.style.transform = "translateY(0px)";
      breadcrumbContainer.style.transform = "translateY(0px)";
      title.style.transform = "translateY(0px)";
    }
    lastScroll = currentScroll;
  });
}

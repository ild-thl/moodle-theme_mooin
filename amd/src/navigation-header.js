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
  const progressbarContainer = document.getElementById("mooin4ection-div");
  //const titleHeight = title.offsetHeight + 20;
  const breadcrumbContainer = document.getElementById(
    "mooin4-breadcrumb-container"
  );

  var titleHeight = title.offsetHeight + 20;
  var progressbarContainerHeight = progressbarContainer.offsetHeight;

  var removeOffset;

  //const navigationHeader = document.getElementById("region-main-box");
  //const navigationHeader = document.querySelector(".single-section");

  window.addEventListener("scroll", () => {
    const currentScroll = window.scrollY;
    //var screenWidth = window.innerWidth;
    var screenHeight = window.innerHeight;
    if (screenHeight <= 600) {
      removeOffset = titleHeight + progressbarContainerHeight;
    } else {
      removeOffset = titleHeight;
    }

    if (currentScroll <= 0) {
      navigationHeader.classList.remove(scrollUp);
      return;
    }

    if (
      currentScroll > lastScroll &&
      !navigationHeader.classList.contains(scrollDown)
    ) {
      // down
      navigationHeader.classList.remove(scrollUp);
      navigationHeader.classList.add(scrollDown);
      navigationHeader.style.transform = "translateY(-" + removeOffset + "px)";
      breadcrumbContainer.style.transform =
        "translateY(" + removeOffset + "px)";
      title.style.transform = "translateY(" + removeOffset + "px)";
      //progressbarContainer.style.transform = "translateY(" + removeOffset + "px)";
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
      progressbarContainer.style.transform = "translateY(0px)";
    }
    lastScroll = currentScroll;
  });

  window.addEventListener("resize", () => {
    var screenHeight = window.innerHeight;
    if (
      screenHeight <= 600 &&
      navigationHeader.classList.contains(scrollDown)
    ) {
      removeOffset = titleHeight + progressbarContainerHeight;
      navigationHeader.style.transform = "translateY(-" + removeOffset + "px)";
      breadcrumbContainer.style.transform =
        "translateY(" + removeOffset + "px)";
      title.style.transform = "translateY(" + removeOffset + "px)";
    } else if (
      screenHeight >= 600 &&
      navigationHeader.classList.contains(scrollDown)
    ) {
      removeOffset = titleHeight;
      navigationHeader.style.transform = "translateY(-" + removeOffset + "px)";
      breadcrumbContainer.style.transform =
        "translateY(" + removeOffset + "px)";
      title.style.transform = "translateY(" + removeOffset + "px)";
    }
  });
}

/**
 * Scrollheader function --> TODO: move to courseformat amd components
 */
export function scrollHeader() {
  this.selectors = {
    TITLE: `[data-for='navigationtitle']`,
    PROGRESSBAR: `[data-for='progressbar_container']`,
  };
  const scrollUp = "scroll-up";
  const scrollDown = "scroll-down";
  //let lastScroll = 0;
  const navigationHeader = document.getElementById("navigation-wrapper");
  //const title = document.getElementById("navigationtitle");
  const title = this.selectors.TITLE;
  const progressbarContainer = this.selectors.PROGRESSBAR;
  const breadcrumbContainer = document.getElementById(
    "moointopics-breadcrumb-container"
  );

  var titleHeight = title.offsetHeight + 20;
  var progressbarContainerHeight = progressbarContainer.offsetHeight;
  var removeOffset;

  // document.addEventListener("scroll", () => {
  //   const currentScroll = window.scrollY;
  //   window.console.log(currentScroll);
  //   var screenHeight = window.innerHeight;
  //   if (screenHeight <= 600) {
  //     removeOffset = titleHeight + progressbarContainerHeight;
  //   } else {
  //     removeOffset = titleHeight;
  //   }

  //   if (currentScroll <= 0) {
  //     navigationHeader.classList.remove(scrollUp);
  //     return;
  //   }

  //   if (
  //     currentScroll > lastScroll &&
  //     !navigationHeader.classList.contains(scrollDown)
  //   ) {
  //     // down
  //     navigationHeader.classList.remove(scrollUp);
  //     navigationHeader.classList.add(scrollDown);
  //     navigationHeader.style.transform = "translateY(-" + removeOffset + "px)";
  //     breadcrumbContainer.style.transform =
  //       "translateY(" + removeOffset + "px)";
  //     title.style.transform = "translateY(" + removeOffset + "px)";
  //     //progressbarContainer.style.transform = "translateY(" + removeOffset + "px)";
  //   } else if (
  //     currentScroll < lastScroll &&
  //     navigationHeader.classList.contains(scrollDown)
  //   ) {
  //     // up
  //     navigationHeader.classList.remove(scrollDown);
  //     navigationHeader.classList.add(scrollUp);
  //     navigationHeader.style.transform = "translateY(0px)";
  //     breadcrumbContainer.style.transform = "translateY(0px)";
  //     title.style.transform = "translateY(0px)";
  //     progressbarContainer.style.transform = "translateY(0px)";
  //   }
  //   lastScroll = currentScroll;
  // });

  window.addEventListener("resize", () => {
    if (navigationHeader) {
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
    }
    
  });
}

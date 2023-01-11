/**
 *
 * @param {*} percentage
 */
export function updateProgressbar(percentage) {
  const progressBarInner = document.querySelector(".progressbar-inner");
  progressBarInner.setAttribute('style', `width:${percentage}%`);
}

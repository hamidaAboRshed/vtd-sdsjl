var imgScroller;
var initScroller = function initScroller() {return imgScroller = Scroller(document.querySelector('.scroller'));};
setTimeout(initScroller, 2500);



function Scroller(el) {
  var wrapper,itemList,leftBtn,rightBtn, // Elements
  transformMaxPx,stepSizePx, // Misc scroll coords
  currentXOffset = 0,
  scrollLeft,scrollRight; // event fn hooks
  wrapper = el.querySelector('.items-wrapper');
  itemList = el.querySelector('ul.items');
  leftBtn = el.querySelector('.leftArrow');
  rightBtn = el.querySelector('.rightArrow');

  function updateLayout() {
    var wrapperRect = wrapper.getBoundingClientRect();
    var listRect = itemList.getBoundingClientRect();
    var item = itemList.children[0] && itemList.children[0];
    var itemRect = item && item.getBoundingClientRect();
    var totalWidth = listRect && listRect.width;
    var scrollWidth = wrapperRect.width;
    stepSizePx = itemRect.width;
    transformMaxPx = totalWidth - scrollWidth;
    scrollLeft = scroll.bind(null, 'left', stepSizePx);
    scrollRight = scroll.bind(null, 'right', stepSizePx);
    return item;
  }
  function scroll(direction) {
    var tempOffset = currentXOffset;
    if (direction === 'left') {
      currentXOffset += stepSizePx;
    } else {//'assume' right scroll - default
      currentXOffset -= stepSizePx;
    }
    if (currentXOffset <= 0 && currentXOffset >= (transformMaxPx + stepSizePx) * -1) {// apply transform
      itemList.style.transform = 'translatex(' + currentXOffset + 'px)';
      // console.log(`Doing transition ${direction}! currentXOffset=${currentXOffset} transformMaxPx=${transformMaxPx}`);
    } else {
      currentXOffset = tempOffset;
      // console.log(`Cancelled transition ${direction}! currentXOffset=${currentXOffset} transformMaxPx=${transformMaxPx}`);
    }
  }
  function init() {
    updateLayout();
    leftBtn.addEventListener('click', scrollLeft);
    rightBtn.addEventListener('click', scrollRight);
    itemList.style.transform = 'translatex(0px)';
  }
  function destroy() {
    leftBtn.removeEventListener('click', scrollLeft);
    rightBtn.removeEventListener('click', scrollRight);
  }
  init();
  return {
    'scroll': scroll,
    'destroy': destroy,
    'init': init,
    'debug': {
      updateLayout: updateLayout, wrapper: wrapper, itemList: itemList, stepSizePx: stepSizePx, transformMaxPx: transformMaxPx } };


}
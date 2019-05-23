# Priority Nav Scroller

Priority Nav Scroller is a plugin for the priority+ navigation pattern. When the navigation items don’t fit on screen they are hidden in a horizontal scrollable container with controls.

[Demo site](http://nigelotoole.github.io/priority-nav-scroller/)



## Installation
```javascript
$ npm install priority-nav-scroller --save-dev
```


## Usage

The script is an ES6(ES2015) module but a compiled version is included in the build as index.js. You can also copy scripts/priority-nav-scroller.js into your own site if your build process can accomodate ES6 modules. Babel and Browserify are used in the demo site.

```javascript
import PriorityNavScroller from './priority-nav-scroller.js';

// Init with default setup
const priorityNavScrollerDefault = PriorityNavScroller();

// Init with all options at default setting
const priorityNavScrollerDefault = PriorityNavScroller({
  selector: '.nav-scroller',
  navSelector: '.nav-scroller-nav',
  contentSelector: '.nav-scroller-content',
  itemSelector: '.nav-scroller-item',
  buttonLeftSelector: '.nav-scroller-btn--left',
  buttonRightSelector: '.nav-scroller-btn--right',
  scrollStep: 75
});

// Init multiple nav scrollers with the same options
let navScrollers = document.querySelectorAll('.nav-scroller');

navScrollers.forEach((currentValue, currentIndex) => {
  PriorityNavScroller({
    selector: currentValue
  });
});
```


### Options
**selector** {string || DOM node} Element selector. <br>
**navSelector** {string} Nav element selector. <br>
**navSelector** {string} Nav element selector.<br>
**contentSelector** {string} Content element selector.<br>
**itemSelector** {string} Items selector.<br>
**buttonLeftSelector** {string} Left button selector.<br>
**buttonRightSelector** {string} Right button selector.<br>
**scrollStep** {integer || string} Amount to scroll on button click. 'average' gets the average link width.



### Markup

```html
<div class="nav-scroller">

  <nav class="nav-scroller-nav">
    <div class="nav-scroller-content">
      <a href="#" class="nav-scroller-item">Item 1</a>
      <a href="#" class="nav-scroller-item">Item 2</a>
      <a href="#" class="nav-scroller-item">Item 3</a>
      ...
    </div>
  </nav>

  <button class="nav-scroller-btn nav-scroller-btn--left">
    ...
  </button>

  <button class="nav-scroller-btn nav-scroller-btn--right">
    ...
  </button>

</div>
```



### Using other tags
The demos use a &lt;div&gt; for "nav-scroller-content" and &lt;a&gt; tags for the "nav-scroller-item" but you can also use a &lt;ul&gt; as below.

```html
<ul class="nav-scroller-content">
  <li class="nav-scroller-item"><a href="#" class="nav-scroller-item">Item 1</a></li>
  ...
```

The buttons use an svg for the arrow icon but this can be replaced with an image, text or html entities(&lt; &gt;, &larr; &rarr;, &#9668; &#9658;), just update the nav-scroller-button styles as needed.



### Styles

Import the styles into your project directly from the node_modules as below or copy the styles into your own project, you will need styles/priority-nav-scroller.scss. There is also a compiled CSS file you can use, styles/priority-nav-scroller.css.

```html
@import "node_modules/priority-nav-scroller/styles/priority-nav-scroller.scss";
```


### Browser support
Supports all modern browsers(Firefox, Chrome and Edge) released as of January 2018. For older browsers you may need to include polyfills for Nodelist.forEach and Element.classList.



## Demo site
Clone or download from Github.

```javascript
$ npm install
$ gulp serve
```


## Inspiration
[A horizontal scrolling navigation pattern for touch and mouse with moving current indicator](https://benfrain.com/a-horizontal-scrolling-navigation-pattern-for-touch-and-mouse-with-moving-current-indicator/) by Ben Frain.<br>
[A Priority+ Navigation With Scrolling and Dropdowns](https://css-tricks.com/priority-navigation-scrolling-dropdowns/) by Micah Miller-Eshleman on CSS-Tricks.<br>
[The Priority+ Navigation Pattern](https://css-tricks.com/the-priority-navigation-pattern/) by Chris Coyier on CSS-Tricks.



### License
MIT

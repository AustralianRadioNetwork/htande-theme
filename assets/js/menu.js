// Hamburger menu

document.getElementById('ulMenu').style.maxHeight = '0px';

function menutoggle() {
  if (document.getElementById('ulMenu').style.maxHeight === '0px') {
    document.getElementById('ulMenu').style.maxHeight = '200px';
  } else {
    document.getElementById('ulMenu').style.maxHeight = '0px';
  }
}

// Search button

document.getElementById('search').style.display = 'none';

function searchtoggle() {
  if (document.getElementById('search').style.display === 'none') {
    document.getElementById('search').style.display = 'block';
  } else {
    document.getElementById('search').style.display = 'none';
  }
}

function defaultSearchPosition(x) {
  if (x.matches) {
    // If media query matches
    document.getElementById('search').style.display = 'block';
  } else {
    document.getElementById('search').style.display = 'none';
  }
}

var x = window.matchMedia('(min-width: 964px)');
defaultSearchPosition(x); // Call listener function at run time
x.addListener(defaultSearchPosition);



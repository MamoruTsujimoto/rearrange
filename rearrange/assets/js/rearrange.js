$(function() {
  console.log('Wellcome to Rearrange.');
});

window.onload = function() {
  const spinner = document.getElementById('loading');
  spinner.classList.add('loaded');
}

// MENU
const menu = document.querySelector('#menu');
const overlay = document.querySelector('#overlay');
if(menu !== null) {
  menu.addEventListener('click', function(){
    const menu = this.children[0];
    document.body.classList.add('is-open');
    overlay.classList.add('is-open');
  });
}

const close = document.querySelector('#close');
if(close !== null) {
  close.addEventListener('click', function(){
    if(overlay.classList.contains('is-open')) {
      overlay.classList.remove('is-open');
      document.body.classList.remove('is-open');
    }
  });
}


const imgLoad = imagesLoaded( document.querySelector('main') );
imgLoad.on( 'always', function(instance) {
  //console.log('Loaded');
});

// Up To Top
const up = document.querySelector('#up-to-top');

function getScrolled() {
  return ( window.pageYOffset !== undefined ) ? window.pageYOffset: document.documentElement.scrollTop;
}

window.onscroll = function() {
  ( getScrolled() > 500 ) ? up.classList.add( 'is-active' ): up.classList.remove( 'is-active' );
};

function scrollToTop() {
  var scrolled = getScrolled();
  window.scrollTo( 0, Math.floor( scrolled / 2 ) );
  if ( scrolled > 0 ) {
    window.setTimeout( scrollToTop, 30 );
  }
};

if(up !== null) {
  up.onclick = function() {
    scrollToTop();
  };;
}

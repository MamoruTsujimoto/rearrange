$(function() {
  console.log('Wellcome to Rearrange.');
});

window.onload = function() {
  const spinner = document.getElementById('loading');
  spinner.classList.add('loaded');

  const fadeIn = (target) => {
    target.classList.add('active');
  };

  const observeUse = (entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        console.log(entry);
        fadeIn(entry.target);
      }
    });
  };

  const storyPastIsObservers = document.querySelectorAll('.story-past');
  const storyPastOptions = {
    rootMargin: '0% 0px',
  };
  const storyPastObserver = new IntersectionObserver(observeUse, storyPastOptions);
  storyPastIsObservers.forEach(isObserver => {
    storyPastObserver.observe(isObserver);
  });

  const singleArticle = document.querySelector('.single article');
  if(singleArticle !== null) {
    singleArticle.classList.add('active');
  }
}

// MENU
const html = document.getElementsByTagName('html')[0];
const menuTrigger = document.querySelector('#menu-trigger');
const menu = document.querySelector('#menu');
const wrap = document.querySelector('#global-wrapper');

if(menuTrigger !== null) {
  menuTrigger.addEventListener('click', function(){
    html.classList.add('is-open');
    setTimeout(function(){
      wrap.classList.add('blur');
      menu.classList.add('is-open');
    }, 280);
  });
}

const close = document.querySelector('#close');
if(close !== null) {
  close.addEventListener('click', function(){
    if(menu.classList.contains('is-open')) {
      html.classList.remove('is-open');
      wrap.classList.remove('blur');
      menu.classList.remove('is-open');
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
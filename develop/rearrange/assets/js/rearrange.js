$(function() {
  console.log('Wellcome to Rearrange.');
});

window.onload = function() {
  const spinner = document.getElementById('loading');
  setTimeout(function(){
    spinner.classList.add('loaded');
  },100);
}

// MENU
// const menu = document.querySelector('#menu');
// const overlay = document.querySelector('#overlay');

// menu.addEventListener('click', function(){
//   const menu = this.children[0];
//   menu.classList.toggle('active');
//   document.body.classList.add('is-open');
//   overlay.classList.add('is-open');

//   overlay.addEventListener('click',function() {
//     this.classList.remove('is-open');
//     menu.classList.remove('active');
//     document.body.classList.remove('is-open');
//   });
// });

var imgLoad = imagesLoaded( document.querySelector('main') );

imgLoad.on( 'always', function( instance) {
  console.log('Loaded');
});

// imagesLoaded( document.querySelector('main'), function( instance ) {
//   console.log('all images are loaded');
// });

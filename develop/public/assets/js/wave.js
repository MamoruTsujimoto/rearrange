// // TOP NEW STORY
// const canvas = document.querySelector("#new-story-image");

// if(canvas !== null) {
//   const imageElm = canvas.dataset.figure;

//   const app = new PIXI.Application({
//     view: canvas,
//     width: 820,
//     height: 580,
//     transparent: true
//   });

//   let container = new PIXI.Container();
//   app.stage.addChild(container);


//   let renderer = new PIXI.autoDetectRenderer();

//   const bg = PIXI.Sprite.fromImage(imageElm);

//   let ripples = [];


//   const displacementSprite = PIXI.Sprite.fromImage('https://s3-us-west-2.amazonaws.com/s.cdpn.io/1600187/waterTemp.jpg');
//   displacementSprite.texture.baseTexture.wrapMode = PIXI.WRAP_MODES.REPEAT;
//   displacementSprite.scale.set(1);
//   displacementSprite.anchor.set(0);

//   const loadSprite = PIXI.Sprite.fromImage('https://s3-us-west-2.amazonaws.com/s.cdpn.io/1600187/waterTemp.jpg');
//   loadSprite.texture.baseTexture.wrapMode = PIXI.WRAP_MODES.REPEAT;
//   loadSprite.scale.set(0.99);
//   loadSprite.anchor.set(0.2);

//   const loadFilter = new PIXI.filters.DisplacementFilter(loadSprite)
//   loadFilter.scale.x = 0;
//   loadFilter.scale.y = 0;

//   container.filters = [loadFilter]


//   let displacementFilter = new PIXI.filters.DisplacementFilter(displacementSprite);
//   displacementFilter.scale.x = 10;
//   displacementFilter.scale.y = 10;
//   const filters = []

//   filters.push(displacementFilter);

//   for (let i = 0; i < 10; i++) {
//     const ripple = new PIXI.Sprite.fromImage('https://s3-us-west-2.amazonaws.com/s.cdpn.io/1600187/ripple.png');

//     ripple.anchor.set(0.5);

//     ripple.scale.set(0);

//     app.stage.addChild(ripple);

//     const filter = new PIXI.filters.DisplacementFilter(ripple)
//     filters.push(filter)
//     ripples.push(ripple)
//   }

//   app.stage.filters = filters;
//   bg.anchor.set(0.5);
//   bg.position.set(410, 290);
//   bg.width = app.renderer.width;
//   bg.height = app.renderer.height;

//   container.addChild(bg);

//   const waves = TweenMax.to(displacementSprite.anchor, 44, {
//     y: "-2",
//     x: "-1",
//     ease: Power0.easeNone,
//     repeat: -1,
//     paused: true
//   })

//   runTweens = (ripple, filter) => {
//     TweenMax.fromTo(ripple.scale, 4,{ x: .1, y: .1 }, { x: 1.5, y: 1.5 })
//     TweenMax.fromTo(filter.scale, 4, { x: 50, y: 50 },{ x: 0, y: 0 })
//   }

//   TweenMax.from(container, 1, {
//     alpha: 0,
//     repeatDelay: 4,
//     ease: Power3.easeOut,
//     yoyo: true,
//     delay: 2,
//   })

//   TweenMax.from(loadSprite.anchor, 1, {
//     y: 0.35,
//     x: 0.25,
//     ease: Power1.easeOut,
//     repeatDelay: 4,
//     yoyo: true,
//     delay: 2,
//     onComplete: () => {waves.play()}
//   })

//   TweenMax.from(loadFilter.scale, 1, {
//     x: 900,
//     y: 9500,
//     ease: Power1.easeOut,
//     delay: 2,
//   })
// }

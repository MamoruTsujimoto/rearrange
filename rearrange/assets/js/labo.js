// register the effect with GSAP:
gsap.registerEffect({
  name: "fade",
  defaults: {duration:2}, //defaults get applied to the "config" object passed to the effect below
  effect: (targets, config) => {
    return gsap.to(targets, {duration: config.duration, opacity:0});
  }
});

// now we can use it like this:
gsap.effects.fade(".green");

// Wait a bit and override the defaults:
gsap.delayedCall(3, () => gsap.effects.fade(".orange", {duration: 1}) );

document.querySelector(".grey").addEventListener("mouseenter", e => gsap.effects.fade(e.target));
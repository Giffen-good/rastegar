(function() {
  document.addEventListener('DOMContentLoaded', function() {
    if (!document.querySelector('.hero-banner')) {
      document.getElementById('masthead').classList.add('dark-mode')
    }
    var alogo = document.querySelector('.animated-logo');
    if (alogo) {
     
      var templateUrl = object_name.templateUrl;
      var FRAME_COUNT = 80;
      var frames = []
      for (var i = 0; i < FRAME_COUNT; i++) {
        var img = new Image();
        var pathName = `${templateUrl}/assets/logo_orbit_transparent_png/_Blender_Orbit_000${i < 10 ? '0' + i : i}.png`;
        img.src = pathName
        img.id = `slide-${i}`
        alogo.appendChild(img);
      }
      function removeAllClass(name) {
        var els = document.querySelectorAll(`.${name}`);
        for (var i = 0; i < els.length; i++) {
          els[i].classList.remove(name);
        }
      }
      var h = window.innerHeight*1.8;
      var currentSlide = Math.floor(FRAME_COUNT*window.scrollY/h);
      if (document.getElementById(`slide-${currentSlide}`)) document.getElementById(`slide-${currentSlide}`).classList.add('show-slide');
      document.addEventListener('scroll', function() {
        var scrollPos = window.scrollY;
        if (scrollPos < h) {
          var n = scrollPos/h
          var newSlide = Math.floor(FRAME_COUNT*n)
          if (currentSlide !== newSlide) {
            removeAllClass('show-slide');
            currentSlide = newSlide;
            document.getElementById(`slide-${currentSlide}`).classList.add('show-slide');
          }
        }
      });
    }
    var splashVideo = document.getElementById('splash-video');
    if (splashVideo) {
      var vid = document.createElement('video')
      vid.src = splashVideo.getAttribute('src');
      vid.type = "video/mp4";
      vid.autoplay = true;
      vid.muted = true;
      
      vid.id = 'splashVideo';
      splashVideo.classList.add('playing');
      splashVideo.appendChild(vid);
      vid.addEventListener('ended',myHandler,false);
      function myHandler(e) {
        console.log('completed');
        splashVideo.classList.add('completed');

      }
    }
    // if (!sessionStorage.isVisited) {
    //   sessionStorage.isVisited = 'true'
      
    // }
  })
})();
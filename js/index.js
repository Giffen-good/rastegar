(function() {
  document.addEventListener('DOMContentLoaded', function() {
    if (!document.querySelector('.hero-banner')) {
      document.getElementById('masthead').classList.add('dark-mode')
      
    } else {
      checkBurgerPos();
      var HERO_BANNER_CONSTANT;
      if (!alogo) {
        HERO_BANNER_CONSTANT = 0.65;

        window.addEventListener('scroll', checkBurgerPos)

      } else {
        HERO_BANNER_CONSTANT = 1;
      }
    }
    function checkBurgerPos() {
      if (window.scrollY > window.innerHeight*HERO_BANNER_CONSTANT) {
        document.getElementById('nav-icon3').classList.add('invert')
      } else {
        document.getElementById('nav-icon3').classList.remove('invert')
      }
    }
    var alogo = document.querySelector('.animated-logo');
    if (alogo) {
     
      var templateUrl = object_name.templateUrl;
      var FRAME_COUNT = 60;
      var frames = [];
      function appendAnimatedLogo() {
        for (var i = 0; i < FRAME_COUNT; i++) {
          var img = new Image();
          var pathName = `${templateUrl}/assets/logo_orbit_transparent_png/_Blender_Orbit_000${i < 10 ? '0' + i : i}.png`;
          img.src = pathName
          img.id = `slide-${i}`
          alogo.appendChild(img);
        }
        var h = window.innerHeight*1.8;
        var currentSlide = Math.floor(FRAME_COUNT*window.scrollY/h);
       
        if (document.getElementById(`slide-${currentSlide}`)) document.getElementById(`slide-${currentSlide}`).classList.add('show-slide');
        document.addEventListener('scroll', function() {
          if (document.querySelector('.hero-banner')) checkBurgerPos();
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
        })
      }
      function loadHomePageAssets() {
        appendAnimatedLogo();
        loadHeroVideo();
      }
      if (sessionStorage.isVisited) appendAnimatedLogo();
      function removeAllClass(name) {
        var els = document.querySelectorAll(`.${name}`);
        for (var i = 0; i < els.length; i++) {
          els[i].classList.remove(name);
        }
      }
    }
    if (!sessionStorage.isVisited) {
      sessionStorage.isVisited = 'true'
      var splashVideo = document.getElementById('splash-video');
      if (splashVideo) {                                                     
        var smallSrc;
        if ( window.innerWidth < 783 ) smallSrc = splashVideo.getAttribute('small-src');
        var src = smallSrc  || splashVideo.getAttribute('src')
        var vid = document.createElement('video')
        vid.src = src;
        vid.autoplay = true;
        vid.type = "video/mp4";
        vid.muted = true;
        vid.playsInline = true;
        
        vid.id = 'splashVideo';
        splashVideo.classList.add('playing');
        splashVideo.appendChild(vid);
        vid.onplaying = function() {
          loadHomePageAssets();
          console.log('video-playing');
        }
        vid.addEventListener('ended',myHandler,false);
        function myHandler(e) {
          splashVideo.classList.add('completed');
        }
      }
    } else {
      loadHeroVideo();
    }
  })
  function loadHeroVideo() {
    var heroBannerVid = document.querySelectorAll('section.hero-banner.vid video');
    if (heroBannerVid.length) {
      for (var i = 0; i < heroBannerVid.length;i++) {
        for (var source in heroBannerVid[i].children) {
          var videoSource = heroBannerVid[i].children[source];
          if (typeof videoSource.tagName === "string" && videoSource.tagName === "SOURCE") {
            videoSource.src = videoSource.dataset.src;
          }
        }
        heroBannerVid[i].load();
      }
    }
  }
  var teamGalleries = document.querySelectorAll('.team-gallery');
  if (teamGalleries) {
    function createModal(el){
      console.log(el.querySelector('h3').innerText);
      document.querySelector('.modal').classList.add('open');
      var name = el.querySelector('h3').innerText;
      document.querySelector('.modal-name').innerText = name;
      document.querySelector('.modal-job-title').innerText = el.querySelector('h4').innerText;
      document.querySelector('.modal-bio').innerText  = el.querySelector('.bio').innerText;
      document.querySelector('.modal-image').setAttribute('src', el.querySelector('img').getAttribute('src'));
      document.querySelector('.modal-button').innerText = `Contact ${name.split()[0]}`;
      document.querySelector('.modal-button').src = el.querySelector('.cta-btn').src
    }
    var modalWrap = document.querySelectorAll('.modal-wrap');
    for (var i = 0; i < modalWrap.length; i++) {
      modalWrap[i].addEventListener('click', function(e) {
        console.log('1')
        for (var j = 0; j < e.path.length; j++) {
         if (e.path[j].classList && !e.path[j].classList.contains('.modal') || e.target !== document.querySelector('.modal')) document.querySelector('.modal').classList.remove('open');
        }
      }, true)
    }
    for (var i = 0; i < teamGalleries.length;i++) {
      
      teamGalleries[i].addEventListener('click', function(e) {
        console.log('2')
        for (var j = 0; j < e.path.length; j++) {
          if (e.path[j].classList && e.path[j].classList.contains('team-member')) {
            createModal(e.path[j]);
            break;
          }
          if (e.path[j].classList && e.path[j].classList.contains('.modal-close') || e.target === document.querySelector('.modal-close')) document.querySelector('.modal').classList.remove('open');
        }
      }, false)
    }
  }
  var tableOfContents = document.querySelector('.table-of-contents');
  if (tableOfContents) {
    var chapters = document.querySelectorAll('.chapter-heading');
    if (chapters.length) {
      var wrap = document.createElement('div');
      wrap.id = "toc-wrap";
      var realToC = document.createElement('div')
      var h2 = document.createElement('h2');
      h2.innerText = 'Chapters';
      wrap.appendChild(h2);
      realToC.id = 'real-table-of-contents'
      realToC.classList.add('wp-block-columns')
      for (var i = 0; i < chapters.length; i++) {
        var label = document.createElement('h4');
        label.innerText = `Chapter ${i + 1}`;
        label.id = `chapter-${i}`;
        label.classList.add('chapter-label');
        chapters[i].parentNode.insertBefore(label, chapters[i]);
        var inner = document.createElement('a');
        inner.classList.add('standard-wrapper');
        inner.href = `#chapter-${i}`;
        var h = document.createElement('h3');
        h.innerText = i + 1;
        var h2 = document.createElement('h2');
        h2.innerText = chapters[i].innerText;
        inner.appendChild(h);
        inner.appendChild(h2);

        realToC.appendChild(inner);
      }
      wrap.appendChild(realToC);
      tableOfContents.parentNode.insertBefore(wrap, tableOfContents.nextSibling)
    }
  }

  var faqEntry = document.querySelectorAll('.faq-entry .head-wrapper');
  for (var i = 0; i < faqEntry.length;i++) {
    faqEntry[i].addEventListener('click', function() {
      this.classList.toggle('open');
    })
  }

  let observer = new IntersectionObserver(
    (entries, observer) => { 
    entries.forEach(entry => {
        /* Placeholder replacement */
        if (entry.isIntersecting) {
          entry.target.classList.add('in-view');
        }
      });
    }, 
    {rootMargin: "0px 0px -100px 0px"});
    function fadeIn(selector) {
      document.querySelectorAll(selector).forEach(el => {
        if (el.offsetTop > window.pageYOffset) {
          el.classList.add('out-of-view');
          observer.observe(el)
        }
      });
    }
    console.log(!document.querySelector('.is-post-page'))
    if (!document.querySelector('.is-post-page')) {
      fadeIn('.entry-content > *');
      fadeIn('.sixty-forty-gallery .column');
    }
})();
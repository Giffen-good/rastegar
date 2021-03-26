(function() {
  document.addEventListener('DOMContentLoaded', function() {
    if (!document.querySelector('.hero-banner')) {
      document.getElementById('masthead').classList.add('dark-mode')
    }
    var alogo = document.querySelector('.animated-logo');
    if (alogo) {
     
      var templateUrl = object_name.templateUrl;
      var FRAME_COUNT = 60;
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
   
    if (!sessionStorage.isVisited) {
      sessionStorage.isVisited = 'true'
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
          splashVideo.classList.add('completed');
        }
      }
    }
  })
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
    }
    for (var i = 0; i < teamGalleries.length;i++) {
      teamGalleries[i].addEventListener('click', function(e) {
        for (var j = 0; j < e.path.length; j++) {
          if (e.path[j].classList && e.path[j].classList.contains('team-member')) {
            createModal(e.path[j]);
            break;
          }
          if (e.path[j].classList && e.path[j].classList.contains('.modal-close') || e.target === document.querySelector('.modal-close')) document.querySelector('.modal').classList.remove('open');
        }
      })
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
        chapters[i].id = `chapter-${i}`;
        var label = document.createElement('h4');
        label.innerText = `Chapter ${i + 1}`;
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
    {rootMargin: "0px 0px -200px 0px"});
    function fadeIn(selector) {
      document.querySelectorAll(selector).forEach(el => {
        if (el.offsetTop > window.pageYOffset) {
          el.classList.add('out-of-view');
          observer.observe(el)
        }
      });
    }
    fadeIn('.entry-content > *');
    fadeIn('.sixty-forty-gallery .column');
})();
/**
 * Codenatives Theme — Main JavaScript
 *
 * Wrapped in jQuery noConflict wrapper for WordPress compatibility.
 *
 * @package Codenatives
 */
;(function($) {
  'use strict';

  $(document).ready(function () {

    /* ----- Theme Toggle ----- */
    var savedTheme = localStorage.getItem('cn-theme') || 'light';
    $('html').attr('data-theme', savedTheme);
    updateThemeIcon(savedTheme);

    $('.codenatives-theme-toggle').on('click', function () {
      var current = $('html').attr('data-theme');
      var next = current === 'dark' ? 'light' : 'dark';
      $('html').attr('data-theme', next);
      localStorage.setItem('cn-theme', next);
      updateThemeIcon(next);
    });

    function updateThemeIcon(theme) {
      var icon = theme === 'dark' ? '&#9788;' : '&#9790;';
      $('.codenatives-theme-toggle').html(icon);
    }

    /* ----- Navbar Scroll ----- */
    $(window).on('scroll', function () {
      if ($(this).scrollTop() > 60) {
        $('.codenatives-navbar').addClass('scrolled');
      } else {
        $('.codenatives-navbar').removeClass('scrolled');
      }
    });

    /* ----- Mobile Menu ----- */
    $('.codenatives-mobile-toggle').on('click', function () {
      $('.codenatives-mobile-menu').addClass('open');
      $('body').css('overflow', 'hidden');
    });
    $('.codenatives-mobile-menu-close, .codenatives-mobile-menu a').on('click', function () {
      $('.codenatives-mobile-menu').removeClass('open');
      $('body').css('overflow', '');
    });

    /* ----- FAQ Accordion ----- */
    $('.codenatives-faq-question').on('click', function () {
      var $item = $(this).closest('.codenatives-faq-item');
      var $answer = $item.find('.codenatives-faq-answer');
      var isActive = $item.hasClass('active');

      $('.codenatives-faq-item').removeClass('active');
      $('.codenatives-faq-answer').css('max-height', '0px');

      if (!isActive) {
        $item.addClass('active');
        $answer.css('max-height', $answer[0].scrollHeight + 'px');
      }
    });

    /* ----- Team Tabs ----- */
    $('.codenatives-team-tab').on('click', function () {
      var tab = $(this).data('tab');
      $('.codenatives-team-tab').removeClass('active');
      $(this).addClass('active');
      $('.codenatives-team-panel').removeClass('active');
      $('.codenatives-team-panel[data-tab="' + tab + '"]').addClass('active');
    });

    /* ----- Capability Tabs ----- */
    $('.codenatives-cap-tab').on('click', function () {
      var cap = $(this).data('cap');
      $('.codenatives-cap-tab').removeClass('active');
      $(this).addClass('active');
      $('.codenatives-cap-panel').removeClass('active');
      $('.codenatives-cap-panel[data-cap="' + cap + '"]').addClass('active');
    });

    /* ----- Animated Counters ----- */
    function animateCounters() {
      $('[data-count]').each(function () {
        var $el = $(this);
        if ($el.data('counted')) { return; }
        var rect = this.getBoundingClientRect();
        if (rect.top < window.innerHeight && rect.bottom > 0) {
          $el.data('counted', true);
          var target = parseInt($el.data('count'), 10);
          var suffix = $el.data('suffix') || '';
          var duration = 2000;
          var increment = target / (duration / 16);
          var current = 0;
          var timer = setInterval(function () {
            current += increment;
            if (current >= target) {
              current = target;
              clearInterval(timer);
            }
            $el.text(Math.floor(current) + suffix);
          }, 16);
        }
      });
    }
    $(window).on('scroll', animateCounters);
    animateCounters();

    /* ----- Scroll Animations ----- */
    function checkAnimations() {
      $('.animate-on-scroll').each(function () {
        var rect = this.getBoundingClientRect();
        if (rect.top < window.innerHeight - 60) {
          $(this).addClass('visible');
        }
      });
    }
    $(window).on('scroll', checkAnimations);
    checkAnimations();

    /* ----- Parallax ----- */
    $(window).on('scroll', function () {
      $('.codenatives-parallax-bg').each(function () {
        var scrolled = $(window).scrollTop();
        var sectionTop = $(this).closest('.codenatives-parallax-section').offset().top;
        var rate = (scrolled - sectionTop) * 0.3;
        $(this).css('transform', 'translateY(' + rate + 'px)');
      });
    });

    /* ----- Particle Canvas ----- */
    var canvas = document.getElementById('codenatives-particle-canvas');
    if (canvas) {
      var ctx = canvas.getContext('2d');
      var particles = [];

      function resizeCanvas() {
        canvas.width = canvas.parentElement.offsetWidth;
        canvas.height = canvas.parentElement.offsetHeight;
      }
      resizeCanvas();
      $(window).on('resize', resizeCanvas);

      function createParticles() {
        particles = [];
        var count = Math.floor((canvas.width * canvas.height) / 18000);
        for (var i = 0; i < count; i++) {
          particles.push({
            x: Math.random() * canvas.width,
            y: Math.random() * canvas.height,
            vx: (Math.random() - 0.5) * 0.4,
            vy: (Math.random() - 0.5) * 0.4,
            r: Math.random() * 1.5 + 0.5,
            opacity: Math.random() * 0.4 + 0.1
          });
        }
      }
      createParticles();

      function drawParticles() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        particles.forEach(function (p) {
          p.x += p.vx;
          p.y += p.vy;
          if (p.x < 0) { p.x = canvas.width; }
          if (p.x > canvas.width) { p.x = 0; }
          if (p.y < 0) { p.y = canvas.height; }
          if (p.y > canvas.height) { p.y = 0; }

          ctx.beginPath();
          ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
          ctx.fillStyle = 'rgba(148, 163, 184, ' + p.opacity + ')';
          ctx.fill();
        });

        for (var i = 0; i < particles.length; i++) {
          for (var j = i + 1; j < particles.length; j++) {
            var dx = particles[i].x - particles[j].x;
            var dy = particles[i].y - particles[j].y;
            var dist = Math.sqrt(dx * dx + dy * dy);
            if (dist < 120) {
              ctx.beginPath();
              ctx.moveTo(particles[i].x, particles[i].y);
              ctx.lineTo(particles[j].x, particles[j].y);
              ctx.strokeStyle = 'rgba(148, 163, 184, ' + (0.06 * (1 - dist / 120)) + ')';
              ctx.lineWidth = 0.5;
              ctx.stroke();
            }
          }
        }
        requestAnimationFrame(drawParticles);
      }
      drawParticles();
    }

    /* ----- Capability Cards (Grid) ----- */
    if ($('.codenatives-cap-grid').length) {
      $('.codenatives-cap-card').on('mouseenter', function () {
        var $this = $(this);
        if ($this.hasClass('expanded')) { return; }
        $('.codenatives-cap-card').removeClass('expanded');
        $this.addClass('expanded');
      });

      $('.codenatives-cap-grid').on('mouseleave', function () {
        $('.codenatives-cap-card').removeClass('expanded');
      });

      /* Touch support for mobile */
      $('.codenatives-cap-card').on('touchstart', function (e) {
        var $this = $(this);
        if ($this.hasClass('expanded')) {
          $this.removeClass('expanded');
        } else {
          e.preventDefault();
          $('.codenatives-cap-card').removeClass('expanded');
          $this.addClass('expanded');
        }
      });
    }

    /* ----- Carousel ----- */
    $('.codenatives-carousel-container').each(function () {
      var $container = $(this);
      var $track = $container.find('.codenatives-carousel-track');
      var $items = $track.children();
      var $dots = $container.find('.codenatives-carousel-dots');
      var $prevBtn = $container.find('.codenatives-carousel-btn.prev');
      var $nextBtn = $container.find('.codenatives-carousel-btn.next');

      var currentIndex = 0;
      var itemsPerView = getItemsPerView();

      function getItemsPerView() {
        if (window.innerWidth <= 639) { return 1; }
        if (window.innerWidth <= 1023) { return 2; }
        return 3;
      }

      function getTotalPages() {
        return Math.max(1, Math.ceil($items.length / itemsPerView));
      }

      function buildDots() {
        $dots.empty();
        var pages = getTotalPages();
        for (var i = 0; i < pages; i++) {
          var $dot = $('<button class="codenatives-carousel-dot" aria-label="' + codenativesL10n.page + ' ' + (i + 1) + '"></button>');
          if (i === 0) { $dot.addClass('active'); }
          (function(idx) {
            $dot.on('click', function () { goTo(idx); });
          })(i);
          $dots.append($dot);
        }
      }

      function goTo(index) {
        var pages = getTotalPages();
        if (index < 0) { index = pages - 1; }
        if (index >= pages) { index = 0; }
        currentIndex = index;

        var itemWidth = $items.first().outerWidth(true);
        var offset = currentIndex * itemsPerView * itemWidth;
        $track.css('transform', 'translateX(-' + offset + 'px)');

        $dots.find('.codenatives-carousel-dot').removeClass('active');
        $dots.find('.codenatives-carousel-dot').eq(currentIndex).addClass('active');
      }

      $prevBtn.on('click', function () { goTo(currentIndex - 1); });
      $nextBtn.on('click', function () { goTo(currentIndex + 1); });

      buildDots();

      $(window).on('resize', function () {
        itemsPerView = getItemsPerView();
        buildDots();
        goTo(0);
      });

      /* Touch / swipe support */
      var startX = 0;
      var isDragging = false;

      $track.on('touchstart', function (e) {
        startX = e.originalEvent.touches[0].clientX;
        isDragging = true;
      });
      $track.on('touchmove', function () {
        if (!isDragging) { return; }
      });
      $track.on('touchend', function (e) {
        if (!isDragging) { return; }
        isDragging = false;
        var endX = e.originalEvent.changedTouches[0].clientX;
        var diff = startX - endX;
        if (Math.abs(diff) > 50) {
          if (diff > 0) { goTo(currentIndex + 1); }
          else { goTo(currentIndex - 1); }
        }
      });
    });

    /* ----- Smooth scroll for anchor links ----- */
    $('a[href^="#"]').on('click', function (e) {
      var target = $(this.getAttribute('href'));
      if (target.length) {
        e.preventDefault();
        $('html, body').animate({ scrollTop: target.offset().top - 80 }, 600);
      }
    });

    /* ----- Interactive Solutions Explorer ----- */
    $('.codenatives-service-nav-item').on('mouseenter click', function () {
      var serviceId = $(this).data('service');
      $('.codenatives-service-nav-item').removeClass('active');
      $(this).addClass('active');
      $('.codenatives-service-explore-card').removeClass('highlighted');
      $('.codenatives-service-explore-card[data-service="' + serviceId + '"]').addClass('highlighted');
    });

    $('.codenatives-service-explore-card').on('mouseenter', function () {
      var serviceId = $(this).data('service');
      $('.codenatives-service-nav-item').removeClass('active');
      $('.codenatives-service-nav-item[data-service="' + serviceId + '"]').addClass('active');
      $('.codenatives-service-explore-card').removeClass('highlighted');
      $(this).addClass('highlighted');
    });

    /* ----- Pill Nav Filter ----- */
    $('.codenatives-pill-nav button').on('click', function () {
      var filter = $(this).data('filter');
      $('.codenatives-pill-nav button').removeClass('active');
      $(this).addClass('active');

      if (filter === 'all') {
        $('[data-category]').show();
      } else {
        $('[data-category]').hide();
        $('[data-category="' + filter + '"]').show();
      }
    });

  });

})(jQuery);

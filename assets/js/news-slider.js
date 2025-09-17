(function(){
  document.addEventListener('DOMContentLoaded', function () {
    const sliders = document.querySelectorAll('.news-slider.splide');

    sliders.forEach(function (el) {
      if (el.dataset.splideInitialized) return;

      const opts = {
        type: 'loop',
        perPage: 1,
        perMove: 1,
        autoplay: true,
        interval: 4000,
        pauseOnHover: true,
        pagination: true,
        arrows: true,
        gap: '1rem',
        lazyLoad: true
      };

      if ( typeof Splide !== 'undefined' ) {
        const splide = new Splide(el, opts);
        splide.mount();
        el.dataset.splideInitialized = '1';
      }
    });
  });
})();

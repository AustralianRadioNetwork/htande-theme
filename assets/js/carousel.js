(function($) {
  class SlickCarousel {
    constructor() {
      this.initiateCarousel();
    }

    initiateCarousel() {
      const $slider = $('.gallery-carousel').slick({
        autoplay: true,
        autoplaySpeed: 2000,
        variableWidth: true,
      });
      $slider.find('.slick-slide').on('click', () => {
        $slider.slick('slickNext');
      });
    }
  }
  new SlickCarousel();
})(jQuery)


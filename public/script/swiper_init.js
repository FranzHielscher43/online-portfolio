document.addEventListener("DOMContentLoaded", function () {
  const swipers = document.querySelectorAll(".project_swiper");
  swipers.forEach((swiperEl) => {
    new Swiper(swiperEl, {
      loop: true,
      pagination: {
        el: swiperEl.querySelector(".swiper-pagination"),
        clickable: true,
      },
      navigation: {
        nextEl: swiperEl.querySelector(".swiper-button-next"),
        prevEl: swiperEl.querySelector(".swiper-button-prev"),
      },
      autoplay: {
        delay: 4000,
        disableOnInteraction: false,
      },
      spaceBetween: 20,
    });
  });
});

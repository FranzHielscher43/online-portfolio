document.addEventListener("DOMContentLoaded", () => {
  // Initialisiere jede Projekt-Swiper-Instanz einzeln
  document.querySelectorAll(".project-swiper").forEach((swiperEl) => {
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
      slidesPerView: 1,
      spaceBetween: 20,
    });
  });
});

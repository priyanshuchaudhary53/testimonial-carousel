var swiper_ts = new Swiper( '.ts_swiper_container', {
    // Optional parameters
    loop: true,
    hashNavigation: true,
    spaceBetween: 50,
    autoHeight: true,
    speed: 750,

    // If we need pagination
    pagination: {
        el: '.ts_swiper_pagination',
        clickable: true,
    },

    // Navigation arrows
    navigation: {
        nextEl: '.ts_swiper_button_next',
        prevEl: '.ts_swiper_button_prev',
    },
    autoplay: {
        disableOnInteraction: false,
    },
} );
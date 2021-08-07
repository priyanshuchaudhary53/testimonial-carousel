var swiper_ts = new Swiper( '.ts_swiper_container', {

    loop: true,
    hashNavigation: true,
    spaceBetween: 50,
    autoHeight: true,
    speed: 750,

    pagination: {
        el: '.ts_swiper_pagination',
        clickable: true,
    },

    navigation: {
        nextEl: '.ts_swiper_button_next',
        prevEl: '.ts_swiper_button_prev',
    },
    autoplay: {
        disableOnInteraction: false,
    },
} );

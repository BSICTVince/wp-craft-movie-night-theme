const swiper = new Swiper(".swiper", {
    // Optional parameters
    direction: "horizontal",
    loop: true,
    slidesPerView: 10,
    slidesPerGroup: 1,
    spaceBetween: 50,
    showArrows: true,
    showPagination: false,
    showScrollbar: false,
    // If we need pagination
    pagination: {
        el: ".swiper-pagination",
    },

    // Autoplay settings
    autoplay: {
        delay: 3000, // Delay between slides in milliseconds (3000ms = 3 seconds)
        disableOnInteraction: false, // Continue autoplay after user interaction
    },
    // Navigation arrows
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },

    // And if we need scrollbar
    scrollbar: {
        el: ".swiper-scrollbar",
    },
    // Breakpoints configuration
    breakpoints: {
        // When the screen width is 320px or more
        320: {
            slidesPerView: 4, // Show 1 slide per view
            spaceBetween: 10, // Set space between slides
            loop: true
        },
        // When the screen width is 768px or more
        768: {
            slidesPerView: 4, // Show 2 slides per view
            spaceBetween: 20, // Set space between slides
            loop: true
        },
        // When the screen width is 1024px or more
        1024: {
            slidesPerView: 4, // Show 4 slides per view
            spaceBetween: 50, // Set space between slides
            loop: true
        },
    }
});

const staticSwiper = new Swiper(".swiper-static", {
    // Optional parameters
    direction: "horizontal",
    loop: true,
    slidesPerView: 10,
    slidesPerGroup: 1,
    spaceBetween: 50,
    showArrows: true,
    showPagination: false,
    showScrollbar: false,
    // If we need pagination
    pagination: {
        el: ".swiper-pagination",
    },

    // Navigation arrows
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },

    // And if we need scrollbar
    scrollbar: {
        el: ".swiper-scrollbar",
    },
    // Breakpoints configuration
    breakpoints: {
        // When the screen width is 320px or more
        320: {
            slidesPerView: 4, // Show 1 slide per view
            spaceBetween: 10, // Set space between slides
            loop: true
        },
        // When the screen width is 768px or more
        768: {
            slidesPerView: 4, // Show 2 slides per view
            spaceBetween: 20, // Set space between slides
            loop: true
        },
        // When the screen width is 1024px or more
        1024: {
            slidesPerView: 4, // Show 4 slides per view
            spaceBetween: 50, // Set space between slides
            loop: true
        },
    }
});

// Hide arrows if showArrows is set to false
if (!swiper.params.showArrows) {
    document.querySelector(".swiper-button-next").style.display = "none";
    document.querySelector(".swiper-button-prev").style.display = "none";
}
//Hide pagaination if pagaination is set to false
if (!swiper.params.showPagination) {
    document.querySelector(".swiper-pagination").style.display = "none";
}

// Hide scrollbar if showScrollbar is set to false
if (!swiper.params.showScrollbar) {
    // Hide the scrollbar container
    document.querySelector(".swiper-scrollbar").style.display = "none";
    document.getElementsByClassName(".scroll-bar").style.display = "none";
}
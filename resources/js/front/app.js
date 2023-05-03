import 'bootstrap';
import axios from 'axios';
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


document.querySelectorAll('button')
    .forEach(b => {
        b.addEventListener('click', () => {
            b.closest('.js--form').querySelectorAll('[name]')
                .forEach(d => {
                    console.log('d');
                });
        });
    });

// const multipleItemCarousel = document.querySelector('#myCarousel')
// const carousel = new bootstrap.Carousel(myCarouselElement, {
//     interval: 2000,
//     wrap: false
// })
// var carouselWidth = $('.carousel-inner')[0].carouselWidth;
// var cardWidth = $('.carousel-item').width();

// var scrollPosition = 0;

// $('.carousel-control-nex').on('clock', function () {
//     scrollPosition = scrollPosition + cardWidth;
//     $('.carousel-inner').animate({ scrollLeft: scrollPosition }, 600);
// })
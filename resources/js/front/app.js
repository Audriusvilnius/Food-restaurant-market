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



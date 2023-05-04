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


setTimeout(function () {
    $(".alert").fadeTo(2000, 0).slideUp(2000, function () {
        $(this).remove();
    });
}, 10000);

mOver(function (n) {
    let appBannersT = document.getElementsByClassName(`appBannerT${n}`);
    let appBannersB = document.getElementsByClassName(`appBannerB${n}`);
    for (let i = 0; i < appBannersT.length; i++) {
        appBannersT[i].style.display = 'inline';
        appBannersB[i].style.display = 'none';
        appBannersT[i].style.transform = '250ms';
    }
});

mOut(function (n) {
    let appBannersT = document.getElementsByClassName(`appBannerT${n}`);
    let appBannersB = document.getElementsByClassName(`appBannerB${n}`);
    for (let i = 0; i < appBannersT.length; i++) {
        appBannersT[i].style.display = 'none';
        appBannersB[i].style.display = 'inline';
        appBannersT[i].style.transform = '250ms';
    }
});
function mOver(n) {
    let appBannersT = document.getElementsByClassName(`appBannerT${n}`);
    let appBannersB = document.getElementsByClassName(`appBannerB${n}`);
    for (let i = 0; i < appBannersT.length; i++) {
        appBannersT[i].style.display = 'inline';
        appBannersB[i].style.display = 'none';
        appBannersT[i].style.transform = '250ms';
    }
}

function mOut(n) {
    let appBannersT = document.getElementsByClassName(`appBannerT${n}`);
    let appBannersB = document.getElementsByClassName(`appBannerB${n}`);
    for (let i = 0; i < appBannersT.length; i++) {
        appBannersT[i].style.display = 'none';
        appBannersB[i].style.display = 'inline';
        appBannersT[i].style.transform = '250ms';
    }
}

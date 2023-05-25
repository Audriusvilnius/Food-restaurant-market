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
function Yeezy_en(x) {
    var data = x
    var info_en = ['milk','eggs','nuts','wheat','soybeans','fish'];
    var info_lt = ['pieno','kiaušinių','riešutų','kviečių','sojų','žuvis'];
    var digit = Math.floor(Math.random()* 6);
    document.getElementById("ModalTitle").innerHTML = x['title_en'];
    document.getElementById("photopop").innerHTML = "<img src=." + x['photo'] + " class=" + "img-fluid" + " >";
    document.getElementById("desc").innerHTML = x['des_en'];
    document.getElementById("a_ttl").innerHTML = 'Allergy advice !'
   document.getElementById("desc_a").innerHTML = 'Contains : ' +info_en[digit];
    document.getElementById("bttn").innerHTML = "Close"
}
function Yeezy_lt(x) {
    var data = x
    var info_en = ['milk','eggs','nuts','wheat','soybeans','fish'];
    var info_lt = ['pieno','kiaušinių','riešutų','kviečių','sojų','žuvis'];
    var digit = Math.floor(Math.random()* 6);
    console.log(digit);
    document.getElementById("ModalTitle").innerHTML = x['title_lt'];
    document.getElementById("photopop").innerHTML = "<img src=." + x['photo'] + " class=" + "img-fluid" + " >";
    document.getElementById("desc").innerHTML = x['des_lt'];
    document.getElementById("a_ttl").innerHTML = 'Alerginė informacija !'
    document.getElementById("desc_a").innerHTML = 'Sudetyje yra : ' +info_lt[digit];
    document.getElementById("bttn").innerHTML = "Uždaryti"
}

function Yeezy_en_rest(x) {
    var data = x
    var info_en = ['milk','eggs','nuts','wheat','soybeans','fish'];
    var info_lt = ['pieno','kiaušinių','riešutų','kviečių','sojų','žuvis'];
    var digit = Math.floor(Math.random()* 6);
    document.getElementById("ModalTitle").innerHTML = x['title_en'];
    document.getElementById("photopop").innerHTML = "<img src=.." + x['photo'] + " class=" + "img-fluid" + " >";
    document.getElementById("desc").innerHTML = x['des_en'];
    document.getElementById("a_ttl").innerHTML = 'Allergy advice !'
    document.getElementById("desc_a").innerHTML = 'Contains : ' +info_en[digit];
    document.getElementById("bttn").innerHTML = "Close"
}
function Yeezy_lt_rest(x) {
    var data = x
    var info_en = ['milk','eggs','nuts','wheat','soybeans','fish'];
    var info_lt = ['pieno','kiaušinių','riešutų','kviečių','sojų','žuvis'];
    var digit = Math.floor(Math.random()* 6);
    document.getElementById("ModalTitle").innerHTML = x['title_lt'];
    document.getElementById("photopop").innerHTML = "<img src=.." + x['photo'] + " class=" + "img-fluid" + " >";
    document.getElementById("desc").innerHTML = x['des_lt'];
    document.getElementById("a_ttl").innerHTML = 'Alerginė informacija !'
    document.getElementById("desc_a").innerHTML = 'Sudetyje yra : ' +info_lt[digit];
    document.getElementById("bttn").innerHTML = "Uždaryti"
}

setTimeout(function () {
    $(".alert").fadeTo(3000, 0).slideUp(3000, function () {
        $(this).remove();
    });
}, 9000);   
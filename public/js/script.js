

var successAnimation = bodymovin.loadAnimation({
    container: document.getElementById('successAnime'),
    renderer:'svg',
    loop: 3,
    autoplay: true,
    path: 'js/success.json'
})
var LaravelsuccessAnimation = bodymovin.loadAnimation({
    container: document.getElementById('LaravelsuccessAnime'),
    renderer:'svg',
    loop: 1,
    autoplay: true,
    path: 'js/success.json'
})

var errorAnimation = bodymovin.loadAnimation({
    container: document.getElementById('errorAnime'),
    renderer:'svg',
    loop: 3,
    autoplay: true,
    path: 'js/error.json'
})
var LaravelerrorAnimation = bodymovin.loadAnimation({
    container: document.getElementById('LaravelerrorAnime'),
    renderer:'svg',
    loop: 1,
    autoplay: true,
    path: 'js/error.json'
})

var loginAnimation = bodymovin.loadAnimation({
    container: document.getElementById('loginAnime'),
    renderer:'svg',
    loop: false,
    autoplay: true,
    path: 'js/SAMO.json'
})
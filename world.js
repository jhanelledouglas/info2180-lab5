var searchBtn2;
var searchInput;
var searchBtn;
var resultss;
var phpFile = "world.php";
var getCountry = "?country=";
var getContext = "&context=";


window.onload = function() {
    searchInput = document.getElementById("country");
    searchBtn = document.getElementById("lookup");
    searchBtn2 = document.getElementById("lookup2");
    searchBtn.addEventListener("click", searchBtnHandler);
    searchBtn2.addEventListener("click", searchBtnCHandler);
    resultss = document.getElementById("result");
}

function searchBtnHandler(e) {
    e.preventDefault();
    let url = createURL("cities");
    fetcher(url);
}

function searchBtnCHandler(e) {
    e.preventDefault();
    let url = createURL("countries");
    fetcher(url);
}


function createURL(contxt) {
    let country = getCountry + searchInput.value.trim();
    let context = getContext + contxt;
    let url = phpFile + country + context;
    return url;
}

function fetcher(url) {
    fetch(url).then(response => response.text()).then(data => resultss.innerHTML = data);
}
var searchBtn2;
var searchInput;
var searchBtn;
var resultss;

window.onload = function() {
    searchInput = document.getElementById("country");
    searchBtn = document.getElementById("lookup");
    searchBtn2 = document.getElementById("lookup2");
    searchBtn.addEventListener("click", searchBtnHandler);
    searchBtn2.addEventListener("click", searchBtnCHandler);
    resultss = document.getElementById("result");
}

function searchBtnCHandler(e) {
    e.preventDefault();
    let searchValue = "cities" + searchInput.value.trim();
    fetch("world.php", {
            method: 'POST',
            body: searchValue,
            headers: {
                'Content-Type': 'text/plain'
            }
        })
        .then(response => response.text())
        .then(data => resultss.innerHTML = data);
}

function searchBtnHandler(e) {
    e.preventDefault();
    fetch("world.php", {
            method: 'POST',
            body: searchInput.value.trim(),
            headers: {
                'Content-Type': 'text/plain'
            }
        })
        .then(response => response.text())
        .then(data => resultss.innerHTML = data);
}
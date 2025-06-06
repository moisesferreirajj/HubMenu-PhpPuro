function openNav() {
    document.getElementById("sidebar").classList.add("openNav");
    document.getElementById("open-btn").style.display = "none";
    document.getElementById("address").style.display = "block";
}

function closeNav() {
    document.getElementById("sidebar").classList.remove("openNav");
    document.getElementById("open-btn").style.display = "block";
    document.getElementById("address").style.display = "none";
}
function openNav(){
    document.getElementById("sidebar").style.width = "250px";
    document.getElementById("content").style.marginLeft ="250px";
    document.getElementById("open-btn").style.display = "none";
}

function closeNav(){
    document.getElementById("sidebar").style.width = "0";
    document.getElementById("content").style.marginLeft ="0";
    document.getElementById("open-btn").style.display = "block";

}
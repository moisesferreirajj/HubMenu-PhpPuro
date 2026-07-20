function openNav() {
    const sidebar = document.getElementById("sidebar");
    if (sidebar) {
        sidebar.classList.add("openNav");
    }
}

function closeNav() {
    const sidebar = document.getElementById("sidebar");
    if (sidebar) {
        sidebar.classList.remove("openNav");
    }
}
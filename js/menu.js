const menu = document.querySelector(".ver-navbar");
const button = document.querySelector("#menuOpen");

function toggleMenu(){
    if(menu.classList.contains("showMenu")){
        menu.classList.remove("showMenu");
    }
    else{
        menu.classList.add("showMenu");
    }
}

button.addEventListener("click", toggleMenu);
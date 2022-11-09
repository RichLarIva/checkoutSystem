const swishBtn = document.getElementById('swish');
const cashBtn = document.getElementById('cash');
const cashGet = document.getElementById('cashGet')

document.addEventListener('keyup', (e) =>{
    if(e.key == 's'){
        swishBtn.checked = true;
        cashGet.disabled = true;
    }
    else if(e.key == 'c'){
        cashBtn.checked = true;
        cashGet.disabled = false;
    }
})
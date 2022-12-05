let menu = document.getElementById('menu-target');



menu.addEventListener('click',function(){
    let div = document.getElementById('menu')
    if(div.classList.contains("hidden")){
        div.classList.remove('hidden')
        div.classList.add('block')
    }else{
        div.classList.remove('block')
        div.classList.add('hidden')
    }
});
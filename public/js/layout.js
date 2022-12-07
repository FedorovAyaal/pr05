let menu = document.getElementById('menu-target');
let btnSearch = document.getElementById('searchBtn');
let searchBar = document.getElementById('search-bar');
let menuLinks = document.getElementById('menu-links');
let searchForm = document.getElementById('searchForm');
btnSearch.addEventListener('click',function(){
    if(menuLinks.style.display == 'block'){
        menuLinks.style.display = 'none';
        searchBar.style.display = 'block'
    }else{
        
        menuLinks.style.display = 'block';
        searchBar.style.display = 'none'
    }
})
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
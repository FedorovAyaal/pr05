let menu = document.getElementById('menu-target');
let btnSearch = document.getElementById('searchBtn');
let searchBar = document.getElementById('search-bar');
let menuLinks = document.getElementById('menu-links');
let searchForm = document.getElementById('searchForm');

let btnMenuToggle = document.getElementById('btnDropdownMenu');
let dropdownMenu = document.getElementById('dropdownMenu');

let ok_mcb = document.getElementById('message-comment-btn');

let m_modal = document.getElementById('message-modal');

let message_pop = document.getElementById('message_pop');


function message(message){
    m_modal.style.display = "block";
    message_pop.innerText = message;
    ok_mcb.onclick = function(){
        m_modal.style.display = "none";
    }
}

if (typeof(btnSearch) != 'undefined' && btnSearch != null)
{
    btnSearch.addEventListener('click',function(){

        if(dropdownMenu.classList.contains('hidden')){
            dropdownMenu.classList.remove('hidden');
        }else{
            dropdownMenu.classList.add('hidden');
        }
        
    });
}

btnMenuToggle.addEventListener('click',function(){
    if(menuLinks.classList.contains('hidden')){
        menuLinks.classList.remove('hidden');

        searchBar.classList.add('hidden')
    }else{
        
        menuLinks.classList.add('hidden');
        searchBar.classList.remove('hidden')
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

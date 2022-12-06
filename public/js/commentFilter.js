let banwordList = ['nigger','pidor','блять','похуй','сосок']
let btn = document.getElementById('sendComment')
let msg = document.getElementById('message');
let form = document.getElementById('commentForm');
function findWord(word, str) {
    return str.toLowerCase().split(/[\s,.]+/).some(function(w){return w === word})

  }
btn.addEventListener('click',function(){
    let isFounded = false;
    banwordList.forEach(element => {
        if(findWord(element,msg.value)){
            isFounded = true;
        }
    });
    if(isFounded){
        alert("Ваш комментарий не был опубликован из-за употребления запрещенных слов ")
    }else{
        form.submit();
    }
    
})
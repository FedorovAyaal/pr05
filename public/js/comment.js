let modal = document.getElementById("my-modal");

let openm = document.getElementById("deletePostBtn");


let cancel = document.getElementById('cancel-btn');

let modalComment = document.getElementById("update-comment-modal");

let cancelComment = document.getElementById('cancel-comment-btn');

let cmMsg = document.getElementById('comment_message');

let ucb = document.getElementById('update-comment-btn');

let ucf = document.getElementById('updateCommentForm');

openm.addEventListener('click',function(){
    modal.style.display = "block"
    cancel.onclick = function(){
        modal.style.display = "none"
    }
})
function edit(comment){
    modalComment.style.display = "block";
    var div = document.createElement('div')
    div.innerHTML = comment['text']
    cmMsg.innerHTML = div.innerText;
    ucf.action = "http://127.0.0.1:8000/update/comment/" + String(comment['id'])
    
    cancelComment.onclick = function (){
        modalComment.style.display = "none";
    }
}



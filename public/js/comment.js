//Delete bindings
let modal = document.getElementById("my-modal");

let openm = document.getElementById("deletePostBtn");


let cancel = document.getElementById('cancel-btn');
//Comment bindings
let modalComment = document.getElementById("update-comment-modal");

let cancelComment = document.getElementById('cancel-comment-btn');

let cmMsg = document.getElementById('comment_message');

let ucb = document.getElementById('update-comment-btn');

let ucf = document.getElementById('updateCommentForm');
//Report bindings
let rcb = document.getElementById('report-comment-btn');

let rcm = document.getElementById('report-comment-modal');

let rcf = document.getElementById('reportCommentForm');

let cancelReport = document.getElementById('cancel-report-btn');
//Message bindings
let ok_mcb = document.getElementById('message-comment-btn');

let m_modal = document.getElementById('message-modal');

let message_pop = document.getElementById('message_pop');

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

function report(comment){
    rcm.style.display = "block";
    url_path = "http://127.0.0.1:8000/create/report/" + String(comment['id'])
    rn_id = document.getElementById('reasons');

    rcb.onclick = function(){
        rcm.style.display = "none";
        async function set(){
            let response = await fetch(url_path,{
                method:"POST",
                headers:{
                    'Content-Type':'application/json;charset=utf-8',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body:JSON.stringify({'reason_id':rn_id.value})
            });
    
            let r = await response.json();
        }
        set()
        message("Ваша жалоба будет рассмотрена модераторами")

    }

    cancelReport.onclick = function (){
        rcm.style.display = "none";
    }
}
function message(message){
    m_modal.style.display = "block";
    message_pop.innerText = message;
    ok_mcb.onclick = function(){
        m_modal.style.display = "none";
    }
}


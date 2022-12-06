let modal = document.getElementById("my-modal");

let openm = document.getElementById("open-btn");

let ok = document.getElementById("ok-btn");
let cancel = document.getElementById('cancel-btn');
function destroy(form){
    modal.style.display = "block"
    ok.onclick = function(){
        alert(form.id)
        modal.style.display = "none"
        return true;
    }
    cancel.onclick = function(){
        modal.style.display = "none"
    }
}
function edit(id){
    alert("Edit: " + id)
}



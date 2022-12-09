//password bindings

let btnPassword = document.getElementById('change_password_btn');
let current_password = document.getElementById('current_password');
let confirm_new_password = document.getElementById('confirm_new_password');
let new_password = document.getElementById('new_password');

btnPassword.addEventListener('click',function(){
    async function set(){
        const url = "http://127.0.0.1:8000/profile/change/password"
        let response = await fetch(url,{
            method:"POST",
            headers:{
                'Content-Type':'application/json;charset=utf-8',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body:JSON.stringify({'current_password':current_password.value,'new_password':new_password.value,'confirm_new_password':confirm_new_password.value})
        });
        let r = await response.json();
        if(r['errors']){
            message(r['errors'])
        }else{
            message(r['response'])
        }

    }
    set()
})
function onFileSelected(event) {
    var selectedFile = event.target.files[0];
    var reader = new FileReader();
  
    var imgtag = document.getElementById("myimage");
    imgtag.title = selectedFile.name;
  
    reader.onload = function(event) {
      imgtag.src = event.target.result;
    };
  
    reader.readAsDataURL(selectedFile);
  }
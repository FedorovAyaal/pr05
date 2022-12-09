let banBtn = document.getElementById('banBtn');
function ban_user(id){
    async function set(){
        url_path = "http://127.0.0.1:8000/ban/user/" + String(id)
        let response = await fetch(url_path,{
            method:"POST",
            headers:{
                'Content-Type':'application/json;charset=utf-8',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body:JSON.stringify({'user':id})
        });

        let r = await response.json();
        return r['response'];
    }
    set();
    message("Пользователь был забанен");
}
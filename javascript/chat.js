const form = document.querySelector(".typing-area");
const sendBtn = form.querySelector("button");
const inputField = form.querySelector(".input-field");


form.onsubmit = (e)=>{
    e.preventDefault();
}

sendBtn.onclick = ()=>{ 
    
    let xhr = new XMLHttpRequest();
    xhr.open("POST","include/chat.inc.php",true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
              
            }
        }

    }
    let formData = new FormData(form);
    xhr.send(formData);
}
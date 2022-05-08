const form = document.querySelector(".signup form");
continueBtn =form.querySelector(".button  input");
errorMsg = form.querySelector(".error-msg");

form.onsubmit = (e)=>{
    e.preventDefault();
}

continueBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST","include/signup.inc.php",true);
    xhr.onload = ()=>{

        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                console.log(data);
                if(data == "success"){

                    location.href = "users.php";
                   
                }else{
                    errorMsg.textContent = data;
                    errorMsg.style.display = "block";  
                }
            }
        }

    }
    let formData = new FormData(form);
    xhr.send(formData);
}


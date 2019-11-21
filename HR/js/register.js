var login = document.getElementById("login");
var login_err = document.getElementsByClassName("help-block-login")[0];

var domein = "";
login.oninput = function () {
    
    if(login.value.indexOf("@") === -1){
        login_err.innerHTML = 'Um sich zu registrieren, geben Sie die Mail ein!';
    }
    else{
        domein = login.value.split("@");
        if(domein[1] !=="global17.com"  ){
        
            console.log(domein);
            if(domein[1] !="hhm.ch"){
                login_err.innerHTML = "Ungültiger Domainname!";
            }
            else{
                login_err.innerHTML = '';
            }
        }
        else{
            login_err.innerHTML = '';
        }
    }
    
}

var deleteButton = document.getElementsByClassName("deleteClientButton");
deleteButton.onclick=function(){
   Confirm();
}

function Confirm(){
    if(confirm("Do you want to delete client?")){
        alert('Confirm');
    }
    else{
        alert('Not Confirm');
    }
    
}

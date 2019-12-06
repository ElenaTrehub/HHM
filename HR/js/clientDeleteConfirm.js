
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
function DeleteClient(btn){
    
    $("#idDeleteClient")[0].value = btn.dataset.id;
   
    $("#bucketModalDelete").modal('show');
}

var deleteButton = document.getElementsByClassName("deleteProjectButton");
deleteButton.onclick=function(){
   Confirm();
}

function Confirm(){
    if(confirm("Do you want to delete project?")){
        alert('Confirm');
    }
    else{
        alert('Not Confirm');
    }
    
}

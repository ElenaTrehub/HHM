var deleteButton = document.getElementsByClassName("deleteTaskButton");
deleteButton.onclick=function(){
   Confirm();
}

function Confirm(){
    if(confirm("Do you want to delete task?")){
        alert('Confirm');
    }
    else{
        alert('Not Confirm');
    }
    
}
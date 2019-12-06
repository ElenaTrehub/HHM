//console.log("Page can see!!!!");





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









$("#errorField").show('slow');
setTimeout(function() { $("#errorField").hide('slow'); }, 10000);

$("#errorTaskField").show('slow');
setTimeout(function() { $("#errorTaskField").hide('slow'); }, 10000);

var empInProjArray = [];
var listEmpInProject = document.getElementsByClassName("exist-emp-proj");

if(listEmpInProject.length >0){
    for (let i = 0; i < listEmpInProject.length; i++) {

//console.log(listEmpInProject.length);

        var input = listEmpInProject[i].firstElementChild.firstElementChild;
        var info = input.value;
        //console.log(info);
        empInProjArray.push(info);
    }
}


$("#AddEmpButton").click(function () {
    var listEmp = document.getElementsByClassName("btn btn-danger");
    var empCounter = listEmp.length-1;
    empCounter++;
    //console.log(childCounter);

    var template_emp = $("#empInProjectTemplate").clone();
    console.log(template_emp);
    template_emp[0].classList.remove("collapse");

    var input = template_emp.find("input");
    
    var empInfo = $("#empInProjectInput")[0].value;
    console.log(empInProjArray);
    if( empInProjArray.indexOf(empInfo) == -1){
        if(empInfo!=""){
            console.log(input);
            input[0].setAttribute("name", input[0].name.substring(0, input[0].name.lastIndexOf('_')+1) + empCounter+"]");
            input[0].value = empInfo;
            empInProjArray.push(empInfo);
           
            $("#empInProjectPlaceholder").append(template_emp);
            
        }
     
    }
    else{
        console.log("EXSIST!!!");
        alert("Dieser Mitarbeiter ist bereits in Ihrem Projekt vorhanden.");
        
    }
    $("#empInProjectInput")[0].value = "";
    
});
function DeleteEmployeeFro(btn) {
    console.log($(btn).closest(".add-employee-project").remove());

}
function DeleteTask(btn){
    $(btn).closest(".task-info").remove();
    /* $("#idTaskInput")[0].value = btn.dataset.id;
   
    $("#taskModalDelete").modal('show');*/
} 
function DeleteEmployeeFromTask(btn){
    //var emp = btn.dataset.employee.trim();
    /* if(!btn.dataset.employee){ */
    $(btn).closest(".add-employee-project").remove();
    var newInput = document.createElement("div");
                            
    newInput.innerHTML = "<input type='hidden' name=taskInProj[Employee_"+ btn.dataset.counter + "] value='-'>";
                            
    $("#Employee_"+btn.dataset.counter).append(newInput);
    console.log("!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!");
    /* }
    else{
        console.log(btn.dataset.id);
        console.log(btn.dataset.employee);
        $("#idTaskEmployeeInput")[0].value = btn.dataset.id;
        $("#idEmployeeTaskInput")[0].value = btn.dataset.employee;
    
        $("#empFromTaskModalDelete").modal('show');
    } */
    
}

function addEmployeeToTask(emp_block){
   
    var drop_block = emp_block.cloneNode(true);
    
    $("#empInProjectPlaceholder").append(drop_block);
    drop_block.classList.add("abs");
    //drop_block.event = null;
    //console.log(drop_block.event);
    drop_block.style.top = emp_block.top + "px";
    drop_block.style.left = (emp_block.offsetLeft-15) + "px";
    /* Определяем тип браузера */
    var ie = 0;
    var op = 0;
    var ff = 0;
    var browser = navigator.userAgent;
    if (browser.indexOf("Opera") != -1) op = 1;
    else {
        if (browser.indexOf("MSIE") != -1) ie = 1;
        else {
        if (browser.indexOf("Firefox") != -1) ff = 1;
        }
    }

    /* Получаем текущие координаты курсора */
    
    x = window.event.pageX;
    y = window.event.pageY;
        
    if (ie) {
        y -= 2;
        x -= 2;
    }
  
      /* Узнаём текущие координаты блока */
      x_block = drop_block.offsetLeft;
      y_block = drop_block.offsetTop;
      /* Узнаём смещение */
      delta_x = x_block - x;
      delta_y = y_block - y;
      /* При движении курсора устанавливаем вызов функции moveWindow */
      document.onmousemove = moveBlock;
      if (op || ff)
        document.addEventListener("onmousemove", moveBlock, false);
    document.onmouseup = clearXY;



    function moveBlock(obj_event) {
        /* Получаем новые координаты курсора мыши */
        if (obj_event) {
            x = obj_event.pageX;
            y = obj_event.pageY;
         }
        else {
            x = window.event.offsetLeft;
            y = window.event.offsetTop;
            if (ie) {
            y -= 2;
            x -= 2;
            }
        }
        /* Вычисляем новые координаты блока */
        new_x = delta_x + x;
        new_y = delta_y + y;
        drop_block.style.top = new_y + "px";
        drop_block.style.left = new_x + "px";
    }
    function clearXY() {
        

        var listTask = document.getElementsByClassName("task-info");

        if(listTask.length >0){
            for (let i = 0; i < listTask.length; i++) {
                

                if(drop_block.getBoundingClientRect().left > listTask[i].getBoundingClientRect().left && drop_block.getBoundingClientRect().left < (listTask[i].getBoundingClientRect().left + listTask[i].offsetWidth)
                    && drop_block.getBoundingClientRect().top > listTask[i].getBoundingClientRect().top && drop_block.getBoundingClientRect().top < (listTask[i].getBoundingClientRect().top + listTask[i].offsetHeight)
                    ){
                        if(listTask[i].getElementsByClassName("add-employee-project").length != 0){
                            alert("Diese Aufgabe hat bereits einen Executor.");
                            
                            drop_block.remove();
                            document.onmouseup = null;
                            document.onmousemove = null; // При отпускании мыши убираем обработку события движения мыши
                            
                        }
                        else{
                            drop_block.firstElementChild.firstElementChild.setAttribute("name", "taskInProj[Employee_"+ (i+1) +"]");
                            listTask[i].appendChild(drop_block);
                            drop_block.classList.remove("abs");
                            drop_block.onmousedown = null;
                            var btn = listTask[i].getElementsByClassName("btn-danger")[1];
                            $(btn).remove();
                            var newButton = document.createElement("div");
                            
                            newButton.innerHTML = "<button id='btnEmpFromTaskRemove' class='btn btn-danger' type='button' onclick='DeleteEmployeeFromTask(this)'  style='margin-top:4px; margin-right:5px; width: 30px; height: 30px; line-height:10px; font-size: 12px; padding: 0; border-radius: 15px; float:right'>&#10006</button>";
                            
                            drop_block.appendChild(newButton);
                            document.onmouseup = null;
                            document.onmousemove = null; // При отпускании мыши убираем обработку события движения мыши
                            
                        }
                        

                }
            }
        }



    }
















    
    
}
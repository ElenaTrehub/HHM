main();

function main(){
  
      initializeCalendar();

}

//Initializing methods
function initializeCalendar(){
      var day = document.getElementsByClassName('project-cal-day');
      var dayArray = Array.from(day);

      dayArray.forEach(element => {
           if (element.dataset.date == 0) {
                  element.style.display = "none";
            }
      
            if (element.dataset.weekday != 6 || element.dataset.weekday != 7) {
                  element.classList.add = "cal-day-week";
                  //element.className = "calendar-day-weekend-vacation";
            }
      
            if (element.dataset.weekday == "6" || element.dataset.weekday == "7") {
                  element.classList.add = "cal-day-weekend";
                  //element.className = "calendar-day-weekend-vacation";
            }
         
            
      
            if (element.dataset.holiday != "false"){
                  //element.className = "calendar-day-weekend";
            }


            
      
      });
      
      var task = document.getElementsByClassName('task');
      var taskArray = Array.from(task);
    
      var project_calendar = document.getElementsByClassName('project-calendar');
      var proj_calendarArray = Array.from(project_calendar);

      var project_calendar_empty = document.getElementsByClassName('project-calendar-empty');
      var proj_calendar_emptyArray = Array.from(project_calendar_empty);

      taskArray.forEach(element => {

            const startDay = element.dataset.start;
            const endDay = element.dataset.end;
            let left = 0;
            let width = 0; 

            const startBlock = dayArray.find(day => day.dataset.today == startDay);
            left = startBlock.offsetLeft;

            const endBlock = dayArray.find(day => day.dataset.today == endDay);
           
            width = endBlock.offsetLeft + endBlock.offsetWidth - left;
            //height = 40;

            var topPos = 0;
            const topBlock = proj_calendar_emptyArray.find(proj => (proj.dataset.id == element.dataset.id && proj.dataset.emptytaskid==element.dataset.task));
            //console.log(element);
            
            if(typeof topBlock != 'undefined'){
                  topPos = topBlock.offsetTop;
            }
            else{
                  const topBlock2 = proj_calendarArray.find(proj => proj.dataset.id == element.dataset.id);
                  //console.log(topBlock2);
                  topPos = topBlock2.offsetTop;
                 
                  
            }
            
            
            
            element.style.left = `${left}px`;
            element.style.width = `${width}px`;
            element.style.top = `${topPos}px`;
            
      });     
}

function ResizeRightTask(btn){

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

    block = btn; // Получаем основной блок
    block_r = btn.parentElement.parentElement; // Получаем блок для изменения размеров

    w_block = block_r.clientWidth; // Текущая ширина блока
    
    var calendar_year = document.getElementsByClassName('row-for-resize')[0];
    
    var x_elem = block_r.getBoundingClientRect().left + w_block;

   
    /* Ставим обработку движения мыши для разных браузеров */
    calendar_year.onmousemove = function(e){

      var x = e.clientX - x_elem;
      
      resizeRightBlock(w_block, x, block_r);

    }
    document.onmouseup = function(e){
      console.log("Up!!!!!!!");
      /* При отпускании кнопки мыши отключаем обработку движения курсора мыши */

      calendar_year.onmousemove = null;
      calendar_year.onmouseup = null;
    }
    if (op || ff) document.addEventListener("onmousemove", resizeBlock, false);
    
    return false; // Отключаем стандартную обработку нажатия мыши

}//ResizeRightTask

function ResizeLeftTask(btn){

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
  
      block = btn; // Получаем основной блок
      block_r = btn.parentElement.parentElement; // Получаем блок для изменения размеров
  
      w_block = block_r.clientWidth; // Текущая ширина блока
      
      var calendar_year = document.getElementsByClassName('row-for-resize')[0];
      
      var x_elem = block_r.getBoundingClientRect().left;
      var start_left = block_r.offsetLeft;
     
      /* Ставим обработку движения мыши для разных браузеров */
      calendar_year.onmousemove = function(e){
  
        var x = e.clientX - x_elem;
        
        resizeLeftsBlock(w_block, x, block_r, start_left);
  
      }
      document.onmouseup = function(e){
        //console.log("Up!!!!!!!");
        /* При отпускании кнопки мыши отключаем обработку движения курсора мыши */
  
        calendar_year.onmousemove = null;
        calendar_year.onmouseup = null;
      }
      if (op || ff) document.addEventListener("onmousemove", resizeBlock, false);
      
      return false; // Отключаем стандартную обработку нажатия мыши
  
  }//ResizeTask


function resizeRightBlock(w_block, x, block_r) {
      
      new_w = w_block + x; // Изменяем новое приращение по ширине
      block_r.style.width = new_w + "px"; // Устанавливаем новую ширину блока
      
}
function resizeLeftsBlock(w_block, x, block_r, start_left) {
      
      new_w = w_block - x; // Изменяем новое приращение по ширине
      block_r.style.width = new_w + "px"; // Устанавливаем новую ширину блока
      //console.log(block_r.style.left);
      //console.log(x);
      block_r.style.left = start_left + x + "px";
      //console.log(block_r.style.left);
}
/* Функция для измерения ширины окна */
function clientWidth() {
      return document.documentElement.clientWidth == 0 ? document.body.clientWidth : document.documentElement.clientWidth;
}
/* Функция для измерения высоты окна */
function clientHeight() {
      return document.documentElement.clientHeight == 0 ? document.body.clientHeight : document.documentElement.clientHeight;
}
function SaveTaskDate(id){
      var day = document.getElementsByClassName('project-cal-day');
      var dayArray = Array.from(day);
      //console.log(dayArray);
      var task = document.getElementsByClassName('task');
      var taskArray = Array.from(task);
  
      tasks = [];

      taskArray.forEach(element => {
//console.log(element);
            const startTaskCoord = element.offsetLeft;
            const endTaskCoord = element.offsetLeft + element.offsetWidth;
            //console.log(startTaskCoord);
            //console.log(endTaskCoord);
            const startTaskDay = dayArray.filter(day =>(day.offsetLeft <= startTaskCoord && ((startTaskCoord + day.offsetWidth) - (day.offsetLeft + day.offsetWidth)<day.offsetWidth)));
            //console.log(startTaskDay);
            let StartTaskDate = startTaskDay[0].dataset.today;
            
            //console.log(StartTaskDate);

            const endTaskDay = dayArray.filter(day => (day.offsetLeft >= (endTaskCoord-day.offsetWidth) && ((endTaskCoord + day.offsetWidth) - (day.offsetLeft + day.offsetWidth)<=day.offsetWidth)));
            //console.log(endTaskDay);
            let EndTaskDate = endTaskDay[0].dataset.today;
            
            const taskId = element.dataset.task;
            
            let task ={
                  taskId: taskId,
                  startDate: StartTaskDate,
                  endDate: EndTaskDate
            }
            tasks.push(task);
            
      }); 

       let content = JSON.stringify(tasks);
       let projectId = id;
       console.log(content);
  
      
          
      $('html').html("<form action='/HR/editTasksDate' name='tasksdateChange' method='post' style='display:none;'><input type='text' name='tasksList' value=" + content + " /><input type='text' name='projectId' value=" + projectId + " /></form>");
  
      document.forms['tasksdateChange'].submit();
          
      
    

}//SaveTaskDate

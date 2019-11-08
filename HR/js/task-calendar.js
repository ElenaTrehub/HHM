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
                  element.className = "cal-day-week";
                  //element.className = "calendar-day-weekend-vacation";
            }
      
            if (element.dataset.weekday == "6" || element.dataset.weekday == "7") {
                  element.className = "cal-day-weekend";
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
            console.log(topBlock);
            
            if(typeof topBlock != 'undefined'){
                  topPos = topBlock.offsetTop;
            }
            else{
                  const topBlock2 = proj_calendarArray.find(proj => proj.dataset.id == element.dataset.id);
                  topPos = topBlock2.offsetTop;
                  console.log(topBlock2);
                  
            }
            
            
            
            element.style.left = `${left}px`;
            element.style.width = `${width}px`;
            element.style.top = `${topPos}px`;
            
      });     
}


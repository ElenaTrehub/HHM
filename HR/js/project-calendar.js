// Global variables


main();

function main(){
  
      initializeCalendar();
      initializeProjects();
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
      
      var project = document.getElementsByClassName('proj');
      var projectArray = Array.from(project);
    
      var project_calendar = document.getElementsByClassName('project-calendar');
      var proj_calendarArray = Array.from(project_calendar);

      projectArray.forEach(element => {

            const startDay = element.dataset.start;
            const endDay = element.dataset.end;
            let left = 0;
            let width = 0; 

            const startBlock = dayArray.find(day => day.dataset.today == startDay);
            left = startBlock.offsetLeft;

            const endBlock = dayArray.find(day => day.dataset.today == endDay);
            width = endBlock.offsetLeft + endBlock.offsetWidth - left;
            //height = 40;

            const topBlock = proj_calendarArray.find(proj => proj.dataset.id == element.dataset.id);
            topPos = topBlock.offsetTop;
            console.log(topPos);

            //element.style.position = 'absolute';
            
            element.style.left = `${left}px`;
            element.style.width = `${width}px`;
            element.style.top = `${topPos}px`;
            //element.style.height = `${height}px`;

            //element.style.backgroundColor = '#124587';
            
            /* if (e.type == "load") {
                  el.style.backgroundColor = el.dataset.color;
                  el.style.opacity = 1;
            } */
      });     
}

function initializeProjects(){
      var project = document.getElementsByClassName('project');
      var projectArray = Array.from(project);

      projectArray.forEach(element => {





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
      
}
var checkboxes = $("input:checkbox").toArray();

$("#btn-select-employee").click(function () {

      checkboxes.forEach(element => {
            if (element.name.includes("Id")) {
                  if (element.checked == false) {
                        //element.checked = true;
                        element.click();
                  }
            }
      })
})

$("#btn-unselect-employee").click(function () {
      checkboxes.forEach(element => {
            if (element.name.includes("Id")) {
                  if (element.checked == true) {
                        element.click();
                        //element.checked = false;
                  }
            }
      })
})

$("#btn-select-categories").click(function(){
      
      checkboxes.forEach(element=>{
            if (!element.name.includes("Id")){
                  if (element.checked == false){
                        element.click();
                  }
            }
      })
});

$("#btn-unselect-categories").click(function(){
      
      checkboxes.forEach(element=>{
            if (!element.name.includes("Id")){
                  if (element.checked == true){
                        element.click();
                  }
            }
      })
});


checkboxes.forEach(element => {
      //console.log(element);
      if (element.name.includes("Id")) {
            element.addEventListener("change", updateList);
      }

      if (element.name.includes("PersonalData")) {
            element.addEventListener("change", updatePersonalData);
      }

      switch (element.name) {
            case "MailData":
                  element.addEventListener("change", updateMailData);
                  break;
            case "G17_mail":
                  element.addEventListener("change", updateG17_mailData);
                  break;
            case "G17_kurz":
                  element.addEventListener("change", updateG17_kurzData);
                  break;
            case "HHM_mail":
                  element.addEventListener("change", updateHHM_mailData);
                  break;

            case "HHM_kurz":
                  element.addEventListener("change", updateHHM_kurzData);
                  break;




            case "PersonalData":
                  element.addEventListener("change", updatePersonalData);
                  break;
            case "Geburtsdatum":
                  element.addEventListener("change", updateGeburtsdatumData);
                  break;
            case "Zivilstand":
                  element.addEventListener("change", updateZivilstandData);
                  break;
            case "Wohnadresse":
                  element.addEventListener("change", updateWohnadresseData);
                  break;

            case "PLZ":
                  element.addEventListener("change", updatePLZData);
                  break;
            case "Ort":
                  element.addEventListener("change", updateOrtData);
                  break;
            case "Telefon":
                  element.addEventListener("change", updateTelefonData);
                  break;





            case "Career":
                  element.addEventListener("change", updateCareer);
                  break;
            case "Eintrittsdatum":
                  element.addEventListener("change", updateEintrittsdatumData);
                  break;
            case "Kommentar1":
                  element.addEventListener("change", updateKommentar1Data);
                  break;
            case "Kommentar2":
                  element.addEventListener("change", updateKommentar2Data);
                  break;
            case "Kommentar3":
                  element.addEventListener("change", updateKommentar3Data);
                  break;
            case "Position":
                  element.addEventListener("change", updatePositionData);
                  break;
            case "Lohn":
                  element.addEventListener("change", updateLohnData);
                  break;
            case "Productive":
                  element.addEventListener("change", updateProductiveData);
                  break;
            case "OverTime":
                  element.addEventListener("change", updateOverTimeData);
                  break;
            case "W_End":
                  element.addEventListener("change", updateWEndData);
                  break;





            case "ForeignPassport":
                  element.addEventListener("change", updatePassportData);
                  break;
            case "PassName":
                  element.addEventListener("change", updatePassNameData);
                  break;
            case "PassVorname":
                  element.addEventListener("change", updatePassVornameData);
                  break;
            case "Passnummer":
                  element.addEventListener("change", updatePassnummerData);
                  break;
            case "Gültigkeit":
                  element.addEventListener("change", updateGültigkeitData);
                  break;




            case "Children":
                  element.addEventListener("change", updateChildrenData);
                  break;

            case "SwissVisit":
                  element.addEventListener("change", updateVisitData);
                  break;

            default:
                  break;
      }
});
function updateMailData() {
      if (this.checked) {
            ($(".col-md.print-mail")).removeClass("collapse");
      } else {
            $(".col-md.print-mail").addClass("collapse");
      }
}
function updateG17_mailData() {
      if (this.checked) {
            ($(".col-md.print-g17_mail")).removeClass("collapse");
      } else {
            $(".col-md.print-g17_mail").addClass("collapse");
      }
}
function updateG17_kurzData() {
      if (this.checked) {
            ($(".col-md.print-g17_kurz")).removeClass("collapse");
      } else {
            $(".col-md.print-g17_kurz").addClass("collapse");
      }
}
function updateHHM_mailData() {
      if (this.checked) {
            ($(".col-md.print-hhm_mail")).removeClass("collapse");
      } else {
            $(".col-md.print-hhm_mail").addClass("collapse");
      }
}
function updateHHM_kurzData() {
      if (this.checked) {
            ($(".col-md.print-hhm_kurz")).removeClass("collapse");
      } else {
            $(".col-md.print-hhm_kurz").addClass("collapse");
      }
}

var print_career = document.getElementsByClassName('print-career');
var print_pass = document.getElementsByClassName("print-pass");
var print_personal = document.getElementsByClassName("print-personal");




for(let i=0; i<print_personal.length; i++){
      if((print_pass[i].classList.contains("collapse")==false || print_career[i].classList.contains("collapse")==false) && print_personal[i].classList.contains("br")==false){
            print_personal[i].classList.add("br");
      }
      else
      if((print_pass[i].classList.contains("collapse")==true && print_career[i].classList.contains("collapse")==true) && print_personal[i].classList.contains("br")==true){
            print_personal[i].classList.remove("br");
      }
      if(print_pass[i].classList.contains("collapse")==false && print_career[i].classList.contains("br")==false){
            print_career[i].classList.add("br");
      }
      
      if(print_pass[i].classList.contains("collapse")==true){
            print_career[i].classList.remove("br");
      }
}

var print_children = document.getElementsByClassName("print-children");

for(let i=0; i<print_children.length; i++){
      
    
      if(print_pass[i].classList.contains("collapse")==false || print_career[i].classList.contains("collapse")==false || print_personal[i].classList.contains("collapse")==false){
            print_children[i].classList.add("bt");
      }
      if(print_pass[i].classList.contains("collapse")==true && print_career[i].classList.contains("collapse")==true && print_personal[i].classList.contains("collapse")==true){
            print_children[i].classList.remove("bt");
      }
      
}

var print_visit = document.getElementsByClassName("print-visit");

for(let i=0; i<print_visit.length; i++){
      
    
      if(print_pass[i].classList.contains("collapse")==false || print_career[i].classList.contains("collapse")==false || print_personal[i].classList.contains("collapse")==false || print_children[i].classList.contains("collapse")==false){
            print_visit[i].classList.add("bt");
      }
      if(print_pass[i].classList.contains("collapse")==true && print_career[i].classList.contains("collapse")==true && print_personal[i].classList.contains("collapse")==true && print_children[i].classList.contains("collapse")==true){
            print_visit[i].classList.remove("bt");
      }
      
}




function updatePersonalData() {
      if (this.checked) {
            ($(".col-md.print-personal")).removeClass("collapse");

            for(let i=0; i<print_personal.length; i++){
                  if((print_pass[i].classList.contains("collapse")==false || print_career[i].classList.contains("collapse")==false) && print_personal[i].classList.contains("br")==false){
                        print_personal[i].classList.add("br");
                  }
                  else
                  if((print_pass[i].classList.contains("collapse")==true && print_career[i].classList.contains("collapse")==true) && print_personal[i].classList.contains("br")==true){
                        print_personal[i].classList.remove("br");
                  }
                  if(print_pass[i].classList.contains("collapse")==false && print_career[i].classList.contains("br")==false){
                        print_career[i].classList.add("br");
                  }
                  
                  if(print_pass[i].classList.contains("collapse")==true){
                        print_career[i].classList.remove("br");
                  }
            }
            for(let i=0; i<print_children.length; i++){
      
    
                  if(print_pass[i].classList.contains("collapse")==false || print_career[i].classList.contains("collapse")==false || print_personal[i].classList.contains("collapse")==false){
                        print_children[i].classList.add("bt");
                  }
                  if(print_pass[i].classList.contains("collapse")==true && print_career[i].classList.contains("collapse")==true && print_personal[i].classList.contains("collapse")==true){
                        print_children[i].classList.remove("bt");
                  }
                  
            }
            for(let i=0; i<print_visit.length; i++){
      
    
                  if(print_pass[i].classList.contains("collapse")==false || print_career[i].classList.contains("collapse")==false || print_personal[i].classList.contains("collapse")==false || print_children[i].classList.contains("collapse")==false){
                        print_visit[i].classList.add("bt");
                  }
                  if(print_pass[i].classList.contains("collapse")==true && print_career[i].classList.contains("collapse")==true && print_personal[i].classList.contains("collapse")==true && print_children[i].classList.contains("collapse")==true){
                        print_visit[i].classList.remove("bt");
                  }
                  
            }
      } else {
            $(".col-md.print-personal").addClass("collapse");
            for(let i=0; i<print_personal.length; i++){
                  if((print_pass[i].classList.contains("collapse")==false || print_career[i].classList.contains("collapse")==false) && print_personal[i].classList.contains("br")==false){
                        print_personal[i].classList.add("br");
                  }
                  else
                  if((print_pass[i].classList.contains("collapse")==true && print_career[i].classList.contains("collapse")==true) && print_personal[i].classList.contains("br")==true){
                        print_personal[i].classList.remove("br");
                  }
                  if(print_pass[i].classList.contains("collapse")==false && print_career[i].classList.contains("br")==false){
                        print_career[i].classList.add("br");
                  }
                  
                  if(print_pass[i].classList.contains("collapse")==true){
                        print_career[i].classList.remove("br");
                  }
            }
            for(let i=0; i<print_children.length; i++){
      
    
                  if(print_pass[i].classList.contains("collapse")==false || print_career[i].classList.contains("collapse")==false || print_personal[i].classList.contains("collapse")==false){
                        print_children[i].classList.add("bt");
                  }
                  if(print_pass[i].classList.contains("collapse")==true && print_career[i].classList.contains("collapse")==true && print_personal[i].classList.contains("collapse")==true){
                        print_children[i].classList.remove("bt");
                  }
                  
            }
            for(let i=0; i<print_visit.length; i++){
      
    
                  if(print_pass[i].classList.contains("collapse")==false || print_career[i].classList.contains("collapse")==false || print_personal[i].classList.contains("collapse")==false || print_children[i].classList.contains("collapse")==false){
                        print_visit[i].classList.add("bt");
                  }
                  if(print_pass[i].classList.contains("collapse")==true && print_career[i].classList.contains("collapse")==true && print_personal[i].classList.contains("collapse")==true && print_children[i].classList.contains("collapse")==true){
                        print_visit[i].classList.remove("bt");
                  }
                  
            }
      }
}
function updateGeburtsdatumData() {
      if (this.checked) {
            ($(".col-md.print-geburtsdatum")).removeClass("collapse");
      } else {
            $(".col-md.print-geburtsdatum").addClass("collapse");
      }
}
function updateZivilstandData() {
      if (this.checked) {
            ($(".col-md.print-zivilstand")).removeClass("collapse");
      } else {
            $(".col-md.print-zivilstand").addClass("collapse");
      }
}
function updateWohnadresseData() {
      if (this.checked) {
            ($(".col-md.print-wohnadresse")).removeClass("collapse");
      } else {
            $(".col-md.print-wohnadresse").addClass("collapse");
      }
}
function updatePLZData() {
      if (this.checked) {
            ($(".col-md.print-PLZ")).removeClass("collapse");
      } else {
            $(".col-md.print-PLZ").addClass("collapse");
      }
}
function updateOrtData() {
      if (this.checked) {
            ($(".col-md.print-ort")).removeClass("collapse");
      } else {
            $(".col-md.print-ort").addClass("collapse");
      }
}
function updateTelefonData() {
      if (this.checked) {
            ($(".col-md.print-tell")).removeClass("collapse");
      } else {
            $(".col-md.print-tell").addClass("collapse");
      }
}







function updateCareer() {
      if (this.checked) {
            ($(".print-career")).removeClass("collapse");
            for(let i=0; i<print_personal.length; i++){
                  if((print_pass[i].classList.contains("collapse")==false || print_career[i].classList.contains("collapse")==false) && print_personal[i].classList.contains("br")==false){
                        print_personal[i].classList.add("br");
                  }
                  else
                  if((print_pass[i].classList.contains("collapse")==true && print_career[i].classList.contains("collapse")==true) && print_personal[i].classList.contains("br")==true){
                        print_personal[i].classList.remove("br");
                  }
                  if(print_pass[i].classList.contains("collapse")==false && print_career[i].classList.contains("br")==false){
                        print_career[i].classList.add("br");
                  }
                  
                  if(print_pass[i].classList.contains("collapse")==true){
                        print_career[i].classList.remove("br");
                  }
            }
            for(let i=0; i<print_children.length; i++){
      
    
                  if(print_pass[i].classList.contains("collapse")==false || print_career[i].classList.contains("collapse")==false || print_personal[i].classList.contains("collapse")==false){
                        print_children[i].classList.add("bt");
                  }
                  if(print_pass[i].classList.contains("collapse")==true && print_career[i].classList.contains("collapse")==true && print_personal[i].classList.contains("collapse")==true){
                        print_children[i].classList.remove("bt");
                  }
                  
            }
            for(let i=0; i<print_visit.length; i++){
      
    
                  if(print_pass[i].classList.contains("collapse")==false || print_career[i].classList.contains("collapse")==false || print_personal[i].classList.contains("collapse")==false || print_children[i].classList.contains("collapse")==false){
                        print_visit[i].classList.add("bt");
                  }
                  if(print_pass[i].classList.contains("collapse")==true && print_career[i].classList.contains("collapse")==true && print_personal[i].classList.contains("collapse")==true && print_children[i].classList.contains("collapse")==true){
                        print_visit[i].classList.remove("bt");
                  }
                  
            }
      } else {
            $(".print-career").addClass("collapse");
            for(let i=0; i<print_personal.length; i++){
                  if((print_pass[i].classList.contains("collapse")==false || print_career[i].classList.contains("collapse")==false) && print_personal[i].classList.contains("br")==false){
                        print_personal[i].classList.add("br");
                  }
                  else
                  if((print_pass[i].classList.contains("collapse")==true && print_career[i].classList.contains("collapse")==true) && print_personal[i].classList.contains("br")==true){
                        print_personal[i].classList.remove("br");
                  }
                  if(print_pass[i].classList.contains("collapse")==false && print_career[i].classList.contains("br")==false){
                        print_career[i].classList.add("br");
                  }
                  
                  if(print_pass[i].classList.contains("collapse")==true){
                        print_career[i].classList.remove("br");
                  }
            }
            for(let i=0; i<print_children.length; i++){
      
    
                  if(print_pass[i].classList.contains("collapse")==false || print_career[i].classList.contains("collapse")==false || print_personal[i].classList.contains("collapse")==false){
                        print_children[i].classList.add("bt");
                  }
                  if(print_pass[i].classList.contains("collapse")==true && print_career[i].classList.contains("collapse")==true && print_personal[i].classList.contains("collapse")==true){
                        print_children[i].classList.remove("bt");
                  }
                  
            }
            for(let i=0; i<print_visit.length; i++){
      
    
                  if(print_pass[i].classList.contains("collapse")==false || print_career[i].classList.contains("collapse")==false || print_personal[i].classList.contains("collapse")==false || print_children[i].classList.contains("collapse")==false){
                        print_visit[i].classList.add("bt");
                  }
                  if(print_pass[i].classList.contains("collapse")==true && print_career[i].classList.contains("collapse")==true && print_personal[i].classList.contains("collapse")==true && print_children[i].classList.contains("collapse")==true){
                        print_visit[i].classList.remove("bt");
                  }
                  
            }
      }
}
function updateEintrittsdatumData() {
      if (this.checked) {
            ($(".col-md.print-eintrittsdatum")).removeClass("collapse");
      } else {
            $(".col-md.print-eintrittsdatum").addClass("collapse");
      }
}
function updateKommentar1Data() {
      if (this.checked) {
            ($(".col-md.print-comment1")).removeClass("collapse");
      } else {
            $(".col-md.print-comment1").addClass("collapse");
      }
}
function updateKommentar2Data() {
      if (this.checked) {
            ($(".col-md.print-comment2")).removeClass("collapse");
      } else {
            $(".col-md.print-comment2").addClass("collapse");
      }
}
function updateKommentar3Data() {
      if (this.checked) {
            ($(".col-md.print-comment3")).removeClass("collapse");
      } else {
            $(".col-md.print-comment3").addClass("collapse");
      }
}
function updatePositionData() {
      if (this.checked) {
            ($(".col-md.print-position")).removeClass("collapse");
      } else {
            $(".col-md.print-position").addClass("collapse");
      }
}
function updateLohnData() {
      if (this.checked) {
            ($(".col-md.print-lohn")).removeClass("collapse");
      } else {
            $(".col-md.print-lohn").addClass("collapse");
      }
}
function updateProductiveData() {
      if (this.checked) {
            ($(".col-md.print-productive")).removeClass("collapse");
      } else {
            $(".col-md.print-productive").addClass("collapse");
      }
}
function updateOverTimeData() {
      if (this.checked) {
            ($(".col-md.print-over_time")).removeClass("collapse");
      } else {
            $(".col-md.print-over_time").addClass("collapse");
      }
}
function updateWEndData() {
      if (this.checked) {
            ($(".col-md.print-w_end")).removeClass("collapse");
      } else {
            $(".col-md.print-w_end").addClass("collapse");
      }
}







function updatePassportData() {
      if (this.checked) {
            ($(".print-pass")).removeClass("collapse");
            for(let i=0; i<print_personal.length; i++){
                  if((print_pass[i].classList.contains("collapse")==false || print_career[i].classList.contains("collapse")==false) && print_personal[i].classList.contains("br")==false){
                        print_personal[i].classList.add("br");
                  }
                  else
                  if((print_pass[i].classList.contains("collapse")==true && print_career[i].classList.contains("collapse")==true) && print_personal[i].classList.contains("br")==true){
                        print_personal[i].classList.remove("br");
                  }
                  if(print_pass[i].classList.contains("collapse")==false && print_career[i].classList.contains("br")==false){
                        print_career[i].classList.add("br");
                  }
                  
                  if(print_pass[i].classList.contains("collapse")==true){
                        print_career[i].classList.remove("br");
                  }
            }
            for(let i=0; i<print_children.length; i++){
      
    
                  if(print_pass[i].classList.contains("collapse")==false || print_career[i].classList.contains("collapse")==false || print_personal[i].classList.contains("collapse")==false){
                        print_children[i].classList.add("bt");
                  }
                  if(print_pass[i].classList.contains("collapse")==true && print_career[i].classList.contains("collapse")==true && print_personal[i].classList.contains("collapse")==true){
                        print_children[i].classList.remove("bt");
                  }
                  
            }
            for(let i=0; i<print_visit.length; i++){
      
    
                  if(print_pass[i].classList.contains("collapse")==false || print_career[i].classList.contains("collapse")==false || print_personal[i].classList.contains("collapse")==false || print_children[i].classList.contains("collapse")==false){
                        print_visit[i].classList.add("bt");
                  }
                  if(print_pass[i].classList.contains("collapse")==true && print_career[i].classList.contains("collapse")==true && print_personal[i].classList.contains("collapse")==true && print_children[i].classList.contains("collapse")==true){
                        print_visit[i].classList.remove("bt");
                  }
                  
            }
      } else {
            $(".print-pass").addClass("collapse");
            for(let i=0; i<print_personal.length; i++){
                  if((print_pass[i].classList.contains("collapse")==false || print_career[i].classList.contains("collapse")==false) && print_personal[i].classList.contains("br")==false){
                        print_personal[i].classList.add("br");
                  }
                  else
                  if((print_pass[i].classList.contains("collapse")==true && print_career[i].classList.contains("collapse")==true) && print_personal[i].classList.contains("br")==true){
                        print_personal[i].classList.remove("br");
                  }
                  if(print_pass[i].classList.contains("collapse")==false && print_career[i].classList.contains("br")==false){
                        print_career[i].classList.add("br");
                  }
                  
                  if(print_pass[i].classList.contains("collapse")==true){
                        print_career[i].classList.remove("br");
                  }
            }
            for(let i=0; i<print_children.length; i++){
      
    
                  if(print_pass[i].classList.contains("collapse")==false || print_career[i].classList.contains("collapse")==false || print_personal[i].classList.contains("collapse")==false){
                        print_children[i].classList.add("bt");
                  }
                  if(print_pass[i].classList.contains("collapse")==true && print_career[i].classList.contains("collapse")==true && print_personal[i].classList.contains("collapse")==true){
                        print_children[i].classList.remove("bt");
                  }
                  
            }
            for(let i=0; i<print_visit.length; i++){
      
    
                  if(print_pass[i].classList.contains("collapse")==false || print_career[i].classList.contains("collapse")==false || print_personal[i].classList.contains("collapse")==false || print_children[i].classList.contains("collapse")==false){
                        print_visit[i].classList.add("bt");
                  }
                  if(print_pass[i].classList.contains("collapse")==true && print_career[i].classList.contains("collapse")==true && print_personal[i].classList.contains("collapse")==true && print_children[i].classList.contains("collapse")==true){
                        print_visit[i].classList.remove("bt");
                  }
                  
            }
      }
}
function updatePassNameData() {
      if (this.checked) {
            ($(".col-md.print-pass_name")).removeClass("collapse");
      } else {
            $(".col-md.print-pass_name").addClass("collapse");
      }
}
function updatePassVornameData() {
      if (this.checked) {
            ($(".col-md.print-vorname")).removeClass("collapse");
      } else {
            $(".col-md.print-vorname").addClass("collapse");
      }
}
function updatePassnummerData() {
      if (this.checked) {
            ($(".col-md.print-pass_nummer")).removeClass("collapse");
      } else {
            $(".col-md.print-pass_nummer").addClass("collapse");
      }
}
function updateGültigkeitData() {
      if (this.checked) {
            ($(".col-md.print-gultig")).removeClass("collapse");
      } else {
            $(".col-md.print-gultig").addClass("collapse");
      }
}









function updateChildrenData() {
      if (this.checked) {
            ($(".print-children")).removeClass("collapse");
            for(let i=0; i<print_children.length; i++){
      
    
                  if(print_pass[i].classList.contains("collapse")==false || print_career[i].classList.contains("collapse")==false || print_personal[i].classList.contains("collapse")==false){
                        print_children[i].classList.add("bt");
                  }
                  if(print_pass[i].classList.contains("collapse")==true && print_career[i].classList.contains("collapse")==true && print_personal[i].classList.contains("collapse")==true){
                        print_children[i].classList.remove("bt");
                  }
                  
            }
            for(let i=0; i<print_visit.length; i++){
      
    
                  if(print_pass[i].classList.contains("collapse")==false || print_career[i].classList.contains("collapse")==false || print_personal[i].classList.contains("collapse")==false || print_children[i].classList.contains("collapse")==false){
                        print_visit[i].classList.add("bt");
                  }
                  if(print_pass[i].classList.contains("collapse")==true && print_career[i].classList.contains("collapse")==true && print_personal[i].classList.contains("collapse")==true && print_children[i].classList.contains("collapse")==true){
                        print_visit[i].classList.remove("bt");
                  }
                  
            }
      } else {
            $(".print-children").addClass("collapse");
            for(let i=0; i<print_children.length; i++){
      
    
                  if(print_pass[i].classList.contains("collapse")==false || print_career[i].classList.contains("collapse")==false || print_personal[i].classList.contains("collapse")==false){
                        print_children[i].classList.add("bt");
                  }
                  if(print_pass[i].classList.contains("collapse")==true && print_career[i].classList.contains("collapse")==true && print_personal[i].classList.contains("collapse")==true){
                        print_children[i].classList.remove("bt");
                  }
                  
            }
            for(let i=0; i<print_visit.length; i++){
      
    
                  if(print_pass[i].classList.contains("collapse")==false || print_career[i].classList.contains("collapse")==false || print_personal[i].classList.contains("collapse")==false || print_children[i].classList.contains("collapse")==false){
                        print_visit[i].classList.add("bt");
                  }
                  if(print_pass[i].classList.contains("collapse")==true && print_career[i].classList.contains("collapse")==true && print_personal[i].classList.contains("collapse")==true && print_children[i].classList.contains("collapse")==true){
                        print_visit[i].classList.remove("bt");
                  }
                  
            }
      }
}

function updateVisitData() {
      if (this.checked) {
            ($(".print-visit")).removeClass("collapse");
            for(let i=0; i<print_visit.length; i++){
      
    
                  if(print_pass[i].classList.contains("collapse")==false || print_career[i].classList.contains("collapse")==false || print_personal[i].classList.contains("collapse")==false || print_children[i].classList.contains("collapse")==false){
                        print_visit[i].classList.add("bt");
                  }
                  if(print_pass[i].classList.contains("collapse")==true && print_career[i].classList.contains("collapse")==true && print_personal[i].classList.contains("collapse")==true && print_children[i].classList.contains("collapse")==true){
                        print_visit[i].classList.remove("bt");
                  }
                  
            }
      } else {
            $(".print-visit").addClass("collapse");
            for(let i=0; i<print_visit.length; i++){
      
    
                  if(print_pass[i].classList.contains("collapse")==false || print_career[i].classList.contains("collapse")==false || print_personal[i].classList.contains("collapse")==false || print_children[i].classList.contains("collapse")==false){
                        print_visit[i].classList.add("bt");
                  }
                  if(print_pass[i].classList.contains("collapse")==true && print_career[i].classList.contains("collapse")==true && print_personal[i].classList.contains("collapse")==true && print_children[i].classList.contains("collapse")==true){
                        print_visit[i].classList.remove("bt");
                  }
                  
            }
      }
}



function updateList() {
      if (this.name.includes("Id") && !this.checked) {
            console.log($("#" + this.value + ".print-employee").addClass("collapse"));
      } else {
            $("#" + this.value + ".print-employee").removeClass("collapse");
      }

      /*
      if (this.name.includes("PersonalData") && !this.checked){
            console.log($(".print-personal")).addClass("collapse");
      }
      else{
            $(".print-personal").removeClass("collapse");
      }

      if (this.name.includes("Career") && this.checked){
            console.log($(".print-career")).addClass("collapse");
      }
      else{
            $(".print-career").removeClass("collapse");
      }*/
}
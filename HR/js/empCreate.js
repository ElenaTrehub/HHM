var upload = document.getElementById("imageUpload");
var uploadPassport = document.getElementById("passportUpload");
var uploadDiplom = document.getElementById("diplomUpload");
//var visitTemplate = document.getElementById("visitTemplate");

upload.onchange = function () {
    var fileName = this.value;
    var index = fileName.lastIndexOf("\\");

    document.getElementById("fileNameLabel").innerText = fileName.substring(index + 1);
}
uploadPassport.onchange = function () {
    var fileName = this.value;
    var index = fileName.lastIndexOf("\\");
    document.getElementById("passportNameLabel").innerText = fileName.substring(index + 1);
}
uploadDiplom.onchange = function () {
    var fileName = this.value;
    var index = fileName.lastIndexOf("\\");
    console.log(fileName);
    document.getElementById("diplomNameLabel").innerText = fileName.substring(index + 1);
}
$("#btnAddVisit").click(function () {
    var listVisit = document.getElementsByClassName("btn btn-danger");
    var visitCounter = listVisit.length-1;
    visitCounter++;
    console.log(visitCounter);

    var template = $("#visitTemplate").clone();
    //console.log(template);
    template[0].classList.remove("collapse");
    var inputList = template.find("input");
    
    for (let index = 0; index < inputList.length; index++) {


        inputList[index].setAttribute("name", inputList[index].name.substring(0, inputList[index].name.lastIndexOf('_')+1) + visitCounter+"]");
        //inputList[index].name = inputList[index].name + visitCounter;
        console.log(inputList[index]);
    }

    $("#visitPlaceholder").append(template);
});


function DeleteVisit(btn) {
    console.log($(btn).closest(".create-personal-short").remove());

}

$("#btnAddChild").click(function () {
    var listChild = document.getElementsByClassName("btn btn-danger");
    var childCounter = listChild.length-1;
    childCounter++;
    console.log(childCounter);

    var template_child = $("#childTemplate").clone();
    //console.log(template);
    template_child[0].classList.remove("collapse");
    var inputList = template_child.find("input");
    
    for (let index = 0; index < inputList.length; index++) {


        inputList[index].setAttribute("name", inputList[index].name.substring(0, inputList[index].name.lastIndexOf('_')+1) + childCounter+"]");
        //inputList[index].name = inputList[index].name + visitCounter;
        console.log(inputList[index]);
    }

    $("#childPlaceholder").append(template_child);
});


function DeleteChild(btn) {
    console.log($(btn).closest(".create-personal-child").remove());

}
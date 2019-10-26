"use strict";
//URL till webbtjänst
let url = "http://studenter.miun.se/~emno1501/dt173g/projekt/rest/cv.php"; //URL till webbtjänst
/* let url = "http://localhost/cv_rest/cv.php"; */

//Variabler
let edTab = document.getElementById("edTab");
let workTab = document.getElementById("workTab");
let webTab = document.getElementById("webTab");
let edSection = document.getElementById("education");
let workSection = document.getElementById("workxp");
let webSection = document.getElementById("websites");

//Byt mellan flikar
edTab.addEventListener("click", switchToEd, false);
workTab.addEventListener("click", switchToWork, false);
webTab.addEventListener("click", switchToWeb, false);

function switchToEd() {
    if(edSection.className == "close") {
        edSection.className = "open"; edTab.className = "current";
        workSection.className = "close"; workTab.className = "hidden";
        webSection.className = "close"; webTab.className = "hidden";
    }
}
function switchToWork() {
    if(workSection.className == "close") {
        workSection.className = "open"; workTab.className = "current";
        edSection.className = "close"; edTab.className = "hidden";
        webSection.className = "close"; webTab.className = "hidden";
    }
}
function switchToWeb() {
    if(webSection.className == "close") {
        webSection.className = "open"; webTab.className = "current";
        workSection.className = "close"; workTab.className = "hidden";
        edSection.className = "close"; edTab.className = "hidden";
    }
}
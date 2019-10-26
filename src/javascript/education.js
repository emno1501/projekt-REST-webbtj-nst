//Variabler
let edTable = document.getElementById("edTable");
let edTbody = document.getElementById("edTbody");
let edForm = document.getElementById("addEd");
let edUpdForm = document.getElementById("updateEd");

//Läs ut data - Fetchanrop mot webbtjänst
window.addEventListener("load", getEducations, false);
function getEducations() {
    edTbody.innerHTML = "";
    fetch(url + "/education")
    .then((res) => res.json())
    .then((data) => {
        let output = "";
        //Lägg in data i tabellelement
        data.forEach( function(ed) {
            output += `
            <tr>
                <td>${ed.edID}
                <td>${ed.edName}</td>
                <td>${ed.edPlace}</td>
                <td>${ed.edStart} - ${ed.edStop}</td>
                <td>
                    <button type="button" id="${ed.edID}">Ta bort</button>
                </td>
            </tr>
            `
        })
        //Lägg in tabellelement i tabell för utbildning
        edTbody.innerHTML += output;
    })
}

//Lägg till utbildning
document.getElementById("submitEd").addEventListener("click", addEd, false);
function addEd() {
    //Variabler som lagrar de värden som formulärets input-rutor innehåller
    let edName = document.getElementById("edname").value;
    let edPlace = document.getElementById("edplace").value;
    let edStart = document.getElementById("edstart").value;
    let edStop = document.getElementById("edstop").value;

    let jsonStr = JSON.stringify({ //Lagra i JSON-format
        "edName": edName,
        "edPlace": edPlace,
        "edStart": edStart,
        "edStop": edStop
    });
    fetch(url + "/education", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: jsonStr
    }) .then((res) => res.json())
    .then((data) => console.log(data))
    .catch((err) => console.log(err))
    edForm.reset(); //Töm tabell
    getEducations(); //Anropa funktion som hämtar och skriver ut data i tabellen på nytt
}

//Ändra utbildning
document.getElementById("submitUpdEd").addEventListener("click", updateEd, false);
function updateEd() {
    //Variabler som lagrar de värden som formulärets input-rutor innehåller
    let edID = document.getElementById("edID").value;
    let edName = document.getElementById("updedname").value;
    let edPlace = document.getElementById("updedplace").value;
    let edStart = document.getElementById("updedstart").value;
    let edStop = document.getElementById("updedstop").value;

    let jsonStr = JSON.stringify({ //Lagra i JSON-format
        "edName": edName,
        "edPlace": edPlace,
        "edStart": edStart,
        "edStop": edStop
    });
    fetch(url + "/education/" + edID, {
        method: "PUT",
        headers: {
            "Content-Type": "application/json"
        },
        body: jsonStr
    }) .then((res) => res.json())
    .then((data) => console.log(data))
    .catch((err) => console.log(err))
    edUpdForm.reset(); //Töm tabell
    getEducations(); //Anropa funktion som hämtar och skriver ut data i tabellen på nytt
}

//Autoifyll av uppdateringsformulär när IDt fylls i
document.getElementById("edID").addEventListener("input", fillEdUpdForm, false);
function fillEdUpdForm() {
    let id = document.getElementById("edID").value;

    fetch(url + "/education/" + id)
    .then((res) => res.json())
    .then((data) => {
        data.forEach( function(ed) {
                document.getElementById("updedname").value = ed.edName;
                document.getElementById("updedplace").value = ed.edPlace;
                document.getElementById("updedstart").value = ed.edStart;
                document.getElementById("updedstop").value = ed.edStop;
        })
    })
}

//Radera utbildning
edTable.addEventListener("click", function(e){
    fetch(url+"/education/"+e.target.id, { //Lägger till IDt från det element som användaren klickade på till url:en
        method: "DELETE",
    }) .then((res) => res.json())
    .then((data) => console.log(data))
    .catch((err) => console.log(err))
    getEducations(); //Anropa funktion som hämtar och skriver ut data i tabellen på nytt
});
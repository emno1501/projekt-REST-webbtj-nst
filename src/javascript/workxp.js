//Variabler
let workTable = document.getElementById("workTable");
let workTbody = document.getElementById("workTbody");
let workForm = document.getElementById("addWork");
let workUpdForm = document.getElementById("updateWork");

//Läs ut data om arbetserfarenhet - Fetchanrop mot webbtjänst
window.addEventListener("load", getWorkxp, false);
function getWorkxp() {
    workTbody.innerHTML = "";
    fetch(url + "/workexperience")
    .then((res) => res.json())
    .then((data) => {
        let output = "";
        //Lägg in data i tabellelement
        data.forEach( function(work) {
            output += `
            <tr>
                <td>${work.workID}
                <td>${work.workTitle}</td>
                <td>${work.workPlace}</td>
                <td>${work.workStart} - ${work.workStop}</td>
                <td>
                    <button type="button" id="${work.workID}">Ta bort</button>
                </td>
            </tr>
            `
        })
        //Lägg in tabellelement i tabell för arbetserfarenhet
        workTbody.innerHTML += output;
    })
}

//Lägg till arbetserfarenhet
document.getElementById("submitWork").addEventListener("click", addWork, false);
function addWork() {
    //Variabler som lagrar de värden som formulärets input-rutor innehåller
    let workTitle = document.getElementById("worktitle").value;
    let workPlace = document.getElementById("workplace").value;
    let workStart = document.getElementById("workstart").value;
    let workStop = document.getElementById("workstop").value;

    let jsonStr = JSON.stringify({ //Lagra i JSON-format
        "workTitle": workTitle,
        "workPlace": workPlace,
        "workStart": workStart,
        "workStop": workStop
    });
    fetch(url + "/workexperience", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: jsonStr
    }) .then((res) => res.json())
    .then((data) => console.log(data))
    .catch((err) => console.log(err))
    workForm.reset(); //Töm tabell
    getWorkxp(); //Anropa funktion som hämtar och skriver ut data i tabellen på nytt
}

//Ändra arbetserfarenhet
document.getElementById("submitUpdWork").addEventListener("click", updateWork, false);
function updateWork() {
    //Variabler som lagrar de värden som formulärets input-rutor innehåller
    let workID = document.getElementById("workID").value;
    let workTitle = document.getElementById("updworktitle").value;
    let workPlace = document.getElementById("updworkplace").value;
    let workStart = document.getElementById("updworkstart").value;
    let workStop = document.getElementById("updworkstop").value;

    let jsonStr = JSON.stringify({ //Lagra i JSON-format
        "workTitle": workTitle,
        "workPlace": workPlace,
        "workStart": workStart,
        "workStop": workStop
    });
    fetch(url + "/workexperience/" + workID, {
        method: "PUT",
        headers: {
            "Content-Type": "application/json"
        },
        body: jsonStr
    }) .then((res) => res.json())
    .then((data) => console.log(data))
    .catch((err) => console.log(err))
    workUpdForm.reset(); //Töm tabell
    getWorkxp(); //Anropa funktion som hämtar och skriver ut data i tabellen på nytt
}

//Autoifyll av uppdateringsformulär när IDt fylls i
document.getElementById("workID").addEventListener("input", fillWorkUpdForm, false);
function fillWorkUpdForm() {
    let id = document.getElementById("workID").value;

    fetch(url + "/workexperience/" + id)
    .then((res) => res.json())
    .then((data) => {
        data.forEach( function(w) {
                document.getElementById("updworktitle").value = w.workTitle;
                document.getElementById("updworkplace").value = w.workPlace;
                document.getElementById("updworkstart").value = w.workStart;
                document.getElementById("updworkstop").value = w.workStop;
        })
    })
}

//Radera arbetserfarenhet
workTable.addEventListener("click", function(e){
    fetch(url+"/workexperience/"+e.target.id, { //Lägger till IDt från det element som användaren klickade på till url:en
        method: "DELETE",
    }) .then((res) => res.json())
    .then((data) => console.log(data))
    .catch((err) => console.log(err))
    getWorkxp(); //Anropa funktion som hämtar och skriver ut data i tabellen på nytt
});
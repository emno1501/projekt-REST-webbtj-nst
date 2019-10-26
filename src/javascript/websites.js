//Variabler
let webTable = document.getElementById("websiteTable");
let webTbody = document.getElementById("webTbody");
let webForm = document.getElementById("addWebsite");
let webUpdForm = document.getElementById("updateWebsite");

//Läs ut data - Fetchanrop mot webbtjänst
window.addEventListener("load", getWebsites, false);
function getWebsites() {
    webTbody.innerHTML = "";
    fetch(url + "/websites")
    .then((res) => res.json())
    .then((data) => {
        let output = "";
        //Lägg in data i tabellelement
        data.forEach( function(web) {
            output += `
            <tr>
                <td>${web.websiteID}
                <td>${web.websiteTitle}</td>
                <td>${web.websiteDescription}</td>
                <td><a href="${web.websiteLink}">${web.websiteLink}</a></td>
                <td>
                    <button type="button" id="${web.websiteID}">Ta bort</button>
                </td>
            </tr>
            `
        })
        //Lägg in tabellelement i tabell för webbplatser
        webTbody.innerHTML += output;
    })
}

//Lägg till webbsida
document.getElementById("submitWebsite").addEventListener("click", addWebsite, false);
function addWebsite() {
    //Variabler som lagrar de värden som formulärets input-rutor innehåller
    let webTitle = document.getElementById("webtitle").value;
    let webDescr = document.getElementById("webdescr").value;
    let webLink = document.getElementById("weblink").value;

    let jsonStr = JSON.stringify({ //Lagra i JSON-format
        "websiteTitle": webTitle,
        "websiteDescription": webDescr,
        "websiteLink": webLink
    });
    fetch(url + "/websites", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: jsonStr
    }) .then((res) => res.json())
    .then((data) => console.log(data))
    .catch((err) => console.log(err))
    webForm.reset(); //Töm formulär
    getWebsites(); //Anropa funktion som hämtar och skriver ut data i tabellen på nytt
}

//Uppdatera webbsida
document.getElementById("submitUpdWebsite").addEventListener("click", updateWebsite, false);
function updateWebsite() {
    //Variabler som lagrar de värden som formulärets input-rutor innehåller
    let webID = document.getElementById("webID").value;
    let webTitle = document.getElementById("updwebtitle").value;
    let webDescr = document.getElementById("updwebdescr").value;
    let webLink = document.getElementById("updweblink").value;

    let jsonStr = JSON.stringify({ //Lagra i JSON-format
        "websiteTitle": webTitle,
        "websiteDescription": webDescr,
        "websiteLink": webLink
    });
    fetch(url + "/websites/" + webID, {
        method: "PUT",
        headers: {
            "Content-Type": "application/json"
        },
        body: jsonStr
    }) .then((res) => res.json())
    .then((data) => console.log(data))
    .catch((err) => console.log(err))
    webUpdForm.reset(); //Töm tabell
    getWebsites(); //Anropa funktion som hämtar och skriver ut data i tabellen på nytt
}
//Autoifyll av uppdateringsformulär när IDt fylls i
document.getElementById("webID").addEventListener("input", fillUpdForm, false);
function fillUpdForm() {
    let id = document.getElementById("webID").value;

    fetch(url + "/websites/" + id)
    .then((res) => res.json())
    .then((data) => {
        data.forEach( function(web) {
                document.getElementById("updwebtitle").value = web.websiteTitle;
                document.getElementById("updwebdescr").value = web.websiteDescription;
                document.getElementById("updweblink").value = web.websiteLink;
        })
    })
}

//Radera webbsida
webTable.addEventListener("click", function(e){
    fetch(url+"/websites/"+e.target.id, { //Lägger till IDt från det element som användaren klickade på till url:en
        method: "DELETE",
    }) .then((res) => res.json())
    .then((data) => console.log(data))
    .catch((err) => console.log(err))
    getWebsites(); //Anropa funktion som hämtar och skriver ut data i tabellen på nytt
});
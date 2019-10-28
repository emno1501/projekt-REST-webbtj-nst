<!-- HTML-struktur för webbplatssektion i admingränssnitt -->
<section id="websites" class="close">
            <table id="websiteTable"> <!-- Tabell där innehållet från databasen skrivs ut -->
                <thead>
                    <tr>
                        <th class="th1">ID</th>
                        <th class="th2">Webbplatstitel</th>
                        <th class="th3">Beskrivning</th>
                        <th class="th4">Länk till webbplats</th>
                        <th class="th5"></th>
                    </tr>
                </thead>
                <tbody id="webTbody"></tbody>
            </table>
            <div>
                <h2>Lägg till webbplats</h2>
                <!-- Formulär för att lägga till ny webbplats -->
                <form id="addWebsite">
                    <label>Titel<input type="text" id="webtitle" /></label>
                    <label>Beskrivning<textarea id="webdescr"></textarea></label>
                    <label>Länk<input type="text" id="weblink" /></label>
                    <button type="button" id="submitWebsite">Lägg till</button>
                </form>
            </div>
            <div id="updateWebsiteBox" class="updateform">
                <h2>Uppdatera webbplats</h2>
                <!-- Formulär för att ändra info om webbplats -->
                <form id="updateWebsite">
                    <label>ID<input type="text" id="webID" /></label>
                    <label>Titel<input type="text" id="updwebtitle" /></label>
                    <label>Beskrivning<textarea id="updwebdescr"></textarea></label>
                    <label>Länk<input type="text" id="updweblink" /></label>
                    <button type="button" id="submitUpdWebsite">Uppdatera</button>
                </form>
            </div>
        </section>
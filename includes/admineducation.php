<section id="education" class="open">
            <table id="edTable">
                <tr>
                    <thead>
                        <th class="th1">ID</th>
                        <th class="th2">Utbild.namn</th>
                        <th class="th3">Lärosäte</th>
                        <th class="th4">Start- och slutdatum</th>
                        <th class="th5"></th>
                    </thead>
                    <tbody id="edTbody"></tbody>
                </tr>
            </table>
            <div>
                <h2>Lägg till utbildning</h2>
                <form id="addEd">
                    <label>Utbild.namn<input type="text" id="edname" /></label>
                    <label>Lärosäte<input type="text" id="edplace" /></label>
                    <label>Startdatum (månad och år)<input type="text" id="edstart" /></label>
                    <label>Slutdatum (månad och år)<input type="text" id="edstop" /></label>
                    <button type="button" id="submitEd">Lägg till</button>
                </form>
            </div>
            <div id="updateEdBox" class="updateform">
                <h2>Uppdatera utbildning</h2>
                <form id="updateEd">
                    <label>ID<input type="text" id="edID" /></label>
                    <label>Utbild.namn<input type="text" id="updedname" /></label>
                    <label>Lärosäte<input type="text" id="updedplace" /></label>
                    <label>Startdatum (månad och år)<input type="text" id="updedstart" /></label>
                    <label>Slutdatum (månad och år)<input type="text" id="updedstop" /></label>
                    <button type="button" id="submitUpdEd">Uppdatera</button>
                </form>
            </div>
        </section>
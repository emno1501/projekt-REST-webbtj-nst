<!-- Sektion för arbetserfarenhet i admingränssnitt -->
<section id="workxp" class="close"> 
            <table id="workTable"> <!-- Tabell där databasinnehållet skrivs ut -->
                <thead>
                    <tr>
                        <th class="th1">ID</th>
                        <th class="th2">Arbetstitel</th>
                        <th class="th3">Arbetsplats</th>
                        <th class="th4">Start- och slutdatum</th>
                        <th class="th5"></th>
                    </tr>
                </thead>
                <tbody id="workTbody"></tbody>
            </table>
            <div>
                <h2>Lägg till arbetserfarenhet</h2>
                <!-- Formulär för att lägga till arbetserfarenhet -->
                <form id="addWork">
                    <label>Titel<input type="text" id="worktitle" /></label>
                    <label>Arbetsplats<input type="text" id="workplace" /></label>
                    <label>Startdatum (månad och år)<input type="text" id="workstart" /></label>
                    <label>Slutdatum (månad och år)<input type="text" id="workstop" /></label>
                    <button type="button" id="submitWork">Lägg till</button>
                </form>
            </div>
            <div id="updateWorkBox" class="updateform">
                <h2>Uppdatera arbetserfarenhet</h2>
                <!-- Formulär för att ändra info om arbetserfarenhet -->
                <form id="updateWork">
                    <label>ID<input type="text" id="workID" /></label>
                    <label>Titel<input type="text" id="updworktitle" /></label>
                    <label>Arbetsplats<input type="text" id="updworkplace" /></label>
                    <label>Startdatum (månad och år)<input type="text" id="updworkstart" /></label>
                    <label>Slutdatum (månad och år)<input type="text" id="updworkstop" /></label>
                    <button type="button" id="submitUpdWork">Uppdatera</button>
                </form>
            </div>
        </section>
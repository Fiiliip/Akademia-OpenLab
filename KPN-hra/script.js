let pocetHier = 0;

let skoreHraca = 0;
let skoreAI = 0;

const pocitadloObjektov = new Map();
pocitadloObjektov.set('k', 0);
pocitadloObjektov.set('p', 0);
pocitadloObjektov.set('n', 0);

let historiaHry = [];

// Spusti hru kliknutím na tlačidlo.
function startGame() {
    // Zobraz pravidlá hry.
    window.alert("Vitaj v hre Kameň, Papier, Nožnice.\n\nPravidlá hry:\n- Kameň otupí nožnice. | Vyhrá kameň.\n- Papier obalí kameň. | Vyhrá papier.\n- Nožnice rozstrihnú papier. | Vyhrajú nožnice.\n- Dva rovnaké objekty znamenajú remízu.\n\nKlikni \"OK\" pre pokračovanie."); 
    
    const moznosti = ["k", "p", "n"];

    zapisLog(`Kolo č. ${pocetHier += 1}`)

    // Načítaj voľbu používateľa.
    const volbaHraca = prompt("Zadaj svoju voľbu: k (kameň), p (papier) alebo n (nožnice).").toLowerCase();

    if (moznosti.find(moznost => moznost == volbaHraca) == undefined) {
        window.alert("Zadaná voľba nie je platná. Skús znova.");
        zapisLog("Zadná neplatná voľba.\n")
        startGame();
    }

    zapisLog(`Tvoja voľba: ${volbaHraca}`)

    // Vygeneruj voľbu AI.
    const volbaAI = moznosti[Math.floor(Math.random() * 3)];
    zapisLog(`Voľba AI: ${volbaAI}\n`)

    // Zvýš počítadlo použitých objektov.
    pocitadloObjektov.set(volbaHraca, pocitadloObjektov.get(volbaHraca) + 1);
    pocitadloObjektov.set(volbaAI, pocitadloObjektov.get(volbaAI) + 1);

    // Porovnaj voľby a urči výsledok hry.
    let vysledok = "";
    if (volbaHraca == volbaAI) {
        vysledok = "Remíza";
    } else if (volbaHraca == "k" && volbaAI == "n" || volbaHraca == "p" && volbaAI == "k" || volbaHraca == "n" && volbaAI == "p") {
        vysledok = "Vyhral si!";
        skoreHraca += 1;
    } else {
        vysledok = "Prehral si!";
        skoreAI += 1;
    }
    zapisLog(`Výsledok: ${vysledok}`)

    // Zobraz výsledok hry.
    window.alert(`Tvoja voľba: ${volbaHraca}\nVoľba AI: ${volbaAI}\n\nVýsledok: ${vysledok}`);

    // Vypíš skóre do HTML.
    document.getElementById("score-player").innerHTML = `Skóre hráča: ${skoreHraca}`;
    document.getElementById("score-AI").innerHTML = `Skóre AI: ${skoreAI}`;
    
    // Vypíš štatistiky použitia jednotlivých objektov do HTML.
    document.getElementById("counter-rock").innerHTML = `Počet kameň: ${pocitadloObjektov.get('k')}`;
    document.getElementById("counter-paper").innerHTML = `Počet papier: ${pocitadloObjektov.get('p')}`;
    document.getElementById("counter-scissors").innerHTML = `Počet nožnice: ${pocitadloObjektov.get('n')}`;

    // Vypíš históriu hry do HTML.
    document.getElementById("history").innerHTML = historiaHry.join("<br>");

    document.getElementById("btn-start-game").innerHTML = "Hrať znovu."
}

function zapisLog(text) {
    historiaHry.push(text)
    console.log(text);
}
// NEAKTUALNE!!!

let kamen = {
    id: 1,
    nazov: "kameň",
    znak: "k",
}

let papier = {
    id: 2,
    nazov: "papier",
    znak: "p",
}

let noznice = {
    id: 3,
    nazov: "nožnice",
    znak: "n",
}

const predmety = [kamen, papier, noznice];

const pocitadloObjektov = new Map();
pocitadloObjektov.set('k', 0);
pocitadloObjektov.set('p', 0);
pocitadloObjektov.set('n', 0);

let pocitadloKol = 0;

let skoreHraca = 0;
let skoreAI = 0;

let historiaHry = [];

// Spusti hru kliknutím na tlačidlo.
function spustHru() {
    // Zobraz pravidlá hry.
    alert("Vitaj v hre Kameň, Papier, Nožnice.\n\nPravidlá hry:\n- Kameň otupí nožnice. | Vyhrá kameň.\n- Papier obalí kameň. | Vyhrá papier.\n- Nožnice rozstrihnú papier. | Vyhrajú nožnice.\n- Dva rovnaké predmety znamenajú remízu.\n\nKlikni \"OK\" pre pokračovanie (vyskočí ti okno, kde zadáš tvoju voľbu)."); 

    zapisDoHistore(`Kolo č. ${pocitadloKol += 1}`)

    // Načítaj voľbu používateľa.
    const volbaHraca = prompt("Zadaj svoju voľbu: k (kameň), p (papier) alebo n (nožnice).").toLowerCase();

    if (predmety.find(predmet => predmet.znak == volbaHraca) == undefined) {
        alert("Zadaná voľba nie je platná. Skús znova.");
        zapisDoHistore("Zadná neplatná voľba.\n")
        spustHru();
    }

    zapisDoHistore(`Tvoja voľba: ${volbaHraca.nazov}`)

    // Vygeneruj voľbu AI.
    const volbaAI = moznosti[Math.floor(Math.random() * 3)];
    zapisDoHistore(`Voľba AI: ${volbaAI}\n`)

    // Zvýš počítadlo použitých objektov.
    pocitadloObjektov.set(volbaHraca, pocitadloObjektov.get(volbaHraca) + 1);
    pocitadloObjektov.set(volbaAI, pocitadloObjektov.get(volbaAI) + 1);

    // Porovnaj voľby a urči výsledok hry.
    let vysledok = "";
    if (volbaHraca == volbaAI) {
        vysledok = "Remíza";
        document.getElementsByTagName("html")[0].style.borderColor = "yellow";
    } else if (volbaHraca == "k" && volbaAI == "n" || volbaHraca == "p" && volbaAI == "k" || volbaHraca == "n" && volbaAI == "p") {
        vysledok = "Vyhral si!";
        skoreHraca += 1;
        document.getElementsByTagName("html")[0].style.borderColor = "green";
    } else {
        vysledok = "Prehral si!";
        skoreAI += 1;
        document.getElementsByTagName("html")[0].style.borderColor = "red";
    }
    zapisDoHistore(`Výsledok: ${vysledok}`)

    // Zobraz výsledok hry.
    alert(`Tvoja voľba: ${volbaHraca}\nVoľba AI: ${volbaAI}\n\nVýsledok: ${vysledok}`);

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

function zapisDoHistore(text) {
    this.historia.push(text);
    console.log(text);
}



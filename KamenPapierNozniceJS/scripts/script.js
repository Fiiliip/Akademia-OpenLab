import { Game } from './Game.js';

const game = new Game();

// FIX: Prečo toto nefunguje?
// function spustHru() {
//     // Zobraz uvítací text.
//     alert("Vitaj v hre Kameň, Papier, Nožnice.\n\nPravidlá hry:\n- Kameň otupí nožnice. | Vyhrá kameň.\n- Papier obalí kameň. | Vyhrá papier.\n- Nožnice rozstrihnú papier. | Vyhrajú nožnice.\n- Dva rovnaké objekty znamenajú remízu.\n\nKlikni \"OK\" pre pokračovanie (vyskočí ti okno, kde zadáš tvoju voľbu).");
    
//     hra.noveKolo();
// }

document.getElementById('startGameBtn').addEventListener('click', function() {
    game.newRound();
});

// Malý "Easter Egg", aj keď ho tu v kóde takmer každý uvidí, heh.
let headerFS = 2.6;
let textFS = 0.6;

document.getElementById('showRulesBtn').addEventListener('click', function() {
    let pElementy = document.getElementById('gameRules').children;
    
    headerFS += 0.4;
    textFS += 0.4;

    if (headerFS > 1000) {
        alert('No bolo ti to treba?');
        headerFS = 18;
        textFS = 16;
    } else if (headerFS > 30) {
        alert('Nerob si srandu, že na to stále nevidíš! Na, urobím ti láskavosť.');
        headerFS += 1000;
        textFS += 1000;
    }

    pElementy[0].style.fontSize = `${headerFS}px`;
    pElementy[1].style.fontSize = `${textFS}px`;
});


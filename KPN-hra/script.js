import { Hra } from './Hra.js';

const hra = new Hra();

// FIX: Prečo toto nefunguje?
// function spustHru() {
//     // Zobraz uvítací text.
//     window.alert("Vitaj v hre Kameň, Papier, Nožnice.\n\nPravidlá hry:\n- Kameň otupí nožnice. | Vyhrá kameň.\n- Papier obalí kameň. | Vyhrá papier.\n- Nožnice rozstrihnú papier. | Vyhrajú nožnice.\n- Dva rovnaké objekty znamenajú remízu.\n\nKlikni \"OK\" pre pokračovanie (vyskočí ti okno, kde zadáš tvoju voľbu).");
    
//     hra.noveKolo();
// }

document.getElementById('startGameBtn').addEventListener('click', function() {
    hra.noveKolo();
});

document.getElementById('showRulesBtn').addEventListener('click', function() {
    hra.zobrazPravidla();
});


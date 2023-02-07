import { Item } from "./Item.js";
import { Player } from "./Player.js";

export class Game {
    constructor() {
        this.player = new Player("Hráč");
        this.ai = new Player("AI - František");

        this.winner = null;
    
        this.items = [
            new Item(1, "kameň", "k"),
            new Item(2, "papier", "p"),
            new Item(3, "nožnice", "n")
        ]
    
        this.roundCounter = 0;
        this.itemUsageCounter = new Map([
            [this.items[0], 0],
            [this.items[1], 0],
            [this.items[2], 0]
        ]);
    
        this.gameLog = [];

        this.isRunning = false;
    };

    setPlayerName() {
        this.player.name = prompt("Zadaj svoje meno: ");
        if (this.player.name == "") {
            alert("Neplatné meno. Skús znova.");
            this.setPlayerName();
        }
    }

    newRound() {
        if (!this.isRunning) {
            this.showRules();
            this.setPlayerName();
            this.isRunning = true;
        }

        this.roundCounter += 1;
        
        this.writeToGameLog(`Kolo č. ${this.roundCounter}`);
    
        this.getPlayerChoice(this.player);
        document.getElementById("startGameBtn").innerHTML = "Hrať znovu.";
        if (this.player.selectedItem == undefined) return;

        this.getPlayerChoice(this.ai);
        
        this.checkGame();
    }

    checkGame() {
        this.checkRoundResults();
        if (this.winner != null) {
            this.showGameResult();
            this.askToPlayAgain();
        }
    }
    
    getPlayerChoice(player) {
        let choice = null;
        if (player.name.includes("AI")) {
            player.selectedItem = this.items[Math.floor(Math.random() * 3)];
        } else {
            choice = prompt("Zadaj svoju voľbu: k (kameň), p (papier) alebo n (nožnice).");
            player.selectedItem = this.items.find(item => item.char == choice.toLowerCase());
    
            if (player.selectedItem == undefined) {
                alert("Neplatná voľba. Skús znova.");
                this.writeToGameLog(`${player.name} zadal/-a neplatnú voľbu.`);
                return;
            }
        }
        this.itemUsageCounter.set(player.selectedItem, this.itemUsageCounter.get(player.selectedItem) + 1);
    
        this.writeToGameLog(`${player.name} zvolil/-a predmet: ${player.selectedItem.name}`);
    }
    
    checkRoundResults() {
        let result = null;
        if (this.player.selectedItem == this.ai.selectedItem) {
            result = "Remíza!";
            document.getElementById("html").style.borderColor = "rgb(255,193,7)";
        } else if ((this.player.selectedItem.char == "k" && this.ai.selectedItem.char == "n") || (this.player.selectedItem.char == "p" && this.ai.selectedItem.char == "k") || (this.player.selectedItem.char == "n" && this.ai.selectedItem.char == "p")) {
            this.player.score += 1;
            result = `${this.player.name} vyhral/-a kolo!`;
            document.getElementById("html").style.borderColor = "rgb(25,135,84)";
        } else {
            this.ai.score += 1;
            result = `${this.ai.name} vyhral/-a kolo!`;
            document.getElementById("html").style.borderColor = "rgb(220,53,69)";
        }
    
        this.writeToGameLog(`Výsledok: ${result}`);
        alert(result);

        if (this.player.score >= 5) {
            this.winner = this.player;
        } else if (this.ai.score >= 5) {
            this.winner = this.ai;
        }
    }

    showGameResult() {
        let gameResult = `${this.winner.name} dosiahol ${this.winner.score} bodov a vyhral/-a celú hru!`;
        
        this.writeToGameLog(gameResult);
        alert(gameResult);
    }

    askToPlayAgain() {
        let playAgain = prompt("Hrať znovu? (a - áno, n - nie)");
        if (playAgain == "a") {
            this.restartGame();
        } else if (playAgain == "n") {
            this.writeToGameLog("Hra bola ukončená.");
            alert("Hra bola ukončená.");

            document.getElementById("startGameBtn").disabled = true;
            document.getElementById("startGameBtn").innerHTML = "Hra ukončená.";
        } else {
            alert("Neplatná voľba. Skús znova.");
            this.askToPlayAgain();
        }
    }

    restartGame() {
        this.player.score = 0;
        this.ai.score = 0;
        this.winner = null;
        this.roundCounter = 0;
        this.itemUsageCounter = new Map([
            [this.items[0], 0],
            [this.items[1], 0],
            [this.items[2], 0]
        ]);
        this.gameLog = [];
        this.writeToGameLog("Hra bola reštartovaná.");
        this.newRound();
    }

    showRules() {
        alert("Vitaj v hre Kameň, Papier, Nožnice.\n\nPravidlá hry:\n- Kameň otupí nožnice. | Vyhrá kameň.\n- Papier obalí kameň. | Vyhrá papier.\n- Nožnice rozstrihnú papier. | Vyhrajú nožnice.\n- Dva rovnaké objekty znamenajú remízu.\n\nKlikni \"OK\" pre pokračovanie (vyskočí ti okno, kde zadáš tvoju voľbu).");
    }
    
    writeToGameLog(text) {
        this.gameLog.push(text);
        console.log(text);

        this.writeInfoOnDisplay();
    }
    
    writeInfoOnDisplay() {
        document.getElementById("scorePlayer").innerHTML = `${this.player.name}: ${this.player.score}`;
        document.getElementById("scoreAI").innerHTML = `${this.ai.name}: ${this.ai.score}`;

        document.getElementById("countRock").innerHTML = `Kameň: ${this.itemUsageCounter.get(this.items[0])}`;
        document.getElementById("countPaper").innerHTML = `Papier: ${this.itemUsageCounter.get(this.items[1])}`;
        document.getElementById("countScissors").innerHTML = `Nožnice: ${this.itemUsageCounter.get(this.items[2])}`;

        document.getElementById("historyInfo").innerHTML = this.gameLog.join("<br>");
    }
}
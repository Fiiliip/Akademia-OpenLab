import { Predmet } from "./Predmet.js";
import { Hrac } from "./Hrac.js";

export class Hra {
    constructor() {
        this.hrac = new Hrac("Hráč");
        this.ai = new Hrac("AI");
    
        this.predmety = [
            new Predmet(1, "kameň", "k"),
            new Predmet(2, "papier", "p"),
            new Predmet(3, "nožnice", "n")
        ]
    
        this.pocitadloKol = 0;
        this.pocitadloObjektov = new Map([
            [this.predmety[0], 0],
            [this.predmety[1], 0],
            [this.predmety[2], 0]
        ]);
    
        this.historia = [];
    };

    noveKolo() {
        this.pocitadloKol += 1;
        
        this.zapisDoHistore("--------------------");
        this.zapisDoHistore(`Kolo č. ${this.pocitadloKol}`);
    
        this.vypytajVolbuOdHraca(this.hrac);
        if (this.hrac.zvolenyPredmet == undefined) return;
        this.vypytajVolbuOdHraca(this.ai);
    
        this.vyhodnot();
        this.vypisHodnotyNaObrazovku();

        document.getElementById("startGameBtn").innerHTML = "Hrať znovu.";
    }
    
    vypytajVolbuOdHraca(hrac) {
        let volba = null;
        if (hrac.meno == "AI") {
            hrac.zvolenyPredmet = this.predmety[Math.floor(Math.random() * 3)];
        } else {
            volba = prompt("Zadaj svoju voľbu: k (kameň), p (papier) alebo n (nožnice).");
            hrac.zvolenyPredmet = this.predmety.find(predmet => predmet.znak == volba.toLowerCase());
    
            if (hrac.zvolenyPredmet == undefined) {
                window.alert("Neplatná voľba. Skús znova.");
                this.zapisDoHistore(`${hrac.meno} zadal/-a neplatnú voľbu.`);
                return;
            }
        }
        this.pocitadloObjektov.set(hrac.zvolenyPredmet, this.pocitadloObjektov.get(hrac.zvolenyPredmet) + 1);
    
        this.zapisDoHistore(`${hrac.meno} zvolil/-a predmet: ${hrac.zvolenyPredmet.nazov}`);
    }
    
    vyhodnot() {
        let vysledok = null;
        if (this.hrac.zvolenyPredmet == this.ai.zvolenyPredmet) {
            vysledok = "Remíza!";
            document.getElementById("html").style.borderColor = "rgb(255,193,7)";
        } else if ((this.hrac.zvolenyPredmet.znak == "k" && this.ai.zvolenyPredmet.znak == "n") || (this.hrac.zvolenyPredmet.znak == "p" && this.ai.zvolenyPredmet.znak == "k") || (this.hrac.zvolenyPredmet.znak == "n" && this.ai.zvolenyPredmet.znak == "p")) {
            this.hrac.skore += 1;
            vysledok = `${this.hrac.meno} vyhral/-a!`;
            document.getElementById("html").style.borderColor = "rgb(25,135,84)";
        } else {
            this.ai.skore += 1;
            vysledok = `${this.ai.meno} vyhral/-a!`;
            document.getElementById("html").style.borderColor = "rgb(220,53,69)";
        }
    
        this.zapisDoHistore(`Výsledok: ${vysledok}`);
    }
    
    zapisDoHistore(text) {
        this.historia.push(text);
        console.log(text);
    }
    
    vypisHodnotyNaObrazovku() {
        document.getElementById("scorePlayer").innerHTML = `${this.hrac.meno}: ${this.hrac.skore}`;
        document.getElementById("scoreAI").innerHTML = `${this.ai.meno}: ${this.ai.skore}`;

        document.getElementById("countRock").innerHTML = `Kameň: ${this.pocitadloObjektov.get(this.predmety[0])}`;
        document.getElementById("countPaper").innerHTML = `Papier: ${this.pocitadloObjektov.get(this.predmety[1])}`;
        document.getElementById("countScissors").innerHTML = `Nožnice: ${this.pocitadloObjektov.get(this.predmety[2])}`;

        document.getElementById("historyInfo").innerHTML = this.historia.join("<br>");
    }
}
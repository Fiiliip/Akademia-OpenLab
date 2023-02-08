QnA:
- Q: Je správne písať štýl do "template" elementu?
- Q: Aký je rozdieľ medzi "npm run serve" a "vue serve"?
- Q: Prečo mi nefunguje "vue serve"? Že vraj "package.json" je už v projekte.
- Q: K čomu slúži "name" v "export default" pri komponente?
- Q: Môžem písať kód do App.vue, alebo to slúži len na router-view?

Pozn.:
- "props: {
    msg: String,
  }," - je to akokeby parameter pre komponent, že cez msg atribút viem odoslať nejaký String, ktorý viem potom používať v komponente

- a - komponenty, ktoré použijem na jednom mieste a koniec..
- z - vyskytuje sa na viacerých miestách
- v - používa sa medzi projektami

Vue1:
Čo spraviť?
[X] sprav si novy vue projekt
[] daj si tam input na novu todo polozku
[] input si hookni na click, aby pridal do zoznamu v data novy item
[] zobraz itemy
[] itemom pridaj deleted atribut
[] ked je deleted, tak cez v-if sa schova
[] sprav druhu pagu kde budu zmazane veci"

Čo budem vedieť?
[X] vie si spravit novy vue projekt
[] vie tam robit pages
[] vie sa linkovat medzi pages
[] vie pouzivat @click a eventy
[] vie pouzivat v-if
[] vie pouzivat data, a vkladat ich do templatu
[] vie pouzivat v-for"

Vue2:
[] item sprav ako komponent, do ktoreho posles cely objekt (deleted a text)
[] sprav tlacitko ktore getne z mock serveru cez axios data
[] sprav tlacitko ktore postne na mock server cez axios data
[] sprav loadovanie do mounted
[] sprav savovanie po kazdej akcii v ui"

[] vie robit komponenty a vkladat ich do stranok
[] vie pouzivat parametre v komponentoch (props)
[] vie robit axios requesty
[] vie pouzivat mounted
[] vie robit methods, a menit data a obsah templates"	"todo list [] advanced

Vue3:
[] prerobit logiku dat do storu
[] prerobit loadovanie dat do storu
[] prerobit savovanie dat do storu
[] prerobit input komponent aby triggerol event v main ktory prida novu vec cez store
[] spravit novy screen ze detail polozky, kde bude sa dat upravovat text
[] dorobit moznost togglovat delete stav
[] spravit computed na vratenie len nezmazanych poloziek
[] spravit computed na pocet nezmazanych poloziek a zobrazit v UI"

[] vie robit story (mutations, actions, data, viac storov)
[] vie robit vlastne eventy v komponentoch
[] vie brat parametre z routy
[] vie pouzivat computed"	"todo list [] final

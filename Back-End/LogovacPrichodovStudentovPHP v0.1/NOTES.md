PHP1
Čo spraviť?
sprav logovac prichodov studentov
[X] nainstaluj si php nech vies servnut php script (php -S localhost:8000 nazovSuboru.php)
[X] sprav zakladny php skript, ktory vypise ahoj
[X] vypis aktualny datum a cas naformatovany
[X] ukladaj aktualny datum a cas do suboru (ak uz v subore existuje datum a cas, novy cas sa pripise), kazdy zaznam daj na novy riadok
[X] getuj obsah log suboru a vypis ho
[X] sprav tie veci co tu su cez funkcie ktore budu pomenovavat co sa robi, napriklad na ziskanie dat zo suboru nazves funkciu getLogs()
[X] ak prisiel student po 8:00, tak dopis do logu za cas dopis  string ""meskanie""
[X] sprav premennu v ktorej vyhodnotis ci nastalo meskanie a tuto premennu posileaj ako parameter do funkcie ktora zapisuje logy do suboru
[X] ak pride student medzi 20-24, tak vyhod chybu cez die, ze nemoze sa dany prichod zapisat

Čo budem vedieť?
[] instalacia mamp/etc
[X] index.php + localhost otvorit
[X] echo
[X] $variables + typy premennych (string, integer, double, …)
[X] spajanie premennych => scitavanie a matematicke operacie + string concat (spajanie stringov bodkou)
[X] function, parametre
[X] if, return
[X] die
[X] date()
[] file_get_contents, file_put_contents

PHP2
Čo spraviť?
dorob do logovacu moznost custom sprav
[X] pridaj form s inputom meno studenta, ktory sa bude submitovat cez POST
[X] dorob aby sa pri prichode logovalo aj meno studenta
[X] sprav aby to akceptovalo meno aj cez url adresu ze ?meno=jozko
[X] sprav studenti.json, kde sa budu ukladat studenti ktori prisli
[X] ak subor existuje tak loadni stary studenti.json, a pridaj novy zaznam
[X] incrementuj pri prichode studenta cislo v jsone, ktore bude reprezentovat celkovy pocet prichodov
[X] vypis obsah mapy studentov po decodovani pomocou print_r
[] sprav prichody.json, ktory bude len pole vsetkych prichodov, a rovnako ho appenduj decodovanim a encodovanim jsonu
[] preiteruj pole z prichody.json, a k meskajucim datumom napis ze ""meskanie""
[] funkcie, ktore suvisia s logovanim studenti.json, prerob do classy na staticke funkcie
[] funkcie, ktore suvisia s logovanim prichody.json, prerob do classy a funkcie pouzivaj tak ze najprv vytvoris instanciu classy (objekt)
[] v classe ktoru pouzivas ako instanciu, vytvor private metodu ktoru pouzijes ako nejaku pomocnu feature pri logovani (napriklad ziskavanie ci nastalo meskanie)"

Čo budem vedieť?
[] $_GET, $_POST
[] variables in string templates ""volam sa $meno""
[] array, mapa (associative array)
[] json_encode, json_decode
[] print_r
[] for, foreach
[] include
[] array_each, array_map, array_filter
[] classy (premenne, funkcie)
[] new class instance
[] static, public/private"



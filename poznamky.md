Poznámky:
[] <br> sa celkovo nepoužíva skoro vôbec. Jediné užitočné využitie by bolo napríklad pri paragrafoch, kde chceš dlhý text nejako oddeliť. Mimo toho je ale <br> zlé v tom, keď napríklad budeš chcieť riešiť responzivitu, aby sa ti napríklad 3 riadkový text zmenil na 4 riadkový, keď sa už nezmestí alebo aby to vyzeralo dobre.  Nechceš presne určovať kedy sa má text zlomiť a aj keby áno, tak to nie je ideálne riešenie. Na oddelovanie sa využíva margin  a padding  a pri responzivite zase napríklad flexbox, keď chceš dať niečo pod seba alebo pri menšom screene.

Extra small <576px	
Small ≥576px	
Medium ≥768px	
Large ≥992px	
X-Large ≥1200px	
XX-Large ≥1400px

.container	    100%	540px	720px	960px	1140px	1320px
.container-sm	100%	540px	720px	960px	1140px	1320px
.container-md	100%	100%	720px	960px	1140px	1320px
.container-lg	100%	100%	100%	960px	1140px	1320px
.container-xl	100%	100%	100%	100%	1140px	1320px
.container-xxl	100%	100%	100%	100%	100%	1320px
.container-fluid	100%	100%	100%	100%	100%	100%
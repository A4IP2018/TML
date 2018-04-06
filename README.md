# HOWTO

# Cuprins:

1. <a href="#teams">Teams</a>
	1. <a href="#frontend">FrontEnd</a>
	2. <a href="#backend">Backend</a>
	3. <a href="#qa">QA</a>
	4. <a href="#administrare">Administrare</a>
2. <a href="#github">Github</a>
3. <a href="#trello">Trello</a>
3. <a href="#xampp">XAMPP</a>
3. <a href="#laravel">Laravel</a>

<h1 id="teams">Teams</h1>
<h4 id="frontend">FrontEnd</h4>
Responsabilitati:

1. Responsive layout
2. Acelasi design si stil pe toate paginile
3. Crearea paginilor statice 
4. Testarea daca e responsive
5. Folosirea elementelor HTML5 (section, article, etc)
6. Sa fie comod design-ul

<h4 id="backend">BackEnd</h4>
Responsabilitati:

1. Crearea logicii pe server pentru fiecare pagina
2. Templating pentru datele oferite de server (se va folosi template engnine default din laravel)
3. Legatura cu baza de date, baza de date in sine
4. Comunicarea cu QA pentru crearea testelor

<h4 id="qa">QA</h4>
Responsabilitati:

1. HTML/CSS validare
2. Validare automata HTML/CSS
3. Testare de cod, posibil prin framework-uri de testare
4. Integrare continua (vezi Travis)

<h4 id="administrare">Administrare</h4>
Responsabilitati:

1. Merge conflicts
2. Pull requests review 
3. Intrebarile echipei
4. Decizii referitor la colaborari intre echipe
5. Organizarea repo-ului





<h1 id="github">Github</h1>
Git este un tool, github este o platforma care-ti permite sa folosesti acel tool online. Adica sa-ti salvezi repozitoriile locale la ei pe site, sa faci managing mai optim, plus e si un loc pentru backup-uri.

Linkuri utile pentru lenesi:
- [What is Git - A Quick Introduction to the Git Version Control System](https://www.youtube.com/watch?v=OqmSzXDrJBk) (4m)
- [Learn Git in 20 Minutes](https://www.youtube.com/watch?v=Y9XZQO1n_7c) (20m)
- [Common git commands in a day-to-day workflow](https://gist.github.com/jedmao/5053440) (text)
- [Creating a pull request](https://help.github.com/articles/creating-a-pull-request/) (text)

Terminologie:
- **branch**: o ramura o proiectului, independenta de celelalte branch-uri, pe care se poate face development. Branch-urile pot fi reunite, sterse, salvate fara a interfera cu celelalte. Ne va permite sa lucram independent, dar in acelasi timp sa putem uni tot ce am facut. Branch-ul principal, pe care va exista proiectul final testat si frumos se numeste **master**. Acolo ajung features finisate si testate. https://git-scm.com/book/en/v1/Git-Branching-What-a-Branch-Is
- **merge**: procesul de reunire a doua branch-uri. Daca avem pe dev 3 fisiere text, dar noi lucram pe branch-ul _text-files_ si editam acele fisiere, la moment ce executam comanda **git merge**, git-ul va avea grija sa adauge continutul nou in fisierele vechi de pe dev. Practic, integreaza schimbarile in aceleasi fisiere. https://git-scm.com/docs/git-merge
- **merge conflict** - la un moment dat va veti intalni cu cazuri in care git-ul nu poate intergra singur schimbarile in un fisier, adica exista conflicte intre codul vechi si codul nou, pe care va trebui sa le rezolvati singuri, prin a elimina portiunea din versiunea veche si a lasa portiunea din versiunea noua.
- **pull request** - informeaza toata echipa ca branch-ul vostru e gata de integrare in dev si ceilalti colegi trebuie sa aprobe schimbarile. Cred ca la moment 3 colegi trebuie sa aprobe requestul ca sa mearga mai departe.
- **master** - branch-ul pe care nu are acces nimeni, in el ajunge cod testat si gata pentru release.
- **dev** - branch-ul pe care lucreaza toti si se fac pull-requesturi. De aici se creaza branch-uri noi, daca aveti nevoie.

##### Cum incepi:
-  Downloadezi git https://git-scm.com/
-  Dupa instalare, deschizi git console si faci _cd_ in directorul unde ai vrea sa se afle proiectul
-  Executi comanda `git clone https://github.com/A4IP2018/HomeworkManager.git`. Aceasta va copia (clona) tot repozitoriul curent intr-un folder cu numele "HomeworkManager".

#####  Vom folosi github-ul in felul urmator:
- Cand se incepe crearea unui feature nou - se creaza un **branch nou**. Exemple de "features" ar fi o pagina noua, un modul nou pentru server, un buton adaugator pe pagina, dupa ce a fost terminata. Orice se face in plus - se face dintr-un branch nou. 
- Pentru orice _milestone_, adica orice progres considerat terminat se face un commit pe branch. Cand considerati ca ati terminat si s-a testat orice e posibil - se creeaza un pull request pentru dev, care trebuie aprobat de 3 alti membri ai echipei.
- Dupa ce se aproba requestul, feature-ul nou este inclus in dev.
- Dupa ce trece de testare, este inclus in master.
 
##### Exemplu
- `git checkout dev`. Ma muta pe dev.
- `git pull origin dev`. Downloadeaza toate schimbarile facute de colegii vostri si salvate pe dev. Inainte sa incepeti ceva nou trebuie sa fiti la zi cu ce s-a facut deja.
- Execut comanda `git checkout -b readme_edit`. `git checkout <name>` te muta pe branch-ul _name_, iar `-b` te muta intr-un branch nou creat cu acel nume. Obtin o copie identica a proiectului, cu care pot face ce doresc, fara ca sa distrug ceva.
- In cazul meu, vreau sa editez readme-ul, deci se numeste `readme_edit`. Fac asta.
- Dupa ce sunt fericit cu ce am facut, dau `git add .` ce-mi permite sa salvez schimbarile locale. Nu evitati aceasta comanda. Daca va mutati inapoi pe alt branch, schimbarile n-o sa fie salvate daca nu o folositi. 
- `git commit -m "Am adaugat tutorial pentru github"`. Commit inseamna salvarea finala in repositoriu a schimbarilor. "Povestea" unui repo se zice in commituri. Autor, data, ce schimbari s-a facut. Add+Commit se face dupa orice schimbare considerabila care functioneaza.
- `git push origin readme_edit` Trimit schimbarile catre _origin_ (este repositoriul remote de pe github) pe branch-ul _readme_edit_. Dupa aceasta comanda, toata echipa poate vedea ca acest branch exista (pana acum era doar local) si ce schimbari s-au facut.
- Fac **pull request** si astept aprobare de la colegi.


<h1 id="trello">Trello</h1>

Trello este o platforma de colaborare pe care membrii echipelor isi pot organiza task-urile, pentru a vedea cu usurinta ce elemente se afla in proces de dezvoltare, cine lucreaza la o anumita componenta si in ce stadiu se afla acel task.

##### Cum folosim aceasta platforma?

- **Add another list**: pentru adaugarea unei noi categorii de task-uri.
- **Add another card**: pentru adaugarea unui nou task din cadrul unei categorii de task-uri.

##### Optiunile din cadrul unui task

- **Members**: adaugarea membrilor ce fac parte din acel task.
- **Labels**: asa cum a fost configurat proiectul pe pagina de Trello, vom folosi aceste etichete pentru a evidentia stadiul in care se afla acel task; spre exemplu, in momentul scrierii acestui tutorial, task-ul `Tutorial Trello` este setat pe Label-ul `PRIORITY` (verde deschis), iar dupa finalizare, va fi setat pe `DONE` (verde inchis). Daca doriti sa adaugati noi Label-uri, luati mai intai legatura cu unul dintre administratori pentru aprobare.
- **Checklist**: se creeaza o lista de tip checklist, in care putem adauga mai multe iteme care, dupa finalizare, le vom putea marca. Spre exemplu, am creat in cadrul task-ului `Tutorial Trello` un element de tip Checklist ce contine doua iteme: `Started Trello tutorial` si `Finished Trello tutorial`. Primul este bifat, iar al doilea nu. Bara de deasupra ne spune in ce stadiu se afla task-ul respectiv (la 50% pentru exemplul dat).
- **Due Date**: asa cum ii spune si numele, putem seta data pana la care trebuie sa fie gata acel task.
- **Attachment**: putem incarca diferite fisiere.
- **Add Comment**: putem adauga comentarii la acel task. Pentru a da `tag` unei persoane, folosim caracterul `@` urmat de numele/username-ul acelei persoane. Se pot adauga, de asemenea, fisiere, emoji-uri sau link-uri catre alte task-uri din cadrul proiectului.

<h1 id="xampp">XAMPP</h1>

##### Descriere

- XAMPP este o distributie Apache gratuita folosita pentru crearea serverelor web locale.

##### Instalare/Configurare

- Se poate downloada o versiune XAMPP aici: https://www.apachefriends.org/download.html
- Pentru acest proiect, se va downloada si instala versiunea 5.6.34 care va instala aceeasi versiune PHP.
- La instalarea aplicatiei putem instala doar componentele **Apache**/**MySQL**/**PHP**/**phpMyAdmin**. Orice alta componenta instalata reprezinta un risc in buna functionare a aplicatiei, din cauza porturilor folosite. Trebuie mare grija.
- Directorul default de instalare este **C:\xampp**. Acesta poate ramane asa.
- Dupa instalarea aplicatiei, un fisier **C:\xampp\htdocs** va aparea. Din motive pur conventionale, vom avea proiectul nostru in acest fisier **htdocs**(**H**yper**T**ext **Doc**uments). Aici putem rula comanda `git clone https://github.com/A4IP2018/HomeworkManager.git` pentru a aduce proiectul.
- Ca serverul Apache sa pointeze catre proiectul nostru, trebuie sa ii schimbam putin configurarea: Deschizand **XAMP**, putem schimba configurarile de baza ale serverului Apache ducandu-ne la **Config** (in dreptul Apache) si deschizand fisierul **httpd.conf** ( http://prntscr.com/j1oiv5 ). In acest fisier, trebuie sa cautam (ctrl + F) **DocumentRoot** si sa schimbam calea default **C:/xampp/htdocs** in **C:/xampp/htdocs/HomeworkManager** ( http://prntscr.com/j1oksk).

<h1 id="laravel">LARAVEL</h1>

##### Descriere

- Laravel este un framework PHP gratis si open-source bazat pe arhitecura **MVC**(Model-View-Controller)
- Pentru acest proiect, se va folosii versiunea 5.4 ( https://laravel.com/docs/5.4 )

##### Configurare

- Atunci cand cineva introduce o noua dependenta via composer, trebuie ca toata lumea, din folderul proiectului, sa ruleze comanda `composer install`, ceea ce v-a instala local toate dependentele adaugate. Exista si comanda `composer update` pe care o putem folosii, dar nu este indicata deoarece pe langa instalarea dependentelor, le si updateaza la versiuni mai noi, astfel lasand loc pentru buguri. Aceasta comanda, `composer install` **TREBUIE** rulata si la aducerea initiala a proiectului.
- **.env** este fisierul de configurare al aplicatiei, tot ceea ce inseamna parole secrete sau configurari se vor pune aici.
- Atunci cand se aduce prima data proiectul, sau cineva face o modificare in **.env.example**, acest fisier **TREBUIE** copiat si pus in directorul proiectului sub numele de **.env**. Acest fisier **.env** NU se va comite, el este doar pentru configurarea locala.
- Atunci cand cineva modifica **.env** si adauga o noua variabila, **TREBUIE** sa o adauge si in **.env.example**, **FARA** a specifica valoarea acelei variabile, deoarece **.env.example** este fisierul care se va comite pe server, **.env** este fisierul care ramane local.
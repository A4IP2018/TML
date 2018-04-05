# HOWTO

# Github
Git este un tool, github este o platforma care-ti permite sa folosesti acel tool online. Adica sa-ti salvezi repozitoriile locale la ei pe site, sa faci managing mai optim, plus e si un loc pentru backup-uri.

Linkuri utile pentru lenesi:
- https://www.youtube.com/watch?v=OqmSzXDrJBk (4m)
- https://www.youtube.com/watch?v=Y9XZQO1n_7c (20m)
- https://gist.github.com/jedmao/5053440 (text)

Terminologie:
    - **branch**: o ramura o proiectului, independenta de celelalte branch-uri, pe care se poate face development. Branch-urile pot fi reunite, sterse, salvate fara a interfera cu celelalte. Ne va permite sa lucram independent, dar in acelasi timp sa putem uni tot ce am facut. Branch-ul principal, pe care va exista proiectul final testat si frumos se numeste **master**. Acolo ajung features finisate si testate. https://git-scm.com/book/en/v1/Git-Branching-What-a-Branch-Is
    - **merge**: procesul de reunire a doua branch-uri. Daca avem pe _master_ 3 fisiere text, dar noi lucram pe branch-ul _text-files_ si editam acele fisiere, la moment ce executam comanda **git merge**, git-ul va avea grija sa adauge continutul nou in fisierele vechi de pe master. Practic, integreaza schimbarile in aceleasi fisiere. https://git-scm.com/docs/git-merge
    - **merge conflict** - la un moment dat va veti intalni cu cazuri in care git-ul nu poate intergra singur schimbarile in un fisier, adica exista conflicte intre codul vechi si codul nou, pe care va trebui sa le rezolvati singuri, prin a elimina portiunea din versiunea veche si a lasa portiunea din versiunea noua.
    - **pull request** - informeaza toata echipa ca branch-ul vostru e gata de integrare in master si ceilalti colegi trebuie sa aprobe schimbarile. Cred ca la moment 3 colegi trebuie sa aprobe requestul ca sa mearga mai departe.

##### Cum incepi:
-  Downloadezi git https://git-scm.com/
-  Dupa instalare, deschizi git console si faci _cd_ in directorul unde ai vrea sa se afle proiectul
-  Executi comanda `git clone https://github.com/A4IP2018/HomeworkManager.git`. Aceasta va copia (clona) tot repozitoriul curent intr-un folder cu numele "HomeworkManager".

#####  Vom folosi github-ul in felul urmator:
  - Cand se incepe crearea unui feature nou - se creaza un **branch nou**. Exemple de "features" ar fi o pagina noua, un modul nou pentru server, un buton adaugator pe pagina, dupa ce a fost terminata. Orice se face in plus - se face dintr-un branch nou. 
  - Pentru orice _milestone_, adica orice progres considerat terminat se face un commit pe branch. Cand considerati ca ati terminat si s-a testat orice e posibil - se creeaza un pull request pentru master, care trebuie aprobat de 3 alti membri ai echipei.
  - Dupa ce se aproba requestul, feature-ul nou este inclus in master.
 
##### Exemplu
  - `git checkout master`. Ma muta pe master.
  - `git pull origin master`. Downloadeaza toate schimbarile facute de colegii vostri si salvate pe master. Inainte sa incepeti ceva nou trebuie sa fiti la zi cu ce s-a facut deja.
  - Execut comanda `git branch -b readme_edit`. `git branch <name>` te muta pe branch-ul _name_, iar `-b` te muta intr-un branch nou creat cu acel nume. Obtin o copie identica a proiectului, cu care pot face ce doresc, fara ca sa distrug ceva.
  - In cazul meu, vreau sa editez readme-ul, deci se numeste `readme_edit`. Fac asta.
  - Dupa ce sunt fericit cu ce am facut, dau `git add .` ce-mi permite sa salvez schimbarile locale. Nu evitati aceasta comanda. Daca va mutati inapoi pe alt branch, schimbarile n-o sa fie salvate daca nu o folositi. 
  - `git commit -m "Am adaugat tutorial pentru github"`. Commit inseamna salvarea finala in repositoriu a schimbarilor. "Povestea" unui repo se zice in commituri. Autor, data, ce schimbari s-a facut. Add+Commit se face dupa orice schimbare considerabila care functioneaza.
  - `git push origin readme_edit` Trimit schimbarile catre _origin_ (este repositoriul remote de pe github) pe branch-ul _readme_edit_. Dupa aceasta comanda, toata echipa poate vedea ca acest branch exista (pana acum era doar local) si ce schimbari s-au facut.
  - Fac **pull request** si astept aprobare de la colegi.



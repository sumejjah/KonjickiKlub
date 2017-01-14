# KonjickiKlub

Sumejja Halilović, 17126

Prikaz novosti i informacija o konjičkom klubu te mnogih zanimljivosti o konjima, mogućnost postavljanja pitanja te zakazivanja termina jahanja. 

Spirala I


I - Šta je urađeno?

	a)Skice: urađeno

	b)Stranice responzivne i imaju grid view izgled: urađeno

	c)Izgled i skice za mobilne uređaje: urađeno

	d)Implementirati forme: urađeno (forma za slanje iskustva, forma za postavljanje pitanja i forma za anketu)

	e)Implementirati meni web stranice: urađeno

	f)Izgled stranice treba biti konzistentan, bez glitcheva, elementi na stranici trebaju biti poravnati: urađeno

II - Šta nije urađeno?
/

III - Bug-ovi koje ste primijetili ali niste stigli ispraviti, a znate rješenje (opis rješenja)
Nisam primijetila bug-ove.

IV  - Bug-ovi koje ste primijetili ali ne znate rješenje
/

V  - Lista fajlova u formatu NAZIVFAJLA - Opis u vidu jedne rečenice šta se u fajlu nalazi
Mockup - folder u kojem se nalaze skice za sve stranice, za sve uredjaje
WT zadaca1 - 
			
			-css - folder sa svim .css-ovima
			
			-images - sve fotografije koje su koristene
			
			ostatak foldera:
			
			zadaca.html - html kod za pocetnu stranicu
			
			oNama.html - html kod za prikaz historije KK
			
			ponuda.html - html kod za prikaz aktivnosti i onoga sto klub nudi
			
			posaljiPricu.html - html kod; korisnik salje pricu o svome iskustvu vezanom za jahanje
			
			ocjena.html - korisnik moze ocijeniti kvalitetu kluba i stranice (pitanja cu vjerovatno promijeniti)
			
			kontakt.html - informacije o klubu tipa broj telefona, adresa...
			
			galerija.html - prikaz fotografija 
			

Spirala 3


	I - Napravljena serijalizacija podataka na formama za popunjavanje ankete (ocjena.php) i formi za unos komentara (posaljiPricu.php).
	Za sad, samo se moze logovati administrator (username: admin, password: password). Kada se loguje na podstranici ponuda.php se ispise tabela ponuda koju je moguce mijenjati.
	Urađena je validacija.
	
	II - Admin može downloadovati tabelu koja sadrzi ponude (cijene i termine). Podaci se citaju iz .xmla
	
	III - Također je moguće dowloadovati ovu tabelu i u .pdf formatu. Podaci se citaju iz -xmla.
	
	IV - Napravljena opcija pretrage, pretrazuju se ostavljeni komentari. U komentari.xml se cuvaju svi komentari. Pretraga se vrsi pomocu autora komentara i samog teksta komentara.
	
	Deployment: http://konjickiklubshitf-konjickiklub.44fs.preview.openshiftapps.com/
	
	
	
SPIRALA V

I - Šta je urađeno?
a) Dodane su tri baze: administrator, usluga i komentar. Usluga ima FK na administratora (kako bi se znalo ko je dodao uslugu), a komentar ima FK na uslugu (kako bi se znalo koja usluga se komentarise).
b) Na formi ponuda (samo) administrator moze vidjeti dugme "Ucitaj u bazu". Podaci ce se ucitati samo jednom.
c) Prepravila sam sve PHP skripte tako da se podaci cuvaju i kupe iz baze a ne iz XML-a.
d) Deployment:
e) Unutar skripte vratiJSON.php predstavlja traženu metodu. 
f) U folderu POSTMANscreenshot su screenshoti za tri tabele: usluga, anketa i komentar.

II - Sta nije urađeno?
Depolyment.

III - Bug-ovi koje ste primijetili ali niste stigli ispraviti, a znate rješenje (opis rješenja)
/
IV  - Bug-ovi koje ste primijetili ali ne znate rješenje
/
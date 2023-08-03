-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2023 at 11:18 PM
-- Wersja serwera: 10.4.28-MariaDB
-- Wersja PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sklep2`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `klienci`
--

CREATE TABLE `klienci` (
  `ID` int(11) NOT NULL,
  `login` varchar(20) NOT NULL,
  `haslo` char(66) NOT NULL,
  `email` varchar(30) NOT NULL,
  `imie` varchar(20) NOT NULL,
  `nazwisko` varchar(30) NOT NULL,
  `miejscowosc` varchar(30) NOT NULL,
  `ulica` varchar(30) NOT NULL,
  `numer_domu` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `klienci`
--

INSERT INTO `klienci` (`ID`, `login`, `haslo`, `email`, `imie`, `nazwisko`, `miejscowosc`, `ulica`, `numer_domu`) VALUES
(7, 'Tomek1', 'ba7816bf8f01cfea414140de5dae2223b00361a396177a9cb410ff61f20015ad', 'tomek@wp.pl', 'Tomek', 'Kowal', 'Białystok', 'Krzywa', '2');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `produkty`
--

CREATE TABLE `produkty` (
  `ID` int(11) NOT NULL,
  `nazwa` varchar(50) NOT NULL,
  `marka` varchar(30) NOT NULL,
  `waga` decimal(5,3) NOT NULL,
  `cena` decimal(5,2) NOT NULL,
  `zdjecie` varchar(100) NOT NULL,
  `opis_szczegolowy` varchar(4000) NOT NULL,
  `promocja` enum('tak','nie') NOT NULL,
  `kategoria` varchar(30) NOT NULL,
  `pod_kategoria` varchar(30) NOT NULL,
  `dostepna_ilosc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `produkty`
--

INSERT INTO `produkty` (`ID`, `nazwa`, `marka`, `waga`, `cena`, `zdjecie`, `opis_szczegolowy`, `promocja`, `kategoria`, `pod_kategoria`, `dostepna_ilosc`) VALUES
(0, 'Josera Classic z łososiem', 'Josera ', 10.000, 85.99, 'photo_product\\kot_karma.png', 'Josera z łososiem dla dorosłych kotów.\r\n \r\n\r\nPolecana dla wszystkich aktywnych kotów dorosłych, żyjących w domu i na zewnątrz.\r\n\r\nReceptura zawiera niezbędne do życia i zdrowia ważne składniki odżywcze i gwarantowaną jakość.\r\n\r\nBez konserwantów, sztucznych barwników i aromatów, bez dodatku soi, pszenicy, cukru oraz produktów mlecznych.\r\n \r\n\r\nSkład:\r\n\r\nzboże, mięso i produkty pochodzenia zwierzęcego, oleje i tłuszcze, roślinne produkty uboczne, ryby i rybne produkty uboczne (mączka z łososia 4%), substancje mineralne.\r\n\r\n \r\n\r\nDodatki:\r\n\r\nWitamina A  18000 j.m\r\n\r\nWitamina D3  1800 j.m\r\n\r\nWitamina E  200 mg\r\n\r\nWitamina B1  15 mg\r\n\r\nWitamina B2  20 mg\r\n\r\nWitamina B6 20 mg\r\n\r\nWitamina B12  100 mcg\r\n\r\nKwas pantotenowy  50 mg\r\n\r\nNiacyna  90 mg\r\n\r\nKwas foliowy 5 mg\r\n\r\nBiotyna  340 mcg\r\n\r\nTauryna  1000 mg\r\n\r\nŻelazo (siarczan żelaza (II), jednowodny)  200 mg\r\n\r\nCynk (uwodniony chelat glicyny Zn)  160 mg\r\n\r\nMangan (jako tlenek manganu)  16 mg\r\n\r\nMiedź (uwodniony chelat glicyny Cu)  20 mg\r\n\r\nJodu (jodek wapnia)  2,00 mg\r\n\r\nSelenu (selenin sodu)  0,25 mg\r\n\r\n \r\n\r\nSkładniki analityczne:\r\n\r\nBiałko 29,5 %\r\n\r\nZawartość tłuszczu 13,5 %\r\n\r\nWłókno surowe 2,4 %\r\n\r\nPopiół surowy 7,1 %\r\n\r\nWapń 1,35 %\r\n\r\nFosfor 1,00 %', 'nie', 'kot', 'karma', 9),
(1, 'Whiskas Sterile z kurczakiem', 'Whiskas ', 1.400, 25.00, 'photo_product\\kot_karma2.png', 'Whiskas STERILE dla kotów wykastrowanych i po sterylizacji.\r\n\r\nKoty wykastrowane lub po sterylizacji mają tendencję do problemow z drogami moczowymi. Nowy Whiskas STERILE jest starannie przygotowany z wysokiej jakości składników, które nie tylko wspaniale smakują, ale także prawidłowo zaspokajają potrzeby żywieniowe kotów wykastrowanych lub po sterylizacji.\r\n\r\nzdrowe drogi moczowe - zbilansowane składniki mineralne utrzymują w zdrowiu drogi moczowe Twojego kota\r\nutrzymanie optymalnej wagi\r\nzdrowe trawienie\r\nspecjalne opracowanie karmy pomaga w utrzymaniu zdrowych zębów\r\nwitamina A dla zachowania doskonałego wzroku\r\nnaturalne tłuszcze nadają sierści piękny połysk\r\n\r\nSkład:\r\nZboża, mięso i produkty pochodzenia zwierzęcego (w tym 4% kurczaka w jasnobrązowych granulkach, w tym 4% wątróbki w nadzieniu pasztecika), roślinne ekstrakty białkowe, produkty pochodzenia roślinnego (w tym 0,5% ekstraktu z cykorii, w tym 0,03% yucca schidigera), oleje i tłuszcze (w tym 0,1% oleju słonecznikowego), substancje mineralne, warzywa (w tym 4% marchewki w pomarańczowych granulkach, w tym 4% groszku w zielonych granulkach)\r\n\r\nAnaliza:\r\nBiałko 32%, Tłuszcz 11%, materia nieorganiczna 8%, włókno surowe 1,5%, wapń 1,1%, fosfor 1%, tauryna 1100 mg/kg', 'nie', 'kot', 'karma', 3),
(2, 'Friskies sterilised', 'Friskies', 1.500, 22.29, 'photo_product\\kot_karma3.png', 'Zbilansowana i pełnowartościowa sucha karma, która pomoga zachować właściwą masę ciała u kotów sterylizowanych.\r\n\r\nZawiera wszystkie niezbędne składniki żywieniowe: wysokiej jakości białka, witaminy oraz zbilansowany poziom składników mineralnych, które pomagają w utrzymaniu zdrowych dróg moczowych.\r\n\r\nChrupiące granulki Friskies to pełnoporcjowy i zbilansowany posiłek na każdy dzień.\r\n \r\n\r\nSkład:\r\n\r\nZboża, roślinne ekstrakty białkowe, mięso i produkty pochodzenia zwierzęcego, produkty pochodzenia roślinnego, oleje i tłuszcze, ryby i produkty rybne (1.2%*), składniki mineralne, drożdże, warzywa (zielone, pomarańczowe i żółte granulki: 0.13% suszonych warzyw – odpowiada 1% warzyw).\r\n\r\n \r\n\r\n*Odpowiada 4% nawodnionego łososia w czerwonych i brązowych granulkach.\r\n\r\n \r\n\r\nDodatki:\r\nIU/kg: Wit A 12 500; Wit D3 1 000; Wit E: 115\r\n\r\nmg/kg: Fe(E1) 145; I(E2) 2,5; Cu(E4) 35; Mn(E5) 16; Zn(E6) 183; Se(E8) 0,25; Tauryna 870.\r\n\r\nZ barwnikami i przeciwutleniaczami.\r\n\r\n \r\n\r\nSkładniki analityczne:\r\nBiałko: 32.0%\r\nOleje i tłuszcze: 8.0%\r\nPopiół surowy: 7.0%\r\nWłókno surowe: 4.5%', 'nie', 'kot', 'karma', 2),
(3, 'Cat Chow Special Care 3w1', 'Purina ', 1.500, 34.20, 'photo_product\\kot_karma4.png', 'Sucha karma Cat Chow® Special Care 3w1 zmniejsza osadzanie się kamienia nazębnego nawet o 40%, wspiera zdrowie układu moczowego oraz zapobiega tworzeniu się kul włosowych w przewodzie pokarmowym.\r\n\r\nBogata w mięso z indyka, zawiera wszytkie składniki odżywcze niezbędne do zachowania zdrowia kotów - wspomaga naturalną odporność kota.\r\n \r\nFormuła Cat Chow Naturium to specjalne połączenie włókna pokarmowego z naturalnych źródeł i prebiotyków, które poprawiają równowagę mikroflory jelitowej i wspomagają zdrowie układu pokarmowego.\r\n \r\n\r\nSkład:\r\n\r\nzboża (34% pełnoziarniste*), mięso i produkty pochodzenia zwierzęcego (20%**), roślinne ekstrakty białkowe, produkty pochodzenia roślinnego (5.4% suszona pulpa buraczana, 0.07% suszona pietruszka - odpowiednik 0.4% pietruszki*), oleje i tłuszcze, warzywa* (2% suszony korzeń cykorii, 0.07% suszona marchew - odpowiednik 0.4% marchwi, 0.07% suszony szpinak - odpowiednik 0.4% szpinaku), składniki mineralne, drożdże* (0.3%).\r\n\r\n \r\n\r\n* Naturalne składniki\r\n** odpowiednik 40 % nawodnionego mięsa i produktów pochodzenia zwierzęcego, min. 14 % indyka.\r\n\r\n \r\n\r\nSkładniki analityczne:\r\n\r\nBiałko 32.0 %\r\n\r\nOleje i tłuszcze surowe 11.0 %\r\n\r\nPopiół surowy 7.5 %\r\n\r\nWłókno surowe 5.5 %', 'nie', 'kot', 'karma', 3),
(4, 'Miamor Kitten z drobiem w galaretce', 'MIAMOR', 0.100, 1.99, 'photo_product\\kot_karma5.png', 'Kruche kawałki mięsne w pysznej, delikatnej galaretce stworzone specjalnie dla kociąt:\r\n\r\nbardzo wysoka zawartość mięsa (60%),\r\nbogate w witaminy i składniki mineralne - najwyższa jakość,\r\nbez barwników, sztucznych konserwantów i aromatów\r\nDodatki: witamina D3 (100 IE/kg), witamina E (10 mg/kg).\r\n\r\nAnaliza:\r\nTłuszcz surowy - 5.0 %\r\nBiałko surowe - 9.0 %\r\nWilgotność - 82.0 %\r\nPopiół surowy - 2.5 %\r\nWłókno surowe - 0.5 %\r\n\r\nSmak: kurczak', 'nie', 'kot', 'karma', 1),
(5, 'Royal Canin Kitten - galaretka', 'Royal Canin ', 0.085, 4.40, 'photo_product\\kot_karma6.png', 'Royal Canin  Kitten Instinctive\r\n \r\n\r\nRozwiązanie żywieniowe opracowane specjalnie dla kociąt w drugim etapie wzrostu, od 6 do 12 miesiąca życia oraz kotek w ciąży.\r\n\r\nPrecyzyjnie dobrany skład wspomaga mechanizmy obronne organizmu, zapewnia prawidłowy, harmonijny rozwój kociąt. Receptura odpowiada również wysokim wymaganiom pokarmowym kotek w ciąży.\r\n\r\nDba o prawidłowy przebieg procesów trawiennych, stymuluje wzrost pożytecznej mikroflory jelitowej, zwalcza szkodliwe bakterie.\r\n \r\n\r\nSkład:\r\n\r\nmięso oraz produkty pochodzenia zwierzęcego, roślinne ekstrakty białkowe, minerały, mleko i produkty pochodne mleka, produkty pochodzenia roślinnego, oleje i tłuszcze, drożdże, cukry.\r\n\r\n \r\n\r\nDodatki dietetyczne:\r\n\r\nWitamina D3: 290 UI, E1 (Żelazo): 1,3 mg, E2 (Jod): 0,4 mg, E4 (Miedź): 3 mg, E5 (Mangan): 0,4 mg, E6 (Cynk): 4 mg.\r\n\r\n \r\n\r\nSkładniki analityczne:\r\n\r\nBiałko surowe: 12% - Oleje i tłuszcze surowe: 4% - Popiół surowy: 1,7% - Włókno surowe: 0,7% - Wilgotność: 80%.', 'nie', 'kot', 'karma', 4),
(6, 'Royal Canin Sterilised w sosie', 'Royal Canin ', 0.085, 3.96, 'photo_product\\kot_karma7.png', 'Mięsne kawałki w smakowitym sosie dla dorosłych kotów po sterylizacji.\r\n\r\nOdpowiednie proporcje składników pokarmowych wspierają prawidłowe funkcjonowanie układu moczowego kotów po sterylizacji, poprawiają przebieg procesu trawienia i utrzymują prawidłową mikroflorę jelit.\r\n\r\nAby utrzymać idealną masę ciała zredukowano ilość tłuszczu, zwiększono zawartość wysoko przyswajalnego białka o wysokiej wartości biologicznej, które w połączeniu z L-karnityną jest źródłem energii dla mięśni jednocześnie redukując tkankę tłuszczową.\r\n \r\n\r\nSkład:\r\n\r\nmięso oraz produkty pochodzenia zwierzęcego, zboża, roślinne ekstrakty białkowe, minerały, produkty pochodzenia roślinnego, cukry.\r\n\r\n \r\n\r\nDodatki dietetyczne:\r\n\r\nWitamina D3: 73 UI, E1 (Żelazo): 11 mg, E2 (Jod): 0,55 mg, E4 (Miedź): 4,5 mg, E5 (Mangan): 3 mg, E6 (Cynk): 30 mg.\r\n\r\n \r\n\r\nSkładniki analityczne:\r\n\r\nBiałko surowe: 9% - Oleje i tłuszcze surowe: 2,1% - Popiół surowy: 1,5% - Włókno surowe: 1,5% - Wilgotność: 82,5%.  ', 'tak', 'kot', 'karma', 9),
(7, ' Animonda Cat Carny INDYK Z KRÓLIKIEM', 'Animonda', 0.200, 3.75, 'photo_product\\kot_karma8.png', '100% wyłącznie wysokowartościowe mięso, ponieważ koty posiadają niezwykłą zdolność rozpoznawania jakości mięsa.\r\n\r\nŚwieże i soczyste kawałki mięsa, delikatnie przygotowane aby zachować wszystkie ważne składniki odżywcze i budulcowe.\r\n\r\nProdukt naturalny o smaku prawdziwego mięsa, z naturalną tauryną.\r\n\r\nBez konserwantów, bez dodatków chemicznych, bez sztucznych barwników i dodatków smakowych, bez soi lub surowców modyfikowanych genetycznie.\r\n \r\n\r\n \r\n\r\nSkład:\r\n\r\n45% wołowina (mięso, płuca, serca, nerki, wymiona), 31% rosół, 16% indyk (wątroba, serce), 6% królik, węglan wapnia.\r\n\r\n \r\n\r\nAnaliza:\r\n\r\nBiałko 11,5%\r\n\r\nTłuszcz 5%\r\n\r\nBłonnik 0,5%\r\n\r\nPopiół 1,4 %\r\n\r\nWilgotność 79%', 'nie', 'kot', 'karma', 6),
(8, 'Legowisko na kaloryfer', 'Trixie', 0.500, 64.00, 'photo_product\\kot_lezanki.png', 'Super legowisko dla kota na kaloryfer w kolorze beżowym\r\nna każdy typ kaloryfera\r\nlegowisko przyjemnie pluszowe\r\nstabilne, dzięki metalowemu stelażowi\r\nWymiary:\r\n48x26x30cm', 'nie', 'kot', 'lezanki', 3),
(9, 'Trixie legowisko biało-czerwone', 'Trixie', 0.300, 40.50, 'photo_product\\kot_lezanki2.png', 'Legowisko dla kota lub małych piesków\r\n\r\nZ jednej strony pokrycie z nylonu\r\nZ drugiej strony jest ciepła imitacja jagnięcego futra.\r\nWypełnione pianką\r\nŁatwe w pielęgnacji\r\nRozmiar: 45X30cm', 'nie', 'kot', 'lezanki', 4),
(10, 'Trixie Legowisko na parapet ', 'Trixie', 0.150, 66.80, 'photo_product\\kot_lezanki3.png', ' TRIXIE legowisko dla kotów.\r\n \r\nPrzytulne miejsce dla kota, do zamocowania na parapecie przy oknie.  \r\nZdejmowane pluszowe obszycie, które można prać w pralce w temperaturze do 30 stopni.', 'nie', 'kot', 'lezanki', 2),
(11, 'Trixie Koc Beany 100 x 70cm bordo', 'Trixie', 0.300, 16.99, 'photo_product\\kot_lezanki4.png', 'Koc do ochrony mebli\r\n• miękki, przytulny polar\r\n• chroni meble przed zabrudzeniem i sierścią zwierząt\r\n\r\n\r\n\r\nWymiary: 100 x 70cm\r\n             \r\nKolor: bordowy z wzorkiem ryby', 'nie', 'kot', 'lezanki', 4),
(12, 'Super Benek Compact Lawenda', 'Benek ', 10.000, 32.00, 'photo_product\\kot_zwirki.png', '  COMPACT  - naturalny zapach lawendy.\r\n\r\n \r\n\r\nBentonitowy żwirek do kociej toalety.\r\n\r\n \r\n\r\n \r\n\r\nCharakteryzuje się drobnym regularnym uziarnieniem (0,5-2 mm).\r\n\r\nZastosowana technologia produkcji zapewnia wysoką chłonność, doskonałą wydajność i długą eksploatację produktu.\r\n\r\nŻwirek bardzo dobrze się zbryla tworząc foremne, małe i płaskie grudki.\r\n \r\n\r\nOlejki lawendy mają przyjemny i uspokajający zapach, działają aseptycznie oraz likwidują napięcia nerwowe.\r\n \r\n\r\nPolecany szczególnie dla zwierząt młodych, bardzo ruchliwych, często przebywających na zewnątrz. ', 'nie', 'kot', 'zwirki', 11),
(13, 'Super Benek Economic', 'Benek ', 10.000, 16.42, 'photo_product\\kot_zwirki2.png', ' \r\n\r\nWysokiej jakości żwirek bentonitowy o dobrych właściwościach sorpcyjnych i dużej wydajności.\r\n\r\nStarannie dobrana formuła - gruby i drobny granulat zapewnia niskie zużycie i doskonałą zdolność do pochłaniania zapachów i wilgoci.\r\n\r\nOpakowanie wystarcza dla jednego kota na około 60 dni. ', 'nie', 'kot', 'zwirki', 15),
(14, 'Super Benek Lawenda', 'Benek ', 10.000, 31.00, 'photo_product\\kot_zwirki3.png', 'Polecany szczególnie dla zwierząt młodych, bardzo ruchliwych, często przebywających na zewnątrz, ponieważ olejki lawendy działają aseptycznie oraz likwidują napięcia nerwowe. \r\n\r\nŻwirek bentonitowy o regularnych, grubych ziarnach o wymiarach 1 - 4mm, zbrylając się tworzy regularne, zwarte bryłki.\r\n\r\nBardzo chłonny, bezpyłowy granulat, nieprzywierający do dna kuwety.\r\n\r\nSkutecznie pochłania płyny i przykre zapachy zapewniając dobrą ochronę antybakteryjną.', 'nie', 'kot', 'zwirki', 18),
(15, 'Benek Miluś Żwirek morski', 'Benek ', 5.000, 9.24, 'photo_product\\kot_zwirki4.png', ' \r\n\r\n \r\n\r\nMieszana frakcja granulatu wielkości 0,5mm - 4mm.\r\n\r\nCharakteryzuje się wysoką wydajnością oraz zdolnością pochłaniania zapachów i wilgoci.\r\n\r\nStarannie skomponowana formuła zapachowa uwalnia się w trakcie eksploatacji żwirku, pozostawiając wokół kuwety przyjemny aromat lubiany przez koty.', 'nie', 'kot', 'zwirki', 22),
(16, 'Josera Kids Karma Junior ', 'Josera ', 15.000, 144.78, 'photo_product\\pies_karma.png', 'Josera  z drobiem, receptura bezglutenowa, większy rozmiar krokietów.\r\n\r\n \r\n\r\nPrzeznaczona dla rozwijających się szczeniąt i młodych psów ras średnich i dużych od 8 tygodnia życia - może być stosowana aż do osiągnięcia dorosłości.\r\n\r\nNadaje się dla psów o mocnej budowie ciała (np. Bernardyn), wspiera zrównoważony wzrost, mocne kości i zdrowe stawy.\r\n\r\n\r\nSkład:\r\n\r\nmączka drobiowa, kukurydza pełnoziarnista, ryż, wysłodki buraczane, tłuszcz drobiowy, hydrolizowane białko drobiowe, minerały, drożdże piwne, mączka z cykorii, mączka z małży.', 'tak', 'pies', 'karma', 20),
(17, 'Brit Care Puppy All Lamb & Rice', 'Brit', 12.000, 144.89, 'photo_product\\pies_karma2.png', 'Hipoalergiczna, bez soi, pszenicy, kukurydzy, wołowiny, wieprzowiny i GMO.\r\n\r\nZawiera ostropest plamisty, który posiada właściwości oczyszczające, antybakteryjne i przeciwzapalne. Wzmacnia odporność oraz czynności samonaprawcze organizmu. Wspiera metabolizm - regeneruje watrobę i poprawia jej funkcjonowanie.\r\n\r\nSkład:\r\n\r\nmączka z jagnięciny (45%), ryż (30%), tłuszcz z kurczaka (konserwowany tokoferolem), suszone jabłka, olej z łososia (3%), naturalne aromaty, drożdże browarniane, hydrolizat muszli skorupiaków (źródło glukozaminy 320 mg/kg), ekstrakt z chrząstki (źródło chondroityny 190 mg/kg), mannanooligosacharydy (180 mg/kg), zioła i owoce (rozmaryn, goździki, owoce cytrusowe, kurkuma, 180 mg/kg), fruktooligosacharydy (120 mg/kg), Jukka schidigera (120 mg/kg), inulina (110 mg/kg), Ostropest plamisty (90 mg/kg).\r\n\r\n \r\n\r\nDodatki dietetyczne na 1kg:\r\n\r\nwitamina A (E672) 23 000 IU, witamina D3 (E671) 1800 IU, witamina E (α-tokoferol) (3a700) 600 mg, witamina C (E300) 300 mg, chlorek choliny 700 mg, biotyna 0,75 mg, witamina B1 1,2 mg, witamina B2 4,5 mg, niacynamid (3a315) 15 mg, pantotenian wapnia 12 mg, witamina B6 (3a831) 1,2 mg, kwas foliowy (3a316) 0,6 mg, witamina B12 0,05 mg, cynk (E6) 100 mg, żelazo (E1) 90 mg, mangan (E5) 45 mg, jod (E2) 0,8 mg, miedź (E4) 18 mg, selen (3b8.10) 0,3 mg.\r\n\r\n', 'tak', 'pies', 'karma', 25),
(18, 'Acana Puppy Junior Small Breed Dog', 'Acana', 6.000, 137.58, 'photo_product\\pies_karma3.png', 'Acana Classic Junior zawiera 65% składników pochodzenia zwierzęcego (drób, jaja, ryby), 20% owoce i warzywa, jedynym zbożem jest cięty owies (15%) - zboże o niskim indeksie glikemicznym.\r\n\r\nWszystkie świeże składniki dostarczane są do \"kuchni Champion\" w ciągu 24-48 godzin od ich pozyskania, nigdy nie mrożone, nie suszone, nie sproszkowane, wolne od sztucznych konserwantów.\r\n\r\nSkład:\r\n\r\nDehydratyzowane mięso kurczaka (33%), cięty owies, tłuszcz z kurczaka (12%), świeże mięso kurczaka (10%), ziemniaki, groszek, świeże całe jaja (3%), świeże mięso storni (3%), lucerna, wątróbka kurczaka (2%), olej ze śledzia (2%), włókno grochu, jabłka, gruszki, słodkie ziemniaki, dynia, dynia piżmowa, pasternak, marchewka, szpinak, żurawina, czarne jagody, organiczne wodorosty, korzeń cykorii, jagody jałowca, dzięgiel litwor, kwiat nagietka, koper słodki, liście mięty pieprzowej, lawenda.', 'tak', 'pies', 'karma', 23),
(19, 'Carnilove Adult Duck Pheasant', 'Carnilove', 12.000, 181.98, 'photo_product\\pies_karma4.png', 'Karma Carnilove to powrót do naturalnych źródeł pożywienia dzikich psów, dlatego ziarna i ziemniaki zostały z niej całkowicie wyeliminowane.\r\n\r\nMuszle skorupiaków morskich, wyciag z ich chrząstek oraz inne aktywne składniki są naturalnym źródłem substancji chondroprotekcyjnych, które mają pozytywny wpływ na stan, ruchomość, mobilność i elastyczność stawów u wszystkich psów, łącznie z tymi, które regularnie poddawane są zwiększonemu wysiłkowi fizycznemu.\r\n\r\n\r\nSkład:\r\n\r\nmączka z kaczki (30%), mączka z bażanta (22%), żółty groszek (20%), tłuszcz z kurczaka 8% (konserwowany mieszaniną tokoferoli), kaczka bez kości (5%), wątróbka z kurczaka (3%), jabłko (3%), skrobia tapioka (3%), olej z łososia (2%), marchew (1%), nasiona lnu (1%), ciecierzyca (1%), hydrolizowane muszle skorupiaków (źródło glukozaminy, 0,026%), ekstrakt z chrząstki (źródło chondroityny, 0,016%), drożdże browarniane (źródło mannooligosacharydów, 0,015%), korzeń cykorii (źródło fruktooligosacharydów, 0,01%), Jukka Schidigera (0,01%), algi (0,01%), Psyllium (0,01%), tymianek (0,01%), rozmaryn (0,01%), oregano (0,01%), żurawina (0,0008%), borówka (0,0008%), malina (0,0008%).\r\n\r\n', 'tak', 'kot', 'karma', 31),
(20, 'Dolina Noteci z pstrągiem - puszka', 'Dolina noteci', 0.400, 4.99, 'photo_product\\pies_karma5.png', '   Dolina Noteci   z pstrągiem dla dorosłych psów wszystkich ras.\r\n\r\n\r\n \r\n\r\nProdukt polski - wyprodukowany przez Łmeat - Łuków S.A. zawiera wyłącznie świeże rodzime surowce najwyższej jakości.\r\n \r\n\r\nW produkcji nie stosuje się sztucznych barwników, środków nęcących lub konserwujących.\r\n \r\n\r\nDodatek pstrąga zwiększa zawartość aminokwasów i składników mineralnych odgrywających istotną rolę w stymulacji funkcji obronnych organizmu.\r\n \r\n\r\nTłuszcz z pstrąga uzupełnia dietę psa w kwasy tłuszczowe EPA i DHA.\r\n\r\n \r\n\r\n \r\n\r\nSkład:\r\nwieprzowina 26% (mięso wieprzowe, wątroba, serca), wołowina 22% (płuca, wymiona, żołądki), pstrag 14%, jaja 3%, węglan wapnia, trójpolifosforan sodu, olej lniany 0,2%, nasiona psylium, chlorek potasu, bazylia 0,01%.', 'nie', 'pies', 'karma', 16),
(21, 'Dolina Noteci Dziczyzna saszetka ', 'Dolina noteci', 0.500, 4.99, 'photo_product\\pies_karma6.png', 'Wyłącznie świeże rodzime surowce najwyższej jakości, starannie dobrane składniki.\r\n \r\n\r\nStały skład recepturowy gwarantuje niezmienną zawartość składników odżywczych.\r\n \r\n\r\nW produkcji nie stosuje się sztucznych barwników, środków nęcących lub konserwujących.\r\n \r\n\r\nIlość białka w karmie uwzględnia zapotrzebowanie dorosłych psów.\r\n \r\n\r\nZawiera 65% mięsa i produktów pochodzenia zwierzęcego wysokiej jakości.\r\n \r\n\r\nDodatkowo olej lniany (źródło omega - 3), brązowy ryż, ekstrakt z jukki Schidigera.\r\n \r\n\r\nCo pozytywnie wpływa na funkcjonowanie procesów trawiennych, wygląd skóry i sierści.\r\n \r\n\r\nProdukt polski - wyprodukowany przez Łmeat - Łuków S.A.\r\n\r\n\r\nSkład:\r\nmięso i produkty pochodzenia zwierzęcego 65% (dziczyzna 15%), warzywa (marchew 1,7%), zboża (ryż brązowy 1,2%), oleje i tłuszcze (olej lniany 0,2%), substancje mineralne, bazylia 0,01%,', 'nie', 'pies', 'karma', 15),
(22, 'Wiejska Zagroda Indyk z jagnięciną', 'Wiejska zagroda', 0.400, 6.50, 'photo_product\\pies_karma7.png', 'Karma pełnoporcjowa dla psów Wiejska Zagroda\r\n\r\n \r\n\r\nWiejska Zagroda to polska marka, która powstała z potrzeby\r\n\r\npodania naszym psom tego, czego potrzebują, czyli mięsa!\r\n\r\n \r\n\r\nKarma mokra Wiejska Zagroda to pełnowartościowy, zdrowy posiłek dla psa, niezależnie od tego, czy jest mały, duży, krótkowłosy czy kudłaty. Pies to mięsożerca, a my zadbaliśmy, by w naszym menu znalazło się tylko to, co najlepsze.\r\n\r\n \r\n\r\nPodstawą posiłku jest zatem duet starannie wybranych mięs w aromatycznym bulionie własnym. Mięso jagnięce jest jednym z najzdrowszych mięs. Jest bogate w odżywcze białko i witaminy z grupy B, które są niezbędne do prawidłowego funkcjonowania całego organizmu. W duecie z delikatnym indykiem to propozycja idealna na co dzień dla czworonogów, a także dla pupili z nieco wrażliwszym żołądkiem.\r\n\r\n \r\n\r\nSmakowitym dodatkiem do mięsnej uczty jest świeży olej z łososia, bogactwo kwasów tłuszczowych Omega 3 EPA i DHA, cennych dla sierści i skóry Twojego psa.\r\n\r\n \r\n\r\nKolejnym cennym składnikiem są dobroczynne algi morskie, które stanowią bogactwo  witamin, minerałów oraz wartościowych substancji odżywczych.\r\n\r\n \r\n\r\nProste składniki, bez zbędnych dodatków jak zboża, soja czy polepszacze smaku to nasz przepis na zdrowie i witalność Twojego pupila.', 'tak', 'pies', 'karma', 15),
(23, 'Animonda Dog Vom Feisten Junior', 'Animonda', 0.150, 3.32, 'photo_product\\pies_karma8.png', 'Nazwa odpowiada temu co obiecuje, należy do klasy produktów z najwyższej półki.\r\n\r\nSą przygotowywane wyłącznie z wysokiej jakości czystego mięsa.\r\n\r\nBez zawartości soi, bez zbóż czy genetycznie modyfikowanych składników, bez sztucznych barwników i konserwantów.\r\n\r\nW pełni zaspokaja wysokie wymagania i szczególne potrzeby żywieniowe szczeniąt i młodych psów małych ras znanych ze szczególnej wrażliwości.\r\n \r\n\r\n \r\n\r\nSkład:\r\n\r\nMięso i pochodne mięsa (drobiu 20%, serca indycze 8%) substancje mineralne.\r\n\r\n \r\n\r\nAnaliza:\r\n\r\nBiałko 11%\r\n\r\nTłuszcz 7%\r\n\r\nBłonnik 0,5%\r\n\r\nPopiół 1%\r\n\r\nWilgotność 80% \r\n\r\n ', 'tak', 'pies', 'karma', 24),
(24, 'TRIXIE mata chłodząca dla psa', 'Trixie', 0.100, 64.00, 'photo_product\\pies_lezanki.png', 'Trixie niebieska mata chłodząca\r\n\r\nTrixie mata chłodząca jest idealnym rozwiązaniem na długie, letnie, upalne dni. Wspomaga regulację temperatury ciała naszego psa. Efekt chłodzący uzyskiwany jest poprzez kontakt z ciałem naszego pupila. Działa bez dodatkowego źródła prądu, chłodzenia czy wody. Chłodzi przez kilka godzin, bardzo szybko jest gotowa do kolejnego użytku. Modne, letnie kolory są dodatkowym atutem tej nowoczesnej maty chłodzącej\r\n\r\nSposób użycia:\r\nUżywanie maty nie wymaga użycia prądu czy moczenia w wodzie i zamrażania. Mata aktywuje się po położeniu się na niej psa. W środku znajduje się specjalny czynnik chłodzący, który aktywuje się pod wpływem ciężaru psa. Mata chłodzi przez kilka godzin i jest gotowa ponownie do użytku po krótkiej przerwie. Można ją stosować wewnątrz budynku, w klatkach czy podczas zabaw i wypoczynku na świeżym powietrzu', 'nie', 'pies', 'lezanki', 4),
(25, 'Trixie Legowisko Drago', 'Trixie', 0.200, 234.99, 'photo_product\\pies_lezanki2.png', 'Miękkie legowisko dla psa typu kanapa z nylonu\r\n\r\nPokrycie Nylonowe\r\nWypełniane poliestrem\r\nNadaje się również do stosowania na zewnątrz\r\nWymienne odwracalne poduszki\r\nAntypoślizgowe dno nylonowe\r\nWymiary: 90x80cm\r\nKolor: czarny', 'nie', 'pies', 'lezanki', 4),
(26, 'Chaba Legowisko Budka Standard', 'Chaba', 0.280, 66.50, 'photo_product\\pies_lezanki3.png', 'Chaba   Luksusowa budka dla psa.\r\n \r\n\r\nBudka - legowisko wysłane jest w środku miękką, wygodną poduchą i daje zwierzętom naturalne poczucie bezpieczeństwa.\r\n\r\nDzięki wysokiej jakości materiałom budka jest mocna, wytrzymała, oraz nadaje się do wielokrotnego prania (w temperaturze 30 stopni).', 'nie', 'pies', 'lezanki', 3),
(27, 'TRIXIE mata dla psa', 'Trixie', 0.100, 69.99, 'photo_product\\pies_lezanki4.png', 'Mata dla psa chroniąca przed zimną podłogą\r\nwypełnienie i obszycie 100% pioliester\r\npuszysta i izolująca\r\nspód antypoślizgowy z nylonu\r\nmożliwość prania w 30 st. C\r\nWymiary: 100 × 75 cm \r\nKolor: szary', 'nie', 'pies', 'lezanki', 1),
(28, 'Megan pokarm dla papug średnich', 'Megan', 3.000, 18.99, 'photo_product\\ptak_karma.png', 'Podstawowy, specjalnie odpylony pokarm składający się z sortowanych zbóż i nasion różnej wielkości dojrzewających na słońcu, wzbogacony o minerały.\r\n \r\n\r\nSkład:\r\n\r\ngryka, dari, jęczmień, kanar, proso żółte, owies łuskany, proso czerwone, pszenica, sorgo, słonecznik, kardi, chrupki kukurydziane, ziarno konopi.', 'nie', 'ptak', 'karma', 12),
(29, 'Vitakraft Salat Mix zioła dla ptaków', 'Vitakraft', 0.010, 2.89, 'photo_product\\ptak_karma2.png', 'Pokarm uzupełniający dla papug falistych i kanarków.\r\n\r\n\r\nZawiera witaminy, warzywa, gwiazdnicę, mniszek lekarski oraz wiele innych pełnowartościowych, świeżo zebranych i ostrożnie wysuszonych ziół przygotowanych specjalnie do dziobania.\r\n\r\n\r\nSkład: \r\nwarzywa, pokrzywa, dmuchawiec, gwiazdnica, babka lancetowata, nagietek, bławatek.\r\n\r\n\r\nAnaliza:\r\nbiałko surowe 20,0%, zawartość tłuszczu 3,4%, włókno surowe 13,4%, popiół 14,7%, wilgotność 19,4%, wapń 1,77%, fosfor 0,42%\r\n\r\n\r\n\r\n          Dodawać 1 łyżeczkę co 1-2 dni do pojemnika z karmą lub do osobnej miseczki.', 'nie', 'ptak', 'karma', 15),
(30, 'Vitapol Pokarm dla papużek falistych ', 'Vitapol', 0.500, 5.00, 'photo_product\\ptak_karma3.png', 'Vitapol \r\n\r\n \r\n\r\nMieszanka podstawowa do codziennego żywienia, skomponowana na bazie składników preferowanych przez papużki faliste, zbliżonych do naturalnie występujących w środowisku ich bytowania.\r\n\r\nW składzie znajdują się wyselekcjonowane, najlepszej jakości, odpowiednio zbilansowane nasiona przeznaczone do żywienia tej grupy papug.\r\n\r\nZdrowe, bagate odżywczo trzy rodzaje prosa, lekkostrawny i smakowity kanar oraz dodatek ziaren lnu to tylko niektóre składniki uwielbiane przez papugi.\r\n \r\n\r\nSkład:\r\n\r\nproso żółte, proso czerwone, proso białe, nasiona mozgi kanaryjskiej, owies łuskasny, siemię lniane, nasiona krokoszu barwierskiego, orzech ziemny obłuszczony, nasiona słonecznika czarnego, nasiona słonecznika paskowanego, nasiona nigru, sorgo białe,sorgo czerwone, mąka kukurydziana, mąka pszenna, karoten, mączka z lucerny.\r\n\r\n \r\n\r\nSkładniki analityczne:\r\n\r\nbiałko surowe  13,3 %\r\n\r\noleje i tłuszcze surowe  7,6 %\r\n\r\nwłókno surowe  10,25 %\r\n\r\npopiół surowy  3.1 %\r\n\r\nwilgotność  12 %', 'nie', 'ptak', 'karma', 7),
(31, 'Versele Laga Grit+Coral piasek d/ptaków ', 'Versele laga', 2.500, 10.79, 'photo_product\\ptak_karma4.png', 'Grys z koralitem\r\n\r\nJest mieszanką muszli ostryg, kamyczków ciernych, muszli morskich, czerwonego kamienia i węgla drzewnego.\r\n\r\nJest niezbędnym pokarmem uzupełniającym dla każdego ptaka, bogatym źródłem minerałów i pierwiastków śladowych.\r\n\r\nKamyczki cierne są absolutnie niezbędne dla poprawnego trawienia. ', 'tak', 'ptak', 'karma', 4),
(32, 'Inter-Zoo Elisabeth P078 klatka', 'Inter-zoo', 0.400, 119.99, 'photo_product\\ptak_klatki.png', 'Inter Zoo  klatka dla ptaków.\r\n\r\n\r\nWygodna, estetyczna, funkcjonalna klatka o wymiarach 54 cm x 39 cm x 74 cm.\r\n\r\nW kuwecie zamontowano wysuwane dno, co bardzo ułatwia czyszczenie klatki.', 'tak', 'ptak', 'klatki', 3),
(33, 'Inter-Zoo Beta White P015 klatka', 'Inter-zoo', 0.400, 73.99, 'photo_product\\ptak_klatki2.png', 'Inter Zoo  klatka dla ptaków.\r\n\r\n\r\nWygodna, estetyczna, funkcjonalna klatka o wymiarach 56,5 cm x 28 cm x 44,5 cm.\r\n\r\nW kuwecie zamontowano wysuwane dno, co bardzo ułatwia czyszczenie klatki.', 'nie', 'ptak', 'klatki', 2),
(34, 'Inter-Zoo Megi P051 klatka', 'Inter-zoo', 0.400, 64.03, 'photo_product\\ptak_klatki3.png', 'Inter Zoo  klatka dla ptaków.\r\n\r\n\r\nWygodna, estetyczna, funkcjonalna klatka o wymiarach 43 cm x 25 cm x 47 cm.\r\n\r\nW kuwecie zamontowano wysuwane dno, co bardzo ułatwia czyszczenie klatki.', 'nie', 'ptak', 'klatki', 1),
(35, 'WD-Impex Klatka K7', 'Wd-imprex', 0.600, 99.99, 'photo_product\\ptak_klatki4.png', 'WD-Impex   Klatka dla ptaków.\r\n\r\n\r\nPosiada wysuwane dno kuwety, co ułatwia sprzątanie.\r\n\r\n\r\n\r\ndługość: 59 cm\r\nszerokość: 40 cm\r\nwysokość: 64 cm', 'nie', 'ptak', 'klatki', 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zamowienia_ogolne`
--

CREATE TABLE `zamowienia_ogolne` (
  `ID` int(11) NOT NULL,
  `ID_klient` int(11) NOT NULL,
  `nazwa` varchar(200) NOT NULL,
  `data_zakupu` date NOT NULL,
  `suma` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `zamowienia_ogolne`
--

INSERT INTO `zamowienia_ogolne` (`ID`, `ID_klient`, `nazwa`, `data_zakupu`, `suma`) VALUES
(11, 7, 'Cat Chow Special Care 3w1, ', '2023-08-03', 34.00),
(12, 7, 'Josera Classic z łososiem, ', '2023-08-03', 85.00),
(13, 7, 'Josera Classic z łososiem, ', '2023-08-03', 85.00),
(14, 7, 'Friskies sterilised, Miamor Kitten z drobiem w galaretce, Royal Canin Kitten - galaretka, ', '2023-08-03', 28.00),
(15, 7, 'Friskies sterilised, ', '2023-08-03', 22.00);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zamowienia_szczegolowe`
--

CREATE TABLE `zamowienia_szczegolowe` (
  `ID` int(11) NOT NULL,
  `ID_produktu` int(11) NOT NULL,
  `ID_zamowienia` int(11) NOT NULL,
  `ilosc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `zamowienia_szczegolowe`
--

INSERT INTO `zamowienia_szczegolowe` (`ID`, `ID_produktu`, `ID_zamowienia`, `ilosc`) VALUES
(3, 0, 13, 1),
(4, 2, 14, 1),
(5, 4, 14, 1),
(6, 5, 14, 1),
(7, 2, 15, 1);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `klienci`
--
ALTER TABLE `klienci`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `produkty`
--
ALTER TABLE `produkty`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `zamowienia_ogolne`
--
ALTER TABLE `zamowienia_ogolne`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fkIdx_47` (`ID_klient`);

--
-- Indeksy dla tabeli `zamowienia_szczegolowe`
--
ALTER TABLE `zamowienia_szczegolowe`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fkIdx_116` (`ID_zamowienia`),
  ADD KEY `fkIdx_90` (`ID_produktu`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `klienci`
--
ALTER TABLE `klienci`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `zamowienia_ogolne`
--
ALTER TABLE `zamowienia_ogolne`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `zamowienia_szczegolowe`
--
ALTER TABLE `zamowienia_szczegolowe`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `zamowienia_ogolne`
--
ALTER TABLE `zamowienia_ogolne`
  ADD CONSTRAINT `zamowienia_ogolne_ibfk_1` FOREIGN KEY (`ID_klient`) REFERENCES `klienci` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `zamowienia_szczegolowe`
--
ALTER TABLE `zamowienia_szczegolowe`
  ADD CONSTRAINT `FK_46` FOREIGN KEY (`ID_zamowienia`) REFERENCES `zamowienia_ogolne` (`ID`),
  ADD CONSTRAINT `zamowienia_szczegolowe_ibfk_1` FOREIGN KEY (`ID_produktu`) REFERENCES `produkty` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Gen 31, 2026 alle 15:55
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rigwizard`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `cpu`
--

CREATE TABLE `cpu` (
  `id` int(11) NOT NULL,
  `manufacturer` varchar(100) NOT NULL,
  `model_name` varchar(100) NOT NULL,
  `frequency_ghz` decimal(3,2) NOT NULL,
  `cores` int(11) NOT NULL,
  `socket_type` varchar(50) DEFAULT NULL,
  `score` decimal(3,1) DEFAULT 0.0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `cpu`
--

INSERT INTO `cpu` (`id`, `manufacturer`, `model_name`, `frequency_ghz`, `cores`, `socket_type`, `score`) VALUES
(1, 'AMD', 'Ryzen 9 9950X', 4.30, 16, 'AM5', 10.0),
(2, 'Intel', 'Core i9-14900KS', 3.20, 24, 'LGA 1700', 9.9),
(3, 'AMD', 'Ryzen 7 9800X3D', 4.70, 8, 'AM5', 9.9),
(4, 'Intel', 'Core Ultra 9 285K', 3.70, 24, 'LGA 1851', 9.8),
(5, 'Intel', 'Core i9-14900K', 3.20, 24, 'LGA 1700', 9.8),
(6, 'AMD', 'Ryzen 9 7950X3D', 4.20, 16, 'AM5', 9.7),
(7, 'Intel', 'Core i9-13900K', 3.00, 24, 'LGA 1700', 9.6),
(8, 'AMD', 'Ryzen 9 9900X', 4.40, 12, 'AM5', 9.5),
(9, 'AMD', 'Ryzen 7 7800X3D', 4.20, 8, 'AM5', 9.4),
(10, 'Intel', 'Core i7-14700K', 3.40, 20, 'LGA 1700', 9.3),
(11, 'AMD', 'Ryzen 7 9700X', 3.80, 8, 'AM5', 9.2),
(12, 'Intel', 'Core Ultra 7 265K', 3.90, 20, 'LGA 1851', 9.1),
(13, 'Intel', 'Core i5-13600K', 3.50, 14, 'LGA 1700', 9.0),
(14, 'AMD', 'Ryzen 9 5950X', 3.40, 16, 'AM4', 8.9),
(15, 'Intel', 'Core i7-13700K', 3.40, 16, 'LGA 1700', 8.8),
(16, 'Intel', 'Core i5-14600K', 3.50, 14, 'LGA 1700', 8.7),
(17, 'AMD', 'Ryzen 5 9600X', 3.90, 6, 'AM5', 8.6),
(18, 'AMD', 'Ryzen 5 7600X', 4.70, 6, 'AM5', 8.5),
(19, 'Intel', 'Core i5-12600K', 3.70, 10, 'LGA 1700', 8.3),
(20, 'AMD', 'Ryzen 5 5600X', 3.70, 6, 'AM4', 8.2),
(21, 'Intel', 'Core i5-13400F', 2.50, 10, 'LGA 1700', 8.1),
(22, 'AMD', 'Ryzen 7 5700X', 3.40, 8, 'AM4', 8.0),
(23, 'AMD', 'Ryzen 5 5600', 3.50, 6, 'AM4', 7.8),
(24, 'Intel', 'Core i5-11600K', 3.90, 6, 'LGA 1200', 7.5),
(25, 'Intel', 'Core i3-14100', 3.50, 4, 'LGA 1700', 6.8),
(26, 'AMD', 'Ryzen 5 5500', 3.60, 6, 'AM4', 6.5),
(27, 'Intel', 'Core i3-12100F', 3.30, 4, 'LGA 1700', 6.2),
(28, 'AMD', 'Ryzen 3 4100', 3.80, 4, 'AM4', 5.5),
(29, 'Intel', 'Pentium Gold G7400', 3.70, 2, 'LGA 1700', 4.8),
(30, 'AMD', 'Athlon 3000G', 3.50, 2, 'AM4', 4.2),
(31, 'Intel', 'Core i7-4770K', 3.50, 4, 'LGA 1150', 3.9),
(32, 'AMD', 'FX-8350', 4.00, 8, 'AM3+', 3.5),
(33, 'Intel', 'Core i5-2500K', 3.30, 4, 'LGA 1155', 3.2),
(34, 'Intel', 'Celeron G5905', 3.50, 2, 'LGA 1200', 3.0),
(35, 'Intel', 'Core 2 Quad Q9550', 2.83, 4, 'LGA 775', 2.8),
(36, 'AMD', 'Phenom II X4 965', 3.40, 4, 'AM3', 2.5),
(37, 'Intel', 'Core 2 Duo E8400', 3.00, 2, 'LGA 775', 1.5);

-- --------------------------------------------------------

--
-- Struttura della tabella `games`
--

CREATE TABLE `games` (
  `id_game` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `release_year` year(4) NOT NULL,
  `publisher` varchar(150) DEFAULT NULL,
  `price` decimal(6,2) DEFAULT 0.00,
  `description` text DEFAULT NULL,
  `detailed_description` text DEFAULT NULL,
  `id_min_pc` int(11) DEFAULT NULL,
  `id_recommended_pc` int(11) DEFAULT NULL,
  `creator` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `games`
--

INSERT INTO `games` (`id_game`, `title`, `release_year`, `publisher`, `price`, `description`, `detailed_description`, `id_min_pc`, `id_recommended_pc`, `creator`) VALUES
(1, 'Elden Ring', '2022', 'Bandai Namco', 59.99, 'Un monumentale Action RPG dark fantasy dove esplori l\"Interregno\", un regno dominato da boss colossali e segreti millenari in una libertà d\"esplorazione senza precedenti.', 'Alza la testa, Senzaluce, e lasciati guidare dalla grazia per sfoggiare il potere dell\"Anello Elden\". Ti ritroverai in un mondo vasto e interconnesso, dove pianure sconfinate si fondono con dungeon stratificati e castelli che sfidano la gravità. Ogni scontro è una prova di forza e ingegno, richiedendo l\"uso magistrale di armi, magie e delle potenti Ceneri di Guerra.\n\nIl design del mondo incoraggia la scoperta organica: potrai cavalcare Torrente tra le lande di Caelid o scalare le vette dei Giganti. La narrazione criptica e affascinante ti spingerà a ricostruire la storia di un mondo in frantumi, dove ogni oggetto e ogni nemico ha un posto preciso nel mosaico della lore. Preparati a morire, a imparare e infine a trionfare per diventare il nuovo Lord Ancestrale.', 10, 3, 'FromSoftware'),
(2, 'The Witcher 3: Wild Hunt', '2015', 'CD Projekt', 29.99, 'Vivi l\"ultima avventura di Geralt di Rivia, un cacciatore di mostri mutante alla ricerca della figlia della profezia in un mondo aperto dove le tue scelte plasmano il destino di interi regni.', 'In un continente lacerato dai conflitti tra l\"impero di Nilfgaard e i Regni Settentrionali, Geralt deve navigare tra intrighi politici e minacce soprannaturali. Il gioco offre un ecosistema vivo, dove il ciclo giorno-notte e il meteo influenzano il comportamento di creature e abitanti. La tua ricerca di Ciri ti porterà dalle paludi infestate del Velen alle sfarzose piazze di Novigrad fino alle gelide vette delle isole Skellige.\n\nOgni missione secondaria è un racconto a sé stante, spesso privo di una distinzione netta tra bene e male. Dovrai padroneggiare i Segni magici, preparare decotti alchemici e migliorare il tuo equipaggiamento per affrontare la temibile \"Caccia Selvaggia\". La profondità dei dialoghi e la complessità dei personaggi rendono questo titolo un punto di riferimento assoluto per il genere RPG.', 12, 7, 'CD Projekt Red'),
(3, 'Grand Theft Auto V', '2013', 'Rockstar Games', 29.99, 'Un thriller criminale ambientato a Los Santos. Segui tre criminali mentre pianificano rapine audaci per sopravvivere in un mondo spietato e satirico.', 'Benvenuti a Los Santos, una parodia scintillante e brutale della California moderna. Il gioco ti permette di passare in qualsiasi momento tra tre criminali: Michael, un ex rapinatore professionista frustrato; Franklin, un giovane ambizioso delle periferie; e Trevor, un folle sociopatico. Questa dinamica permette di vivere le missioni da angolazioni diverse, coordinando attacchi sincronizzati durante i grandi colpi.\n\nOltre alla trama cinematografica, il mondo aperto offre una libertà d\"azione totale: potrai pilotare aerei, immergerti nell\"oceano, investire in borsa o semplicemente esplorare le colline di \"Vinewood\". La componente multiplayer, GTA Online, espande ulteriormente l\"esperienza permettendoti di costruire il tuo impero criminale con amici, partecipando a gare clandestine, guerre tra gang e complessi colpi cooperativi in una mappa in costante aggiornamento.', 12, 6, 'Rockstar North'),
(4, 'Hades', '2020', 'Supergiant Games', 24.50, 'Un roguelike frenetico dove nei panni del principe dell\"Oltretomba sfidi tuo padre per raggiungere la superficie, ricevendo i \"Doni\" degli dei dell\"Olimpo ad ogni tentativo.', 'Fuggire dall\"Inferno non è mai stato così gratificante. Ogni morte in Hades non è una sconfitta, ma un\"opportunità per approfondire i dialoghi con personaggi mitologici carismatici e potenziare permanentemente le tue statistiche nella Casa dell\"Ade. Zagreus può brandire sei armi infernali uniche, ognuna con stili di gioco drasticamente differenti che vengono ulteriormente modificati dai Doni degli dei.\n\nZeus, Atena, Poseidone e molti altri offrono benedizioni che creano sinergie devastanti: fulmini che scattano tra i nemici, scudi riflettenti o effetti di stato debilitanti. La struttura narrativa si adatta perfettamente alla natura ripetitiva dei roguelike, svelando segreti familiari e retroscena mitologici a ogni nuova stanza ripulita. Con una direzione artistica vibrante e una colonna sonora rock-orchestrale, Hades è un trionfo di design e narrazione.', 13, 10, 'Supergiant Games'),
(5, 'Baldur\'s Gate 3', '2023', 'Larian Studios', 59.99, 'Il capolavoro RPG ambientato nell\"universo di D&D. Vivi una storia di amicizia e tradimento dove ogni tua decisione ha conseguenze monumentali sul mondo e sui tuoi compagni.', 'Un parassita dei Mind Flayer è stato impiantato nel tuo cervello, conferendoti poteri oscuri mentre minaccia di trasformarti in un mostro. Dovrai decidere se resistere a questa corruzione o abbracciarla per dominare il mondo. Il gioco offre una libertà d\"approccio quasi infinita: potrai parlare con i morti, trasformarti in animali o usare l\"ambiente a tuo vantaggio durante i complessi combattimenti tattici a turni.\n\nOgni personaggio che recluterai ha una storia personale profonda e obiettivi che potrebbero scontrarsi con i tuoi. Il sistema di reattività del mondo è sbalorditivo: le tue azioni nel primo atto possono avere ripercussioni cataclismatiche ore dopo. Con una scrittura eccelsa, una recitazione mozzafiato e la fedeltà alle regole della \"5ª edizione\" di D&D, Baldur\'s Gate 3 definisce un nuovo standard per il genere RPG.', 8, 3, 'Larian Studios'),
(6, 'God of War', '2018', 'Sony Interactive', 49.99, 'Kratos torna come padre nelle terre del mito norreno. Un viaggio brutale dove deve controllare la sua rabbia per proteggere Atreus e onorare un ultimo desiderio.', 'Dopo aver distrutto l\"Olimpo, Kratos vive come un uomo tra le divinità e i mostri del Nord. In questo mondo spietato, deve combattere per sopravvivere e insegnare a suo figlio a fare lo stesso, cercando di spezzare il ciclo di violenza che ha segnato la sua esistenza. Il gioco trasforma il combattimento action in un\"esperienza viscerale e tattica grazie all\"ascia \"Leviatano\", che può essere lanciata e richiamata con un feedback incredibile.\n\nLa telecamera è fissa alle spalle del protagonista e segue l\"intera avventura in un unico, ininterrotto piano sequenza, senza tagli o schermate di caricamento. Esplorerai regni mitologici come Midgard e Alfheim, risolvendo enigmi ambientali e affrontando boss colossali. Il rapporto tra Kratos e Atreus è il cuore pulsante del gioco, evolvendo da una fredda distanza a un legame profondo e commovente mentre scoprono insieme la verità sulle proprie origini.', 10, 5, 'Santa Monica Studio'),
(7, 'Sekiro: Shadows Die Twice', '2019', 'Activision', 59.99, 'Uno shinobi cerca di riscattare il suo onore nel Giappone Sengoku. Un action-adventure spietato basato sulla precisione della katana e sull\"uso di protesi letali.', 'Sei il \"Lupo a un braccio solo\", un guerriero senza nome che ha giurato di proteggere un giovane lord. Quando quest\"ultimo viene rapito, inizi un viaggio di vendetta che ti porterà a scalare templi arroccati e ad attraversare foreste infestate. Il cuore del gioco è il sistema di \"Postura\": non basta colpire il nemico, bisogna deviare i suoi attacchi con tempismo perfetto per sbilanciarlo e sferrare un colpo mortale imparabile.\n\nLa tua protesi shinobi aggiunge una dimensione tattica enorme, permettendoti di usare rampini, lanciafiamme o asce pesanti per sfruttare i punti deboli dei nemici. Sekiro richiede una pazienza e una concentrazione assolute, trasformando ogni scontro con un boss in un duello cinematografico e brutale. La verticalità dell\"esplorazione e la bellezza malinconica del Giappone feudale creano un\"atmosfera unica, dove la morte è solo l\"inizio della tua evoluzione come guerriero.', 11, 6, 'FromSoftware'),
(8, 'Doom Eternal', '2020', 'Bethesda', 39.99, 'L\"FPS frenetico definitivo che ti mette nei panni dello Slayer in una crociata per fermare l\"invasione infernale sulla Terra attraverso una danza di violenza pura.', 'Le armate dell\"Inferno hanno invaso la Terra e l\"unica cosa di cui hanno paura sei tu. Doom Eternal eleva il genere sparatutto a un \"combat puzzle\" ad alta velocità. Ogni uccisione è una risorsa: le esecuzioni forniscono salute, la motosega ricarica le munizioni e il lanciafiamme rilascia armatura. Questo ti costringe a restare costantemente in movimento, saltando e scattando tra orde di demoni sempre più feroci.\n\nEsplorerai ambientazioni spettacolari, dai centri urbani distrutti della Terra alle basi tecnologiche su Marte, fino ai regni mistici degli Argenti. Il gioco introduce nuove abilità di movimento come il doppio scatto e la lama da polso, rendendo lo Slayer più letale che mai. Con una colonna sonora heavy metal industriale che segue il ritmo dei tuoi colpi, Doom Eternal è un\"esperienza sensoriale travolgente che non concede un attimo di respiro.', 10, 6, 'id Software'),
(9, 'Subnautica', '2018', 'Unknown Worlds', 29.99, 'Sopravvivi allo schianto su un pianeta oceanico, costruisci basi sottomarine e scopri i segreti di abissi dove l\"acqua nasconde meraviglie e terrori colossali.', 'Sei precipitato su 4546B, un pianeta oceanico pieno di vita ma privo di terre emerse. Dovrai iniziare recuperando risorse dai fondali vicino alla tua scialuppa, costruendo attrezzature per respirare più a lungo e veicoli per scendere in profondità. Il gioco bilancia magistralmente la bellezza delle barriere coralline illuminate dal sole con l\"oscurità claustrofobica delle fosse abissali, dove abitano creature di dimensioni titaniche.\n\nLa narrazione è legata alla scoperta di installazioni aliene e messaggi radio di altri sopravvissuti, guidandoti verso la verità su un\"antica infezione. La gestione dell\"ossigeno, del cibo e della pressione diventa una sfida costante mentre progetti basi sottomarine sempre più complesse. Subnautica è un viaggio emozionante che trasforma la tua paura del mare aperto in una curiosità insaziabile per ciò che giace sul fondo.', 11, 7, 'Unknown Worlds'),
(10, 'Outer Wilds', '2019', 'Annapurna Interactive', 22.99, 'Un mistero spaziale in un sistema solare in loop temporale. Esplora pianeti che cambiano in tempo reale e cerca di capire perché l\"universo sta per finire.', 'In Outer Wilds, la conoscenza è il tuo unico potenziamento. Interpreti il nuovo acquisto di un programma spaziale rudimentale incaricato di studiare i Nomai, un\"antica civiltà scomparsa che ha lasciato rovine su ogni pianeta. Ogni 22 minuti, il sole esplode e tu ti risvegli nello stesso momento, mantenendo però tutte le informazioni scoperte nel tuo computer di bordo.\n\nI pianeti sono meraviglie di design: uno è composto da due sfere che si scambiano sabbia, un altro è un gigante gassoso con tornado colossali, un altro ancora sta letteralmente cadendo a pezzi verso un buco nero centrale. Dovrai imparare a pilotare la tua fragile nave e usare il tuo traduttore per decifrare testi antichi, ricostruendo un mosaico scientifico e filosofico che ti porterà a scoprire il cuore pulsante dell\"universo. Un\"esperienza che si può vivere davvero solo una volta.', 11, 8, 'Mobius Digital'),
(11, 'Resident Evil Village', '2021', 'Capcom', 39.99, 'Ethan Winters affronta orrori gotici in un villaggio innevato dominato da signori spietati. Una miscela di terrore psicologico, azione viscerale e segreti oscuri.', 'Dopo gli eventi in Louisiana, Ethan cerca di ricostruire la sua vita, ma il rapimento di sua figlia lo costringe a scendere di nuovo nell\"inferno. Il villaggio è un luogo d\"incubo diviso tra quattro aree tematiche, ognuna controllata da un lord diverso: dal castello sfarzoso di Lady Dimitrescu alla fabbrica meccanica di Heisenberg. Il gioco alterna magistralmente momenti di esplorazione lenta e carica di tensione a sparatorie frenetiche contro licantropi e altre mutazioni.\n\nIl motore grafico offre dettagli fotorealistici che rendono ogni corridoio e ogni foresta opprimenti. Dovrai gestire accuratamente il tuo inventario e potenziare le tue armi attraverso il misterioso mercante noto come il \"Duca\". Resident Evil Village non è solo un horror, ma un viaggio attraverso le diverse sfaccettature della paura, culminando in rivelazioni che cambiano per sempre la percezione dell\"intera serie.', 10, 5, 'Capcom'),
(12, 'Disco Elysium', '2019', 'ZA/UM', 39.99, 'Un rivoluzionario RPG investigativo dove interpreti un detective amnesico. Le tue abilità hanno voci proprie e ogni dialogo può portarti verso la redenzione o il baratro.', 'Ti svegli in una stanza d\"hotel distrutta, senza memoria e con un omicidio da risolvere nel quartiere costiero di Martinaise. Disco Elysium sostituisce i classici scontri con la spada con un sistema di 24 abilità psicologiche, come la Logica, l\"Empatia o l\"Elettrochimica, che intervengono costantemente nei tuoi pensieri per guidarti o ingannarti. Sei un detective, ma puoi decidere di essere un comunista, un fascista, un ultra-liberale o un profeta dell\"apocalisse.\n\nLa scrittura è di una profondità letteraria raramente vista, trattando temi come la politica, la perdita, l\"amore e il fallimento con una satira tagliente e una malinconia struggente. Ogni interazione con gli abitanti della città è un tassello di un puzzle più grande, dove la risoluzione del caso passa attraverso la ricostruzione della tua stessa identità. È un gioco di ruolo puro, dove le parole sono più letali di qualsiasi arma da fuoco.', 13, 11, 'ZA/UM'),
(13, 'Apex Legends', '2019', 'Electronic Arts', 0.00, 'Uno sparatutto Battle Royale a squadre frenetico dove personaggi leggendari con abilità uniche combattono per la gloria e la fama ai margini della Frontiera.', 'Domina i tuoi avversari in Apex Legends, uno sparatutto free-to-play dove il gioco di squadra è fondamentale. Scegli tra un cast in continua espansione di fuorilegge, soldati e misantropi, ognuno dotato di abilità tattiche, passive e Ultimate che possono ribaltare le sorti dello scontro. Il sistema di comunicazione \"Ping\" permette di coordinarsi senza microfono, rendendo l\"azione fluida e accessibile.\n\nLe mappe dinamiche cambiano ogni stagione, introducendo nuovi pericoli ambientali e opportunità tattiche. Che tu stia scivolando giù da una collina o usando una zip-line per riposizionarti, il movimento è l\"anima del gioco. Unisciti agli amici, combina le abilità dei vostri eroi e sopravvivi fino alla fine per diventare i nuovi campioni dei Giochi Apex.', 11, 6, 'Respawn Entertainment'),
(14, 'Cyberpunk 2077', '2020', 'CD Projekt', 59.99, 'Un RPG open world ambientato a Night City, una megalopoli ossessionata dal potere e dalle modifiche corporee, dove interpreti un mercenario alla ricerca della chiave per l\"immortalità\".', 'Night City è una giungla di neon e cemento dove il futuro non è mai stato così oscuro. Nei panni di V, dovrai farti strada tra gang spietate e corporazioni onnipotenti dopo che un colpo andato male ti ha costretto a convivere con il biochip del terrorista rockstar Johnny Silverhand. Il gioco offre una libertà di personalizzazione estrema, permettendoti di modificare il tuo corpo con cyberware all\"avanguardia.\n\nPotrai scegliere il tuo approccio: agisci nell\"ombra come un Netrunner esperto, usa la forza bruta o padroneggia armi tecnologiche devastanti. Ogni scelta nei dialoghi e nelle missioni influenza il mondo circostante e i rapporti con i personaggi chiave, portando a finali multipli e drammatici in una città che promette tutto ma non regala nulla.', 10, 3, 'CD Projekt Red'),
(15, 'Red Dead Redemption 2', '2018', 'Rockstar Games', 59.99, 'Un\"epopea western mozzafiato che racconta il declino dell\"era dei fuorilegge in America attraverso gli occhi di Arthur Morgan e della banda Van der Linde.', 'America, 1899. Dopo una rapina fallita, Arthur Morgan e la banda Van der Linde sono costretti a fuggire, braccati dagli agenti federali e dai migliori cacciatori di taglie del paese. Per sopravvivere, la banda deve rapinare, combattere e rubare attraverso il cuore selvaggio e spietato delle terre americane, mentre le divisioni interne minacciano di distruggerla definitivamente.\n\nIl gioco vanta un livello di dettaglio maniacale, dalla gestione del campo base alla cura del proprio cavallo. Potrai cacciare per sfamare i tuoi compagni, giocare a poker nei saloon o semplicemente cavalcare attraverso paesaggi che sembrano dipinti. La narrazione profonda esplora temi di lealtà, redenzione e il sacrificio necessario per sopravvivere a un mondo che sta cambiando troppo velocemente.', 10, 5, 'Rockstar Games'),
(16, 'Sea of Thieves', '2018', 'Xbox Game Studios', 39.99, 'Il simulatore di pirateria cooperativo definitivo dove puoi navigare, combattere e saccheggiare tesori insieme ai tuoi amici in un immenso oceano condiviso.', 'Sea of Thieves ti offre l\"esperienza piratesca totale, dalla navigazione a vela al combattimento navale, fino all\"esplorazione di isole remote e al saccheggio di forzieri sepolti. Non ci sono classi predefinite: hai la libertà totale di affrontare il mondo e gli altri giocatori come preferisci, diventando una leggenda dei mari attraverso le tue gesta.\n\nIl mondo è condiviso, il che significa che ogni vela che vedi all\"orizzonte appartiene a un altro equipaggio di giocatori reali. Saranno amici o nemici? Potrete allearvi per sconfiggere un Kraken o scontrarvi in una battaglia di cannoni per il possesso di un tesoro. Con aggiornamenti costanti che introducono nuove minacce, storie narrative e segreti, l\"avventura non finisce mai in questo paradiso tropicale pieno di pericoli.', 11, 6, 'Rare'),
(17, 'Factorio', '2020', 'Wube Software', 30.00, 'Un gioco di strategia e automazione dove costruisci e gestisci enormi fabbriche su un pianeta alieno ostile per lanciare un razzo nello spazio.', 'Sei naufragato su un pianeta alieno e la tua unica speranza è l\"industrializzazione. Factorio ti sfida a estrarre risorse, ricercare tecnologie e automatizzare la produzione per creare catene di montaggio sempre più complesse. Quello che inizia come un lavoro manuale di scavo si trasforma rapidamente in un impero di nastri trasportatori, bracci meccanici e treni automatizzati.\n\nMa attenzione: l\"inquinamento prodotto dalle tue fabbriche attirerà la fauna locale, che non esiterà ad attaccare le tue strutture. Dovrai progettare sistemi di difesa con torrette e mura mentre ottimizzi l\"efficienza dei tuoi impianti. Che tu stia giocando da solo o in multiplayer cooperativo, la soddisfazione di vedere una fabbrica perfettamente sincronizzata funzionare come un orologio è impareggiabile.', 13, 9, 'Wube Software'),
(18, 'Dark Souls III', '2016', 'Bandai Namco', 59.99, 'L\"epico capitolo finale della saga Souls, dove affronti boss leggendari in un mondo in rovina per decidere il destino della Prima Fiamma.', 'Mentre le fiamme svaniscono e il mondo cade in rovina, viaggia verso terre lontane dove i confini della realtà si intrecciano. Dark Souls III perfeziona la formula della serie offrendo un combattimento più fluido e veloce, pur mantenendo la difficoltà e la profondità tattica che l\"hanno resa celebre. Ogni scontro è una lezione di pazienza e osservazione, dove un errore può significare la morte.\n\nIl design dei livelli è magistrale, con scorciatoie intelligenti e segreti nascosti dietro ogni angolo. Affronterai boss colossali e indimenticabili in ambientazioni gotiche mozzafiato, cercando di ricostruire la complessa lore del mondo attraverso gli oggetti e l\"ambiente. È una sfida brutale ma onesta, che premia la perseveranza con un senso di trionfo unico nel panorama videoludico.', 12, 7, 'FromSoftware'),
(19, 'Deep Rock Galactic', '2020', 'Coffee Stain', 29.99, 'Un FPS cooperativo dove nani spaziali scavano miniere in pianeti alieni pericolosi, distruggendo orde di insetti e raccogliendo minerali preziosi.', 'Lavora in squadra con un massimo di tre amici per esplorare caverne generate proceduralmente su Hoxxes IV, il pianeta più pericoloso della galassia. Scegli tra quattro classi specializzate: il Trivellatore, l\"Ingegnere, lo Scout e l\"Artigliere. Ognuno ha un ruolo fondamentale per la sopravvivenza del gruppo, sia che si tratti di creare piattaforme, illuminare il buio o scavare tunnel attraverso la roccia.\n\nL\"ambiente è completamente distruttibile: non c\"è un percorso prestabilito, puoi scavare dove vuoi per raggiungere l\"obiettivo. Tra un\'ondata di insetti alieni e l\'altra, dovrai raccogliere oro e minerali rari per potenziare il tuo equipaggiamento e festeggiare con una birra al bar della stazione spaziale. Per la roccia e la pietra!', 11, 7, 'Ghost Ship Games'),
(20, 'The Elder Scrolls V: Skyrim', '2011', 'Bethesda', 39.99, 'L\"RPG open world per eccellenza dove diventi il Sangue di Drago, un eroe leggendario destinato a salvare il mondo dalla minaccia di Alduin.', 'Skyrim ha ridefinito il concetto di libertà nei videogiochi. Sin dal momento in cui sfuggi all\"esecuzione iniziale, il mondo intero è a tua disposizione. Potrai scalare le vette della Gola del Mondo, esplorare antiche rovine naniche o semplicemente diventare un maestro forgiatore in una delle tante città. Il sistema di progressione si adatta al tuo stile di gioco: diventi più bravo nelle abilità che usi effettivamente.\n\nLa minaccia del ritorno dei draghi incombe sulla regione, ma spetta a te decidere quando affrontarla. Nel frattempo, puoi unirti a gilde di assassini, maghi o compagni d\"arme, o restare coinvolto nella guerra civile tra Imperiali e Manto della Tempesta. Con centinaia di missioni, dungeon e segreti, Skyrim è un mondo in cui puoi letteralmente perderti per centinaia di ore, vivendo la vita che hai sempre immaginato.', 13, 9, 'Bethesda Game Studios'),
(21, 'Frostpunk', '2018', '11 bit studios', 29.99, 'Un survival city-builder glaciale dove gestisci l\"ultima città sulla Terra, prendendo decisioni morali estreme per garantire la sopravvivenza dell\"umanità.', 'In un XIX secolo alternativo, il mondo è stato colpito da un\"era glaciale apocalittica. Come leader dell\"ultimo insediamento umano, la tua priorità assoluta è mantenere acceso il Generatore, una colossale macchina a vapore che fornisce calore alla città. Dovrai gestire risorse scarse come carbone, cibo e materiali da costruzione, mentre la temperatura scende costantemente.\n\nMa Frostpunk non è solo un gioco di gestione: è un test morale. Fino a che punto ti spingerai per sopravvivere? Emanerai leggi per far lavorare i bambini o per razionare il cibo ai malati? Ogni scelta ha conseguenze sulla speranza e sul malcontento della popolazione. Esplora le lande ghiacciate alla ricerca di altri sopravvissuti e preparati ad affrontare la Grande Tempesta in un\"esperienza intensa e drammatica.', 11, 8, '11 bit studios'),
(22, 'Valheim', '2021', 'Coffee Stain', 19.99, 'Un brutale gioco di sopravvivenza ambientato in un mondo ispirato alla mitologia norrena, dove devi costruire, combattere ed esplorare per onorare Odino.', 'Benvenuto nel decimo mondo norreno, Valheim. Come guerriero caduto in battaglia, le Valchirie ti hanno portato qui affinché tu possa sconfiggere gli antichi rivali di Odino. Inizia nudo e senza nulla, costruendo rifugi rudimentali e fabbricando armi di pietra, fino a erigere maestose sale vichinghe e forgiare armature di metalli rari. Il mondo è generato proceduralmente, offrendo foreste fitte, montagne innevate e oceani tempestosi.\n\nIl gioco bilancia la sopravvivenza con la progressione epica: per avanzare, dovrai evocare e sconfiggere boss leggendari che sbloccano nuove tecnologie e materiali. Naviga su navi vichinghe verso terre lontane, affronta giganti e serpenti marini, e unisciti ai tuoi amici (fino a 10 giocatori) per conquistare la landa selvaggia in un\"avventura che mescola relax e adrenalina.', 11, 6, 'Iron Gate AB'),
(23, 'Civilization VI', '2016', '2K Games', 59.99, 'Il celebre gioco di strategia a turni dove costruisci un impero destinato a resistere alla prova del tempo, guidando la tua civiltà dall\"età della pietra all\"era dell\"informazione.', 'Civilization VI introduce nuove meccaniche che rendono la gestione dell\"impero più dinamica che mai. Le città ora si espandono fisicamente sulla mappa tramite i distretti, costringendoti a pianificare attentamente l\"uso del territorio per massimizzare i bonus. La ricerca tecnologica e culturale è influenzata dalle tue azioni nel mondo reale, accelerando il progresso se soddisfi determinati requisiti.\n\nScegli tra decine di leader storici famosi, ognuno con abilità e unità esclusive, e persegui una delle diverse strade verso la vittoria: dominazione militare, superiorità scientifica, influenza culturale o supremazia religiosa. Con un sistema diplomatico complesso e la gestione delle grandi personalità della storia, ogni partita è una nuova opportunità per riscrivere il destino dell\"umanità in un gioco che ti farà dire sempre: \"ancora un ultimo turno\".', 13, 10, 'Firaxis Games'),
(24, 'Dying Light 2 Stay Human', '2022', 'Techland', 59.99, 'Un action-adventure open world post-apocalittico dove il parkour e il combattimento corpo a corpo sono fondamentali per sopravvivere in una città infestata da zombie.', 'Sono passati vent\"anni da quando il virus ha vinto la battaglia contro l\"umanità. La Città, uno degli ultimi grandi insediamenti umani, è dilaniata da conflitti interni e infestata da infetti che diventano incredibilmente letali dopo il tramonto. Nei panni di Aiden Caldwell, un pellegrino con un passato misterioso, dovrai usare le tue straordinarie abilità di parkour per navigare tra i tetti e sfuggire ai pericoli.\n\nIl sistema di combattimento è brutale e creativo, permettendoti di combinare armi artigianali con mosse acrobatiche. Le tue decisioni influenzeranno l\"equilibrio di potere tra le fazioni e cambieranno l\"aspetto stesso dei quartieri, sbloccando nuove opportunità o distruggendo intere zone. In un mondo dove la luce è la tua unica salvezza, dovrai fare scelte difficili per restare umano e scoprire la verità.', 9, 3, 'Techland'),
(25, 'Control', '2019', '505 Games', 29.99, 'Un action sovrannaturale in terza persona ambientato in un edificio governativo mutante, dove usi poteri telecinetici per respingere una minaccia ultraterrena.', 'Dopo che un\"agenzia segreta di New York viene invasa da una forza corrotta chiamata Hiss, diventi la nuova Direttrice, Jesse Faden, incaricata di riprendere il controllo della situazione. L\"ambientazione, la \"Oldest House\", è un luogo brutale e mutevole che sfida le leggi della fisica, pieno di uffici labirintici e spazi dimensionali impossibili.\n\nIl gameplay combina sparatorie frenetiche con abilità telecinetiche spettacolari: potrai sollevare oggetti e scagliarli contro i nemici, creare scudi di detriti o volare attraverso le stanze. La narrazione è ricca di mistero, ispirata al genere \"New Weird\", e ti porterà a scoprire esperimenti segreti e oggetti di potere inquietanti mentre cerchi di svelare il passato di Jesse e il vero scopo del Federal Bureau of Control.', 10, 5, 'Remedy Entertainment'),
(26, 'Ori and the Will of the Wisps', '2020', 'Xbox Game', 29.99, 'Un platform d\'azione visivamente mozzafiato che racconta la storia del piccolo spirito Ori in un viaggio per riunire una famiglia e salvare un mondo in rovina.', 'In questo attesissimo sequel, Ori deve avventurarsi oltre la foresta di Nibel per scoprire il vero destino del gufetto Ku e guarire una terra ferita. Il gioco combina un sistema di movimento fluido e acrobatico con combattimenti frenetici contro boss colossali che riempiono lo schermo. Ogni area, dalle paludi corrotte alle grotte luminose, è un dipinto in movimento.\n\nSblocca nuove abilità spirituali e frammenti di potere per personalizzare il tuo stile di gioco, affrontando enigmi ambientali complessi e sfide di velocità. Con una colonna sonora orchestrale profondamente emozionante e una narrazione delicata, Ori and the Will of the Wisps è un\'opera d\'arte interattiva che mette alla prova sia i tuoi riflessi che i tuoi sentimenti.', 11, 8, 'Moon Studios'),
(27, 'Detroit: Become Human', '2018', 'Quantic Dream', 39.99, 'Un dramma interattivo fantascientifico dove le tue decisioni determinano il destino dell\'umanità e degli androidi in una Detroit del prossimo futuro.', 'Siamo nel 2038 e la tecnologia ha trasformato la società: gli androidi sono ovunque, progettati per servire gli umani senza mai ribellarsi. Tuttavia, alcuni iniziano a provare emozioni. Seguirai le storie di tre androidi: Connor, un cacciatore di devianti; Kara, in fuga per proteggere una bambina; e Markus, il leader di una possibile rivoluzione.\n\nOgni dialogo e ogni azione creano ramificazioni narrative immense, visibili in un diagramma di flusso che mostra quanto le tue scelte siano determinanti. La morale e l\'etica sono costantemente messe in discussione in un mondo che si chiede cosa significhi veramente \"essere vivi\". Il finale della storia è interamente nelle tue mani, portando a esiti radicalmente diversi per i protagonisti e per il mondo intero.', 11, 6, 'Quantic Dream'),
(28, 'Cities: Skylines', '2015', 'Paradox', 27.99, 'Il city-builder moderno per eccellenza che ti mette a capo di una metropoli in crescita, sfidandoti a gestire infrastrutture, economia e servizi pubblici.', 'Cities: Skylines offre una simulazione profonda e realistica della pianificazione urbana. Inizia trasformando un appezzamento di terra vuoto in un piccolo borgo, fino a creare una megalopoli con distretti specializzati, sistemi di trasporto pubblico complessi e una gestione dettagliata delle tasse. Dovrai bilanciare il budget comunale fornendo al contempo istruzione, elettricità, acqua e sicurezza.\n\nIl sistema di traffico è uno dei più avanzati del genere, richiedendo una progettazione stradale intelligente per evitare ingorghi paralizzanti. Grazie al supporto totale per le mod, la community ha creato migliaia di edifici e strumenti aggiuntivi, rendendo il gioco uno strumento di design quasi infinito. Gestisci le politiche cittadine, affronta i disastri naturali e guarda la tua città prendere vita giorno dopo giorno.', 12, 8, 'Colossal Order'),
(29, 'Warframe', '2013', 'Digital Extremes', 0.00, 'Un action-shooter cooperativo online dove interpreti un guerriero Tenno, un ninja spaziale armato di tute bio-meccaniche spettacolari in una galassia in guerra.', 'Risvegliati dal criosonno e indossa il tuo Warframe per combattere contro fazioni tiranniche come i Grineer e i Corpus. Il gioco offre un sistema di movimento incredibilmente fluido e veloce, che ti permette di correre sui muri e scivolare attraverso i campi di battaglia mentre scateni poteri devastanti. Con decine di Warframe diversi, ognuno con abilità uniche, potrai personalizzare completamente il tuo stile di gioco.\n\nIl sistema di progressione è vastissimo, con centinaia di armi da forgiare e potenziare tramite i \"Mod\". Potrai esplorare ampie zone open world, partecipare a battaglie spaziali con la tua nave Railjack e immergerti in una trama cinematografica profonda che svela le origini dei Tenno. Essendo un gioco in continua evoluzione da oltre dieci anni, Warframe offre una quantità di contenuti gratuiti quasi ineguagliabile.', 12, 7, 'Digital Extremes'),
(30, 'Borderlands 3', '2019', '2K Games', 59.99, 'Il looter-shooter originale torna con miliardi di armi e un\'avventura galattica frenetica dove devi fermare i gemelli Calypso prima che ottengano il potere supremo.', 'Scegli uno dei quattro nuovi Cacciatori della Cripta e preparati a seminare il caos attraverso diversi pianeti, ognuno con ambienti e nemici unici. Il cuore di Borderlands 3 è il suo sistema di bottino infinito: troverai pistole che lanciano seghe circolari, fucili con scudi semoventi e armi che camminano e inseguono i nemici. La personalizzazione delle abilità ti permette di creare build uniche e devastanti.\n\nLa campagna è piena dell\'umorismo irriverente tipico della serie e può essere giocata interamente in cooperativa online o locale. Dovrai affrontare boss giganti, abbattere sette di fanatici intergalattici e collaborare con personaggi storici della saga per salvare la galassia. È un viaggio esplosivo, colorato e incredibilmente divertente che non ti lascia mai senza una nuova arma da provare.', 11, 6, 'Gearbox Software'),
(31, 'Hearts of Iron IV', '2016', 'Paradox', 39.99, 'Il simulatore di strategia militare definitivo sulla Seconda Guerra Mondiale, dove guidi una nazione attraverso il conflitto più vasto della storia umana.', 'Hearts of Iron IV ti dà il controllo totale di qualsiasi nazione esistente nel 1936 o nel 1939. Dovrai gestire non solo gli eserciti sul campo, ma anche la produzione industriale, la ricerca tecnologica, la diplomazia e le ideologie politiche. Il sistema dei \"Focus Nazionali\" permette di seguire la storia reale o di creare scenari ucronici, come un ritorno della monarchia in Germania o una rivoluzione comunista negli Stati Uniti.\n\nLa pianificazione tattica è fondamentale: dovrai disegnare linee di offensiva, gestire i rifornimenti e coordinare attacchi terrestri, navali e aerei. Il gioco simula la complessità della logistica bellica e l\'importanza del controllo dei mari e dei cieli. Che tu voglia dominare il mondo o difendere la democrazia, Hearts of Iron IV offre una profondità strategica senza pari per gli appassionati di storia militare.', 12, 9, 'Paradox'),
(32, 'The Last of Us Part I', '2022', 'Sony Interactive', 69.99, 'Un viaggio post-apocalittico emozionante e brutale attraverso gli Stati Uniti devastati, dove Joel ed Ellie devono imparare a fidarsi l\'uno dell\'altra per sopravvivere.', 'Vivi l\'esperienza che ha ridefinito la narrativa nei videogiochi, completamente ricostruita per sfruttare le moderne tecnologie. In un mondo dove una pandemia fungina ha trasformato gran parte dell\'umanità in creature aggressive, Joel, un sopravvissuto indurito, viene incaricato di scortare la giovane Ellie fuori da una zona di quarantena militare.\n\nIl gameplay alterna sezioni stealth ricche di tensione a scontri a fuoco viscerali, dove ogni risorsa è preziosa e ogni proiettile conta. Dovrai fabbricare strumenti di fortuna e potenziare le tue armi per affrontare sia gli infetti che i disperati gruppi di banditi umani. La relazione tra i due protagonisti si evolve in modo realistico e toccante, rendendo questo titolo un pilastro della narrazione cinematografica interattiva.', 8, 3, 'Naughty Dog'),
(33, 'Fallout 4', '2015', 'Bethesda', 19.99, 'Emergi dal Vault 111 come l\'Unico Sopravvissuto della Zona Contaminata di Boston, in un RPG open world dove ogni scelta determina il futuro della post-apocalisse.', 'Benvenuto nel Commonwealth, un mondo devastato dalla guerra nucleare dove la civiltà sta cercando faticosamente di risorgere. Dopo aver assistito al rapimento di tuo figlio, dovrai esplorare un territorio vasto e pericoloso, popolato da mutanti, androidi e fazioni in lotta per il controllo tecnologico e politico.\n\nIl sistema S.P.E.C.I.A.L. ti permette di personalizzare ogni aspetto del tuo personaggio, mentre il sistema di crafting e costruzione ti consente di erigere interi insediamenti e personalizzare migliaia di armi. Che tu decida di schierarti con la Confraternita d\'Acciaio o con i misteriosi Raiload, le tue azioni plasmeranno l\'ordine sociale di un mondo che ha dimenticato il significato della parola \"pace\".', 12, 8, 'Bethesda Game Studios'),
(34, 'Half-Life: Alyx', '2020', 'Valve', 58.99, 'Il ritorno leggendario di Half-Life esclusivamente per realtà virtuale, ambientato tra gli eventi dei primi due capitoli per raccontare la lotta disperata di Alyx Vance.', 'Alyx Vance e suo padre Eli organizzano la resistenza contro la brutale occupazione della Terra da parte dei Combine. Progettato da zero per la VR, il gioco offre un livello di interazione ambientale senza precedenti: potrai frugare tra gli scaffali, lanciare oggetti o risolvere enigmi fisici complessi con le tue stesse mani grazie ai \"Guanti Gravitazionali\".\n\nOgni combattimento richiede una fisicità reale: dovrai sporgerti dagli angoli per sparare, ricaricare manualmente le armi sotto pressione e gestire le scarse munizioni mentre esplori le strade labirintiche di City 17. È un\'esperienza immersiva totale che ridefinisce le potenzialità della realtà virtuale, unendo horror, azione e una narrazione profonda in un pacchetto visivamente sbalorditivo.', 6, 2, 'Valve'),
(35, 'Phasmophobia', '2020', 'Kinetic Games', 11.59, 'Un horror investigativo cooperativo dove tu e la tua squadra di cacciatori di fantasmi entrate in luoghi infestati per raccogliere prove su presenze paranormali.', 'Entra in case abbandonate, ospedali psichiatrici e prigioni per identificare il tipo di entità che le abita. Usando attrezzature reali come misuratori EMF, scatole spiritiche, termometri e telecamere per la visione notturna, dovrai raccogliere tre indizi prima che il fantasma decida di iniziare la caccia. La comunicazione vocale è integrata: il fantasma può sentire le tue parole e reagire di conseguenza.\n\nLa tensione è costante, poiché più tempo passi all\'interno, più la tua sanità mentale diminuisce, rendendoti vulnerabile ad attacchi improvvisi. Ogni fantasma ha caratteristiche uniche e abilità che dovrai imparare a riconoscere per sopravvivere. Non si tratta di esorcizzare il male, ma di documentarlo e uscirne vivi, portando a casa i dati necessari per la squadra di rimozione.', 11, 7, 'Kinetic Games'),
(36, 'Rust', '2018', 'Facepunch Studios', 39.99, 'Un survival multiplayer brutale e spietato dove l\'unico obiettivo è restare vivi in un mondo dove ogni altro giocatore è una potenziale minaccia mortale.', 'In Rust, inizi nudo su una spiaggia con nient\'altro che un sasso e una torcia. Dovrai raccogliere risorse, imparare progetti di costruzione e fabbricare vestiti, armi e basi per proteggerti dalla fame, dalla sete e, soprattutto, dagli altri giocatori. Il mondo non dorme mai: la tua base può essere assaltata mentre sei offline, costringendoti a progettare difese ingegnose.\n\nIl gioco favorisce la creazione di clan e alleanze, ma il tradimento è sempre dietro l\'angolo. Esplora monumenti radioattivi per trovare bottino di alto livello, combatti contro elicotteri di pattuglia e partecipa a raid massicci contro le basi nemiche. È un\'esperienza sociale estrema, dove la progressione tecnologica trasforma il gioco da una lotta con archi e frecce a una guerra moderna con esplosivi e fucili d\'assalto.', 10, 5, 'Facepunch Studios'),
(37, 'Subnautica: Below Zero', '2021', 'Unknown Worlds', 29.99, 'Ritorna sul pianeta 4546B in un nuovo capitolo ambientato in una regione artica, dove dovrai sopravvivere sia alle creature marine che al freddo gelido della superficie.', 'Below Zero espande l\'universo di Subnautica introducendo una nuova protagonista e una narrazione più diretta. Dovrai indagare sulla scomparsa di tua sorella esplorando biomi sottomarini ghiacciati e stazioni di ricerca abbandonate. Oltre a gestire l\'ossigeno, dovrai tenere d\'occhio la temperatura corporea quando esplorerai le vaste zone terrestri a piedi o a bordo del \"Prawn Suit\".\n\nCostruisci nuovi moduli per la tua base e veicoli specializzati come la Seatruck per navigare tra gli iceberg e le caverne di cristallo. Incontrerai nuove forme di vita aliene, alcune amichevoli come i Pinguini Marini e altre terrificanti come i Leviatani Ombra. È un mix perfetto di meraviglia esplorativa e sopravvivenza tesa, ambientato in uno dei mondi subacquei più belli mai creati.', 10, 6, 'Unknown Worlds'),
(38, 'Total War: Warhammer III', '2022', 'SEGA', 59.99, 'Il capitolo conclusivo dell\'epica trilogia di strategia fantasy, che porta i giocatori nel Regno del Caos per guidare eserciti leggendari in battaglie di proporzioni mitiche.', 'Total War: Warhammer III fonde la gestione dell\'impero a turni con battaglie in tempo reale spettacolari. Scegli tra sette fazioni uniche, tra cui i demoni del Caos di Khorne, Tzeentch, Nurgle e Slaanesh, o le potenti nazioni umane di Kislev e Catai. Ogni fazione offre meccaniche di campagna radicalmente diverse e unità che spaziano da draghi celestiali a legioni infernali.\n\nLa mappa della campagna è un mosaico di territori corrotti e regni magici dove dovrai gestire l\'economia, la diplomazia e gli eroi leggendari. Il culmine dell\'esperienza è la modalità \"Impero Immortale\", che unisce le mappe di tutti e tre i capitoli in un\'unica, mastodontica guerra globale. Con un design artistico fedele all\'universo di Games Workshop, è il sogno proibito di ogni appassionato di strategia fantasy.', 9, 3, 'Creative Assembly'),
(39, 'Microsoft Flight Simulator', '2020', 'Xbox Game', 69.99, 'Il simulatore di volo più avanzato di sempre, che utilizza dati satellitari e l\'intelligenza artificiale per ricostruire l\'intero pianeta con un realismo senza precedenti.', 'Prendi il comando di velivoli che spaziano dai leggeri aerei da turismo ai maestosi jet commerciali. Grazie alla tecnologia cloud di Azure, il gioco riproduce l\'intera Terra in scala 1:1, permettendoti di sorvolare la tua casa, monumenti iconici o le zone più remote del globo. Il sistema meteo in tempo reale riflette le condizioni meteorologiche effettive del mondo, includendo velocità del vento, pioggia e umidità.\n\nOgni cabina di pilotaggio è riprodotta con una fedeltà maniacale, con strumentazione interattiva e check-list realistiche. Che tu sia un pilota esperto o un principiante che vuole solo godersi il panorama, le diverse opzioni di assistenza rendono l\'esperienza scalabile. È un trionfo tecnologico che trasforma il tuo PC in una finestra aperta sul mondo intero.', 7, 2, 'Asobo Studio'),
(40, 'Mass Effect Legendary Edition', '2021', 'EA', 59.99, 'Rivivi la leggendaria saga del Comandante Shepard in questa versione rimasterizzata che include tutti i contenuti e i DLC della trilogia originale in un unico pacchetto epico.', 'La galassia è sull\'orlo dell\'estinzione a causa della minaccia dei Razziatori. Nei panni di Shepard, dovrai viaggiare tra i sistemi stellari, reclutare una squadra di specialisti alieni e umani e prendere decisioni che influenzeranno il destino di intere civiltà. La Legendary Edition aggiorna la grafica, il gameplay del primo capitolo e unifica l\'interfaccia per un\'esperienza coerente.\n\nLe tue scelte si ripercuotono attraverso tutti e tre i giochi: un alleato salvato nel primo capitolo potrebbe rivelarsi fondamentale nel terzo. La narrazione sci-fi profonda, i dialoghi ramificati e lo sviluppo dei personaggi rendono questa trilogia una delle pietre miliari della storia dei videogiochi. Preparati a diventare una leggenda della Cittadella e a scrivere la tua storia tra le stelle.', 4, 1, 'BioWare'),
(41, 'Dead Space Remake', '2023', 'EA', 59.99, 'Il ritorno del classico survival horror sci-fi, ricostruito da zero per offrire un\'immersione totale e un terrore viscerale a bordo della nave mineraria USG Ishimura.', 'Isaac Clarke è un ingegnere inviato a riparare una nave mineraria colossale, solo per scoprire che l\'equipaggio è stato massacrato e trasformato in Necromorfi. Armato solo dei suoi strumenti di lavoro e della sua determinazione, Isaac deve farsi strada tra corridoi claustrofobici e zone a gravità zero per ritrovare la sua compagna Nicole e scoprire la verità sul Marchio.\n\nIl remake introduce il sistema \"Intensity Director\", che altera dinamicamente l\'atmosfera e i suoni per tenerti sempre sulle spine. Il combattimento si basa sullo smembramento strategico dei nemici, costringendoti a mirare agli arti per fermare la loro avanzata. Con una grafica fotorealistica e un comparto sonoro 3D da brividi, Dead Space ridefinisce il significato di paura nello spazio profondo.', 8, 3, 'Motive Studio'),
(42, 'BioShock Infinite', '2013', '2K Games', 29.99, 'Uno sparatutto narrativo mozzafiato ambientato nella città volante di Columbia nel 1912, dove azione frenetica e temi filosofici si intrecciano in una trama indimenticabile.', 'Interpreti Booker DeWitt, un uomo indebitato con le persone sbagliate, inviato a Columbia per recuperare una ragazza di nome Elizabeth. Columbia è un paradiso tra le nuvole che nasconde un fanatismo oscuro e tensioni rivoluzionarie. Grazie ai poteri di Elizabeth, capace di aprire squarci dimensionali, il combattimento diventa dinamico e imprevedibile.\n\nPotrai sfrecciare sulle rotaie delle Skyline usando il gancio magnetico e scatenare poteri elementali chiamati Vigors per confondere o distruggere i nemici. La narrazione esplora concetti di fisica quantistica, politica e identità, culminando in uno dei finali più discussi e sorprendenti di sempre. BioShock Infinite non è solo un gioco, ma una critica sociale vestita da capolavoro d\'azione.', 13, 11, 'Irrational Games'),
(43, 'Life is Strange', '2015', 'Square Enix', 19.99, 'Un\'avventura grafica a episodi che segue la storia di Max Caulfield, una studentessa di fotografia che scopre di poter riavvolgere il tempo nel mezzo di un dramma adolescenziale.', 'Ambientato nella fittizia cittadina di Arcadia Bay, il gioco esplora le conseguenze del potere di Max mentre cerca di salvare la sua amica d\'infanzia Chloe Price. La meccanica del riavvolgimento temporale ti permette di testare diverse opzioni nei dialoghi e risolvere enigmi ambientali, ma ogni cambiamento nel passato può avere ripercussioni imprevedibili sul futuro.\n\nLa trama tratta temi delicati come l\'amicizia, il bullismo e la perdita, il tutto accompagnato da una colonna sonora indie-folk perfetta per l\'atmosfera malinconica del gioco. Le tue scelte morali plasmeranno la crescita dei personaggi e porteranno a finali radicalmente diversi. È un racconto intimo e potente che dimostra come anche le piccole azioni possano cambiare il corso del destino.', 13, 11, 'Dontnod Entertainment'),
(44, 'The Outer Worlds', '2019', 'Private Division', 29.99, 'Un RPG fantascientifico satirico dai creatori di Fallout: New Vegas, ambientato in una colonia spaziale dominata dalle multinazionali e dal consumismo sfrenato.', 'Ti risvegli dal criosonno su una nave coloniale dispersa e ti ritrovi nel mezzo di una cospirazione che minaccia di distruggere la colonia di Halcyon. In questo universo, le corporazioni controllano ogni aspetto della vita umana, dalla nascita alla morte. Potrai esplorare diversi pianeti e stazioni spaziali, incontrando compagni carismatici che potrai reclutare per la tua causa.\n\nIl sistema di gioco premia la libertà: puoi essere un eroe altruista, un mercenario egoista o un folle che risolve tutto con la violenza. Il sistema dei \"Difetti\" permette di caratterizzare il protagonista in base ai traumi subiti durante il gioco, offrendo vantaggi in cambio di debolezze. Con dialoghi brillanti e un umorismo nero costante, The Outer Worlds è una critica feroce e divertente alla società moderna.', 11, 7, 'Obsidian Entertainment'),
(45, 'Dwarf Fortress', '2006', 'Kitfox Games', 28.99, 'Il simulatore di colonia più profondo e complesso mai creato, dove gestisci un gruppo di nani in un mondo generato nel minimo dettaglio, dalla geologia alla mitologia.', 'Ogni mondo in Dwarf Fortress è unico, con secoli di storia generata proceduralmente prima ancora che tu inizi a giocare. Il tuo obiettivo è scavare una fortezza sotterranea, gestire l\'economia, l\'umore dei nani e difenderti da minacce che spaziano da goblin a mostruosità dimenticate. Il gioco simula tutto: dal flusso dei fluidi alla psicologia individuale dei personaggi.\n\nQuesta nuova versione grafica rende accessibile un capolavoro che per anni è stato rappresentato solo in codice ASCII. Potrai assistere a storie incredibili che nascono organicamente dalle interazioni dei nani, tra banchetti, rivolte e scoperte minerarie. Non esiste una condizione di vittoria; come dice il motto del gioco: \"Perdere è divertente!\". Preparati a fallire in modi spettacolari e indimenticabili.', 13, 11, 'Bay 12 Games'),
(46, 'Crusader Kings III', '2020', 'Paradox', 49.99, 'Un grand strategy dinastico dove non guidi una nazione, ma una stirpe nobiliare attraverso i secoli, tra intrighi politici, matrimoni strategici e guerre medievali.', 'In Crusader Kings III, il potere è una questione di famiglia. Inizia come un umile conte o un potente imperatore nel Medioevo e cerca di espandere l\'influenza della tua casata. Dovrai gestire i tratti della personalità dei tuoi eredi, organizzare omicidi per rimuovere rivali scomodi e navigare tra le complesse leggi della chiesa e del feudalesimo.\n\nIl gioco mette un forte accento sul gioco di ruolo: le tue azioni devono tenere conto dello stress e delle ambizioni del tuo sovrano. Potrai partecipare alle crociate, riformare religioni o creare tradizioni culturali uniche. Grazie a una mappa dettagliata che copre l\'Europa, l\'Africa e l\'Asia, ogni partita offre infinite possibilità di creare una narrazione storica alternativa fatta di gloria e infamia.', 12, 8, 'Paradox');
INSERT INTO `games` (`id_game`, `title`, `release_year`, `publisher`, `price`, `description`, `detailed_description`, `id_min_pc`, `id_recommended_pc`, `creator`) VALUES
(47, 'Mount & Blade II: Bannerlord', '2022', 'TaleWorlds', 49.99, 'Il simulatore definitivo di vita medievale che combina strategia sandbox, gestione del regno e battaglie campali in tempo reale con centinaia di soldati.', 'Ambientato nel continente fittizio di Calradia, Bannerlord ti permette di vivere la vita che desideri: puoi essere un semplice mercante, un gladiatore nelle arene o un signore della guerra che aspira al trono. Dovrai reclutare truppe nei villaggi, addestrarle e guidarle personalmente in carica sul campo di battaglia, dove il sistema di combattimento direzionale richiede abilità reale.\n\nGestisci i tuoi feudi, partecipa alla politica dei regni e crea una dinastia che possa governare la terra attraverso i secoli. Il sistema economico dinamico reagisce alle guerre e alle rotte commerciali, mentre il supporto per le mod permette di espandere l\'esperienza quasi all\'infinito. È un mix unico di strategia e azione in prima persona che ti mette davvero nel cuore del Medioevo.', 10, 6, 'TaleWorlds'),
(48, 'Kingdom Come: Deliverance', '2018', 'Deep Silver', 29.99, 'Un RPG d\'azione storico estremamente realistico ambientato nella Boemia medievale, dove interpreti il figlio di un fabbro in cerca di vendetta e redenzione.', 'Dimentica la magia e i draghi: in Kingdom Come, la sopravvivenza dipende dalla tua abilità con la spada e dalla tua intelligenza. Henry, il protagonista, non è un eroe predestinato, ma un giovane che deve imparare tutto da zero, dal leggere al combattere. Il gioco si svolge in una ricostruzione fedele della Boemia del 1403, colpita da una guerra civile per il trono.\n\nIl sistema di combattimento è basato sulle reali tecniche di scherma medievale, mentre le meccaniche di sopravvivenza ti obbligano a mangiare, dormire e mantenere puliti i tuoi vestiti per non influenzare i dialoghi con i nobili. Ogni missione può essere risolta in modi diversi, favorendo l\'approccio che preferisci. È una lettera d\'amore al realismo storico e alla narrazione cruda, perfetta per chi cerca un\'immersione totale nel passato.', 10, 5, 'Warhorse Studios'),
(49, 'Ghostrunner', '2020', '505 Games', 29.99, 'Un action in prima persona brutale e velocissimo ambientato in una megastruttura cyberpunk, dove ogni colpo è letale e il parkour è la tua unica via di scampo.', 'Scala la Torre Dharma, l\'ultimo rifugio dell\'umanità dopo un cataclisma globale. Come Ghostrunner, sei un guerriero cibernetico capace di manipolare il tempo e affettare i nemici con una katana monomolecolare. Il gioco si basa sulla filosofia \"one-hit-kill\": un solo proiettile ti ucciderà, costringendoti a muoverti costantemente e a pianificare ogni scatto.\n\nIl sistema di movimento fluido ti permette di correre sui muri, usare un rampino energetico e scivolare sotto il fuoco nemico. La sfida è estremamente elevata e richiede la memorizzazione dei livelli e riflessi fulminei. Accompagnato da una colonna sonora synthwave martellante, Ghostrunner è un test di pura abilità e adrenalina in un mondo distopico visivamente sbalorditivo.', 11, 6, 'One More Level'),
(50, 'Risk of Rain 2', '2020', 'Gearbox Publishing', 24.99, 'Un roguelike d\'azione 3D dove combatti orde infinite di mostri alieni su un pianeta ostile, accumulando oggetti folli per diventare una divinità della distruzione.', 'In Risk of Rain 2, il tempo è il tuo peggior nemico: più a lungo resti in vita, più la difficoltà aumenta drasticamente. Dovrai trovare il teletrasporto in ogni livello mentre affronti boss giganteschi e ondate di nemici sempre più letali. Il cuore del gioco risiede nell\'accumulo di oggetti: potrai averne centinaia contemporaneamente, creando sinergie assurde e imprevedibili.\n\nScegli tra diversi sopravvissuti, ognuno con abilità uniche che spaziano dall\'uso di droni alla forza bruta. Il gioco supporta il multiplayer cooperativo fino a 4 giocatori, rendendo le battaglie ancora più caotiche e divertenti. Con un design artistico stilizzato e una progressione infinita, ogni partita è una corsa contro il tempo per vedere quanto lontano puoi spingerti prima di soccombere all\'inevitabile.', 11, 8, 'Hopoo Games'),
(51, 'Satisfactory', '2019', 'Coffee Stain', 29.99, 'Un simulatore di costruzione di fabbriche in prima persona ambientato su un pianeta alieno, dove la tua missione è automatizzare tutto ciò che vedi.', 'Atterra su un pianeta lussureggiante e inizia a costruire la tua base per la FICSIT Inc. Satisfactory ti dà la libertà totale di progettare enormi complessi industriali multi-livello. Dovrai esplorare il territorio per trovare risorse, combattere la fauna locale e costruire chilometri di nastri trasportatori per collegare le tue miniere alle macchine di produzione.\n\nLa progressione ti porterà a sbloccare tecnologie avanzate come l\'energia nucleare, i jetpack e i treni automatizzati. La prospettiva in prima persona rende la scala della tua fabbrica impressionante, permettendoti di camminare tra i macchinari che hai progettato. Gioca da solo o con gli amici per creare l\'impianto più efficiente della galassia, trasformando un paradiso naturale in un capolavoro di ingegneria industriale.', 10, 6, 'Coffee Stain Studios'),
(52, 'Dishonored 2', '2016', 'Bethesda', 29.99, 'Un immersive sim stealth d\'eccellenza dove riprendi il ruolo di assassino soprannaturale per reclamare il tuo impero in una città costiera esotica e corrotta.', 'Scegli tra Emily Kaldwin o Corvo Attano e viaggia dalla nebbiosa Dunwall alla soleggiata Karnaca. Il gioco offre una libertà d\'approccio totale: puoi completare l\'intera avventura senza uccidere nessuno o scatenare una scia di sangue usando poteri oscuri e gadget tecnologici. Il design dei livelli è magistrale, con mappe verticali ricche di segreti e percorsi alternativi.\n\nUsa abilità come la Traslazione, il Dominio mentale o l\'Evocazione di sciami per superare le guardie o risolvere enigmi ambientali. Ogni missione è un piccolo capolavoro di architettura e narrazione ambientale, dove le tue azioni influenzano lo stato di \"Caos\" del mondo, alterando il finale e il comportamento dei cittadini. Con un\'estetica \"oil-painting\" unica, Dishonored 2 è un trionfo di stile e creatività tattica.', 11, 7, 'Arkane Studios'),
(53, 'Prey', '2017', 'Bethesda', 29.99, 'Un survival horror sci-fi ambientato su una stazione spaziale isolata, dove devi usare l\'ingegno e poteri alieni per sopravvivere a una minaccia mutaforma.', 'Ti svegli a bordo della Talos I, una stazione spaziale orbitante attorno alla Luna, solo per scoprire che è stata invasa dai Typhon, alieni capaci di nascondersi sotto forma di oggetti comuni. Come Morgan Yu, dovrai esplorare ogni angolo della stazione, raccogliendo risorse e potenziandoti tramite i Neuromod, che permettono di acquisire abilità umane o poteri alieni devastanti.\n\nIl gameplay premia la creatività: puoi usare il cannone GLOO per immobilizzare nemici o creare rampe improvvisate, o trasformarti tu stesso in una tazza di caffè per passare attraverso fessure strette. La narrazione è ricca di misteri legati alla tua memoria e agli esperimenti segreti condotti sulla stazione. In un ambiente dove nulla è ciò che sembra, la tua capacità di adattamento sarà l\'unica via per la salvezza.', 11, 7, 'Arkane Studios'),
(54, 'Ready or Not', '2021', 'VOID Interactive', 49.99, 'Uno sparatutto tattico intenso e realistico che ti mette nei panni di un agente SWAT in scenari ad alto rischio, dove la pianificazione e il sangue freddo sono vitali.', 'Ready or Not offre una simulazione cruda delle operazioni speciali di polizia. In un mondo moderno segnato da tensioni sociali, la tua squadra deve intervenire per risolvere situazioni di ostaggi, minacce terroristiche e irruzioni in covi criminali. Il gioco enfatizza le regole d\'ingaggio reali: non si tratta solo di sparare, ma di neutralizzare le minacce limitando i danni collaterali.\n\nPotrai utilizzare un arsenale di equipaggiamenti tattici come telecamere sotto-porta, granate stordenti, scudi balistici e arieti. Ogni missione richiede una fase di briefing dove pianificare i punti di ingresso e il dispiegamento della squadra. Il realismo balistico e la reattività dell\'IA rendono ogni stanza una potenziale trappola, richiedendo una coordinazione millimetrica con i tuoi compagni per tornare a casa sani e salvi.', 9, 5, 'VOID Interactive'),
(55, 'Insurgency: Sandstorm', '2018', 'Focus Entertainment', 29.99, 'Un FPS tattico a squadre basato sul combattimento ravvicinato letale e un gameplay orientato agli obiettivi in scenari di guerra moderna in Medio Oriente.', 'Sperimenta il terrore del combattimento moderno in Sandstorm, dove la vittoria dipende dalla cooperazione e dalla gestione delle risorse. Il gioco si distingue per il suo audio immersivo e una balistica estremamente punitiva: pochi colpi sono sufficienti per eliminare un giocatore. Dovrai muoverti con cautela attraverso ambienti urbani distrutti, coprendo gli angoli e usando i fumogeni per avanzare.\n\nLe modalità di gioco variano dalla cooperazione contro l\'IA a scontri PvP su vasta scala. Potrai personalizzare le tue armi con mirini, impugnature e diversi tipi di munizioni, bilanciando il peso dell\'equipaggiamento con la tua velocità di movimento. Non esiste una minimappa o un mirino a schermo fisso; dovrai fare affidamento sui tuoi sensi e sulla comunicazione con la squadra per sopravvivere alla tempesta di proiettili.', 11, 7, 'New World Interactive'),
(56, 'Squad', '2020', 'Offworld Industries', 44.99, 'Uno sparatutto militare tattico su larga scala che punta tutto sul realismo, la comunicazione e il gioco di squadra tra decine di giocatori in enormi mappe di battaglia.', 'Squad colma il divario tra gli sparatutto arcade e le simulazioni militari hardcore. Con battaglie che coinvolgono fino a 100 giocatori, il ruolo di ogni singolo soldato è inserito in una catena di comando guidata dai capisquadra. La costruzione di basi operative (FOB) e la gestione della logistica sono fondamentali quanto la precisione di tiro per vincere la guerra d\'attrito.\n\nIl gioco offre diverse fazioni reali, ognuna con i propri veicoli corazzati, elicotteri e armamenti specifici. La comunicazione radio è l\'anima dell\'esperienza: coordinare un attacco di fanteria con il supporto dell\'artiglieria e dei corazzati crea momenti di immersione cinematografica senza eguali. In Squad, non sei un \"lupo solitario\", ma un ingranaggio vitale in una macchina bellica complessa e organizzata.', 10, 6, 'Offworld Industries'),
(57, 'Arma 3', '2013', 'Bohemia Interactive', 27.99, 'Il re dei simulatori militari sandbox, che offre un\'esperienza bellica autentica e vastissima in un mondo aperto dove la strategia e il realismo non accettano compromessi.', 'Ambientato nelle vaste isole di Altis e Stratis nel Mar Egeo, Arma 3 offre oltre 290 km² di terreno esplorabile. Il gioco simula ogni aspetto della guerra moderna: dalla fatica del soldato alla fisica dei proiettili, fino alla complessa gestione dei veicoli aerei e terrestri. La campagna principale ti vede coinvolto in un conflitto geopolitico internazionale di vasta scala.\n\nIl vero punto di forza di Arma 3 è la sua incredibile versatilità: grazie all\'editor di missioni e al supporto per le mod, la community ha creato migliaia di scenari, che variano dalla sopravvivenza zombie a simulazioni di vita civile. Che tu stia partecipando a un\'operazione notturna stealth o a una battaglia campale con centinaia di unità, Arma 3 offre un livello di libertà e profondità tattica che rimane insuperato nel genere.', 11, 7, 'Bohemia Interactive'),
(58, 'DayZ', '2018', 'Bohemia Interactive', 39.99, 'Un survival horror multiplayer brutale ambientato in un mondo post-sovietico infestato da infetti, dove la minaccia più grande è sempre rappresentata dagli altri esseri umani.', 'In DayZ, ti risvegli sulla costa di Chernarus con poco più di un bendaggio. Dovrai esplorare città abbandonate e foreste alla ricerca di cibo, acqua e medicinali mentre combatti contro il freddo e le malattie. Non ci sono indicazioni o tutorial: la tua sopravvivenza dipende solo dalla tua capacità di adattamento e dalla conoscenza della mappa.\n\nOgni incontro con un altro giocatore è una scommessa tesa: collaborerete per sopravvivere o verrai ucciso per un barattolo di fagioli? La morte è permanente, il che significa perdere tutto il progresso e l\'equipaggiamento accumulato in ore di gioco. Dovrai riparare veicoli, costruire basi e cacciare per restare in vita in un mondo dove la fiducia è una risorsa più rara dei proiettili.', 11, 6, 'Bohemia Interactive'),
(59, 'Escape from Tarkov', '2017', 'Battlestate Games', 45.00, 'Un simulatore di combattimento hardcore con elementi RPG e MMO, dove devi sopravvivere a incursioni letali per estrarre bottino prezioso da una zona di guerra isolata.', 'Tarkov è una città russa sigillata militarmente e dilaniata da scontri tra compagnie mercenarie e bande locali di \"Scav\". In questo extraction-shooter, entri in una mappa con l\'obiettivo di raccogliere risorse e raggiungere un punto d\'uscita prima che scada il tempo. Se muori, perdi tutto l\'equipaggiamento che avevi con te, rendendo ogni scontro a fuoco una scarica di pura adrenalina.\n\nIl livello di dettaglio delle armi è ossessivo: puoi modificare ogni singola parte, dal percussore alla canna. Il gioco simula ferite localizzate, gestione dei caricatori e balistica ultra-realistica. Tra un\'incursione e l\'altra, dovrai gestire il tuo nascondiglio e commerciare con diversi trafficanti per sopravvivere nell\'economia spietata di una zona dimenticata da Dio.', 9, 3, 'Battlestate Games'),
(60, 'Hunt: Showdown', '2019', 'Crytek', 39.99, 'Un PvPvE competitivo e atmosferico ambientato nelle paludi della Louisiana del 1895, dove cacciatori di taglie si scontrano per eliminare mostri da incubo.', 'Hunt: Showdown combina la tensione di un survival horror con la competitività di un battle royale. La tua missione è tracciare e uccidere un boss mostruoso, recuperare la sua taglia e fuggire. Tuttavia, non sei l\'unico cacciatore: altre squadre sono sulle tue tracce, pronte a ucciderti per rubare il tuo trofeo. L\'audio è fondamentale: ogni ramo spezzato o sparo può rivelare la tua posizione.\n\nIl gioco vanta un arsenale di armi dell\'epoca fedelmente riprodotte e un sistema di progressione dei cacciatori che premia chi riesce a estrarre vivo. Se il tuo cacciatore muore, lo perdi per sempre, ma manterrai parte dell\'esperienza guadagnata. L\'ambientazione gotica e fangosa della Louisiana crea un\'atmosfera opprimente e unica, dove il pericolo può nascondersi in ogni cespuglio o fienile abbandonato.', 10, 5, 'Crytek'),
(61, 'Starfield', '2023', 'Bethesda', 69.99, 'L\'epopea spaziale definitiva di Bethesda dove puoi esplorare migliaia di pianeti, costruire la tua nave e unirti a diverse fazioni per svelare il più grande mistero dell\'umanità.', 'Siamo nell\'anno 2330 e l\'umanità si è spinta oltre il nostro sistema solare. In Starfield, hai la libertà totale di creare il personaggio che desideri e solcare i sistemi stellari alla ricerca di antichi manufatti. Potrai pilotare e personalizzare la tua astronave, gestire un equipaggio e stabilire avamposti su pianeti remoti per estrarre risorse rare.\n\nIl gioco offre una narrativa ramificata dove potrai scegliere di essere un pirata spaziale della Flotta Cremisi, un ranger delle Colonie Unite o un semplice esploratore solitario. Con il classico stile sandbox di Bethesda, ogni oggetto può essere raccolto e ogni luogo nasconde una storia. Scopri biomi alieni, affronta minacce interstellari e scrivi la tua leggenda in un universo vasto e pieno di meraviglie scientifiche.', 7, 2, 'Bethesda Game Studios'),
(62, 'No Man\'s Sky', '2016', 'Hello Games', 58.99, 'Un universo infinito generato proceduralmente dove ogni stella è un sole attorno al quale orbitano pianeti unici, tutti pronti per essere esplorati senza schermate di caricamento.', 'No Man\'s Sky è un viaggio di esplorazione, sopravvivenza e commercio in una galassia popolata da specie aliene e robot sentinelle. Potrai atterrare su pianeti rigogliosi o lande desolate, scoprendo flora e fauna mai viste prima. Il gioco ti permette di costruire basi complesse, gestire flotte di fregate e persino comandare il tuo Incrociatore spaziale.\n\nGrazie a anni di aggiornamenti gratuiti, il gioco include ora il multiplayer completo, il supporto VR, il combattimento spaziale avanzato e missioni narrative che ti porteranno al centro dell\'universo. Che tu voglia diventare un biologo galattico, un mercante interstellare o un guerriero spaziale, No Man\'s Sky offre un senso di scala e libertà che non ha eguali nel panorama videoludico moderno.', 11, 6, 'Hello Games'),
(63, 'Street Fighter 6', '2023', 'Capcom', 59.99, 'L\'evoluzione del picchiaduro più famoso al mondo, che introduce nuove modalità di gioco e un sistema di combattimento accessibile ma profondo per una nuova era di sfide.', 'Street Fighter 6 rivoluziona la serie con tre modalità principali: Fighting Ground, per il gioco competitivo classico; World Tour, una campagna single-player open-world dove crei il tuo lottatore; e Battle Hub, uno spazio sociale per interagire con altri giocatori. Il nuovo sistema \"Drive Gauge\" aggiunge uno strato strategico fondamentale, permettendo manovre offensive e difensive spettacolari.\n\nIl gioco introduce anche controlli \"Moderni\" semplificati, rendendo le combo spettacolari accessibili ai nuovi giocatori senza sacrificare la profondità tecnica per i veterani. Con un cast che mescola leggende come Ryu e Chun-Li a volti nuovi carismatici, SF6 si presenta con uno stile grafico ispirato ai graffiti e alla cultura hip-hop, portando l\'energia della strada direttamente nel cuore del combattimento.', 10, 5, 'Capcom'),
(64, 'Tekken 8', '2024', 'Bandai Namco', 69.99, 'Il nuovo capitolo della leggendaria saga di picchiaduro 3D, che spinge al limite la potenza grafica e introduce il sistema \"Heat\" per combattimenti ancora più aggressivi.', 'Tekken 8 continua la tragica saga della stirpe Mishima, concentrandosi sullo scontro finale tra Jin Kazama e suo padre Kazuya Mishima. Sviluppato in Unreal Engine 5, il gioco offre modelli dei personaggi incredibilmente dettagliati e ambienti distruttibili che reagiscono a ogni colpo. Il nuovo sistema \"Heat\" incoraggia uno stile di gioco offensivo, premiando i giocatori che mantengono la pressione sull\'avversario.\n\nOltre alle modalità classiche, il gioco introduce \"Arcade Quest\", una modalità single-player dove crei il tuo avatar e scali le classifiche delle sale giochi virtuali. Con un cast di 32 lottatori unici e una meccanica di recupero della salute durante l\'attacco, Tekken 8 ridefinisce l\'intensità dei combattimenti in tre dimensioni, rendendo ogni round uno spettacolo visivo e tecnico.', 8, 3, 'Bandai Namco'),
(65, 'Mortal Kombat 1', '2023', 'Warner Bros', 69.99, 'Un reboot totale dell\'universo di Mortal Kombat creato dal Dio del Fuoco Liu Kang, con un sistema di combattimento reinventato e fatality più spettacolari che mai.', 'In Mortal Kombat 1, la storia ricomincia in un universo pacifico che viene presto minacciato da forze familiari ma stravolte. Il gioco introduce il sistema dei \"Kameo Fighters\", una schiera di lottatori partner che possono essere richiamati durante lo scontro per eseguire combo assistite, mosse difensive o persino fatality combinate.\n\nLa modalità storia cinematografica continua la tradizione di eccellenza narrativa della serie, offrendo una trama ricca di colpi di scena e una qualità visiva di alto livello. Esplora la nuova modalità \"Invasioni\", un\'esperienza RPG single-player dove viaggi attraverso diversi regni per sbloccare ricompense e cosmetici. Con il ritorno dei colpi ai raggi X e la consueta dose di violenza ipertrofica, questo capitolo segna l\'inizio di una nuova, brutale era.', 8, 3, 'NetherRealm Studios'),
(66, 'Final Fantasy VII Remake Intergrade', '2021', 'Square Enix', 79.99, 'La spettacolare rivisitazione del classico del 1997, che fonde un sistema di combattimento action-tattico con una narrazione cinematografica espansa ambientata a Midgar.', 'Final Fantasy VII Remake non è solo una conversione grafica, ma un ripensamento totale dell\'opera originale. Seguirai Cloud Strife, un ex Soldier diventato mercenario, mentre si unisce al gruppo eco-terrorista Avalanche per combattere la malvagia compagnia Shinra. Il sistema di combattimento unisce l\'azione in tempo reale alla gestione tattica dei comandi tramite la barra ATB, permettendo di lanciare magie e utilizzare abilità speciali in momenti coreografati.\n\nLa versione Intergrade include l\'episodio aggiuntivo \"INTERmission\", con protagonista Yuffie Kisaragi, introducendo nuove meccaniche di gioco e retroscena narrativi. Midgar prende vita con un dettaglio sbalorditivo, dalle baraccopoli del Settore 7 ai lussuosi uffici dei piani alti, offrendo una profondità emotiva ai personaggi che ha emozionato nuove e vecchie generazioni di fan.', 10, 4, 'Square Enix'),
(67, 'Persona 5 Royal', '2022', 'SEGA', 59.99, 'La versione definitiva del pluripremiato JRPG, dove interpreti uno studente liceale di giorno e un Ladro Fantasma di notte in una Tokyo stilizzata e vibrante.', 'Persona 5 Royal ti mette nei panni di Joker, un ragazzo ingiustamente accusato che scopre il potere delle \"Persona\", manifestazioni fisiche della sua psiche. Dovrai bilanciare la tua vita sociale, andando a scuola e stringendo legami con i tuoi compagni, con l\'esplorazione dei \"Palazzi\", dungeon nati dai desideri corrotti degli adulti. Il sistema di combattimento a turni è uno dei più veloci e stilosi del genere.\n\nLa versione Royal aggiunge un intero nuovo semestre scolastico, nuovi personaggi come Kasumi Yoshizawa e aree esplorabili inedite a Tokyo. Con una colonna sonora acid-jazz indimenticabile e un design visivo che trasuda stile da ogni menu, il gioco affronta temi sociali profondi come l\'abuso di potere e la ricerca della libertà individuale, offrendo oltre 100 ore di contenuti magistralmente scritti.', 12, 9, 'Atlus'),
(68, 'NieR:Automata', '2017', 'Square Enix', 39.99, 'Un Action RPG filosofico e visionario che racconta la guerra tra androidi e macchine su una Terra post-apocalittica, attraverso una struttura narrativa unica.', 'In un futuro lontano, l\'umanità è fuggita sulla Luna dopo un\'invasione di macchine aliene. Nei panni degli androidi 2B e 9S, dovrai riconquistare il pianeta in una guerra che nasconde verità inquietanti. Il gameplay è un mix frenetico di combattimenti hack-and-slash, sezioni sparatutto a scorrimento e fasi esplorative open-world, tutto orchestrato con una fluidità impeccabile.\n\nLa vera anima di NieR:Automata risiede nella sua narrazione: il gioco richiede più completamenti per essere compreso appieno, rivelando nuove prospettive e finali che stravolgono la percezione della storia. Affrontando temi come l\'esistenza, l\'anima e il ciclo della violenza, il titolo di Yoko Taro è accompagnato da una delle colonne sonore più premiate e commoventi della storia dei videogiochi, rendendolo un\'esperienza artistica trascendentale.', 11, 7, 'PlatinumGames'),
(69, 'Monster Hunter: World', '2018', 'Capcom', 29.99, 'Diventa un cacciatore provetto in un ecosistema vivo e vibrante, dove dovrai tracciare e abbattere mostri giganteschi per creare equipaggiamenti sempre più potenti.', 'Monster Hunter: World porta la serie a un nuovo livello di immersione. Esplora il Nuovo Mondo, un continente selvaggio dove i mostri interagiscono tra loro in una complessa catena alimentare. Ogni caccia richiede preparazione: dovrai studiare il terreno, raccogliere tracce e utilizzare l\'ambiente a tuo vantaggio per abbattere creature leggendarie come il Rathalos o il Nergigante.\n\nPotrai scegliere tra 14 tipi di armi uniche, ognuna con un gameplay radicalmente diverso, e collaborare con un massimo di tre amici in multiplayer online. Il ciclo di gioco si basa sul raccogliere materiali dai mostri sconfitti per forgiare armature e armi migliori, permettendoti di affrontare sfide sempre più ardue. Con mappe ricche di dettagli e una fauna incredibilmente realistica, è il sogno di ogni appassionato di action-adventure su larga scala.', 11, 6, 'Capcom'),
(70, 'Devil May Cry 5', '2019', 'Capcom', 29.99, 'L\'apice dei giochi d\'azione stilizzati, dove abbatti orde di demoni con tre personaggi diversi utilizzando combo acrobatiche e un arsenale di armi folli.', 'Il sangue dei demoni scorre di nuovo nelle strade di Red Grave City. DMC5 vede il ritorno di Dante e Nero, affiancati dal misterioso nuovo arrivato V. Ogni personaggio offre uno stile di combattimento unico: Nero usa le sue braccia meccaniche \"Devil Breaker\", Dante padroneggia un arsenale vastissimo e V evoca creature demoniache per combattere al suo posto.\n\nIl cuore del gioco è il sistema di valutazione dello stile, che ti premia quanto più le tue combo sono varie, veloci e spettacolari. Grazie al RE Engine, le animazioni sono fluidissime e i dettagli visivi raggiungono vette fotorealistiche. Con una colonna sonora dinamica che aumenta di intensità in base alla tua bravura, Devil May Cry 5 è una celebrazione dell\'azione pura, esagerata e incredibilmente appagante.', 11, 6, 'Capcom'),
(71, 'Dave the Diver', '2023', 'Mintrocket', 19.99, 'Un\'avventura ibrida dove di giorno esplori le profondità di un mare magico per pescare e di notte gestisci un sushi bar di successo con i tuoi amici stravaganti.', 'Dave the Diver fonde due generi in modo magistrale. Durante il giorno, ti tufferai nel Buco Blu, un ecosistema in continua mutazione pieno di pesci esotici e pericoli sottomarini. Dovrai usare fiocine e armi subacquee per catturare i migliori ingredienti, stando attento alla riserva d\'ossigeno e alla profondità.\n\nDi sera, il gioco diventa un gestionale frenetico: dovrai servire i clienti del Bancho Sushi, creare menu ricercati e potenziare il locale. La trama è ricca di umorismo e personaggi bizzarri, portandoti a scoprire i segreti di una civiltà perduta sottomarina. Con minigiochi costanti, battaglie con boss giganti e uno stile grafico pixel art delizioso, Dave the Diver è una delle esperienze più fresche e rilassanti degli ultimi anni.', 13, 10, 'Mintrocket'),
(72, 'Dredge', '2023', 'Team17', 24.99, 'Un gioco di pesca dalle tinte horror lovecraftiane, dove navighi tra isole remote per vendere il tuo bottino e scoprire segreti che dovrebbero restare sepolti.', 'Mettiti al timone del tuo peschereccio e naviga tra arcipelaghi misteriosi. In Dredge, la pesca è solo l\'inizio: dovrai gestire lo spazio limitato nella tua stiva, potenziare la barca per raggiungere zone più pericolose e completare incarichi per gli abitanti locali. Ma fai attenzione: quando cala il sole, la nebbia porta con sé visioni inquietanti e pericoli che minacciano la tua sanità mentale.\n\nIl gioco bilancia momenti di esplorazione meditativa con una tensione costante data dalle presenze che popolano le acque oscure. Potrai dragare i fondali alla ricerca di tesori antichi e pescare creature mutate che svelano la corruzione che affligge il mare. Con un design artistico evocativo e una narrazione sottile, Dredge è un viaggio affascinante e disturbante verso l\'ignoto, dove ogni lancio della lenza potrebbe tirare su qualcosa di spaventoso.', 13, 11, 'Black Salt Games'),
(73, 'Signalis', '2022', 'Humble Games', 19.99, 'Un survival horror classico ispirato all\'era PS1, ambientato in un futuro distopico dove un\'androide cerca la sua partner in una struttura mineraria infestata.', 'Signalis è una lettera d\'amore ai padri del genere come Resident Evil e Silent Hill. Nei panni di Elster, una Replika che si risveglia in una nave schiantata, dovrai esplorare una colonia mineraria russa-futurista caduta nel caos. Dovrai risolvere enigmi ambientali complessi, gestire un inventario limitatissimo di soli 6 slot e decidere quando combattere o fuggire dalle mostruosità che infestano i corridoi.\n\nL\'estetica low-poly mescolata ad animazioni 2D crea un\'atmosfera opprimente e malinconica, supportata da una narrazione criptica e profonda che tratta temi di identità, memoria e amore proibito. Con un comparto sonoro industriale inquietante e una regia cinematografica, Signalis è un incubo surreale che ti rimarrà impresso per molto tempo dopo i titoli di coda.', 13, 11, 'rose-engine'),
(74, 'A Plague Tale: Requiem', '2022', 'Focus Entertainment', 49.99, 'Il seguito dell\'emozionante viaggio di Amicia e Hugo, in fuga attraverso una Francia medievale mozzafiato infestata da una maledizione soprannaturale e orde di ratti.', 'Ambientato pochi mesi dopo gli eventi del primo capitolo, Requiem segue i fratelli de Rune verso il sud della Francia alla ricerca di un\'isola che potrebbe curare la macula di Hugo. Il gioco espande notevolmente le meccaniche stealth e di combattimento, offrendo ad Amicia nuovi strumenti come una balestra e la capacità di utilizzare l\'ambiente in modi più aggressivi.\n\nL\'aspetto visivo è straordinario, con ambientazioni che spaziano da mercati vivaci a lande desolate coperte da migliaia di ratti che si muovono come un mare nero. La narrazione è cruda ed emotiva, esplorando il peso psicologico dell\'uccidere e la disperazione di chi cerca di proteggere ciò che ama a ogni costo. È un finale epico e straziante per una delle storie più umane della scorsa generazione.', 8, 2, 'Asobo Studio'),
(75, 'Hellblade: Senua\'s Sacrifice', '2017', 'Ninja Theory', 29.99, 'Un viaggio psicologico e brutale nel mito norreno, dove Senua deve affrontare i suoi demoni interiori e le manifestazioni della sua psiche per salvare l\'anima del suo amato.', 'Hellblade è un\'esperienza unica che affronta il tema della salute mentale con un realismo straordinario. Sviluppato in collaborazione con neuroscienziati, il gioco utilizza l\'audio binaurale per simulare le allucinazioni uditive della protagonista: le voci nella sua testa ti sussurreranno consigli, dubbi o insulti durante tutto il viaggio. Il combattimento è intenso e viscerale, riflettendo la disperazione di Senua.\n\nL\'esplorazione si basa sulla risoluzione di enigmi visivi legati alla percezione alterata del mondo della protagonista. Senza un\'interfaccia a schermo, l\'immersione è totale, portandoti a vivere ogni dolore e ogni visione di Senua come se fossero reali. È un capolavoro di narrazione e tecnica che dimostra come i videogiochi possano trattare temi complessi con sensibilità e potenza visiva senza pari.', 11, 8, 'Ninja Theory'),
(76, 'Tunic', '2022', 'Finji', 27.99, 'Un\'avventura isometrica che omaggia i classici del passato, dove una piccola volpe deve esplorare un mondo vasto ricostruendo letteralmente il manuale d\'istruzioni del gioco.', 'In Tunic vesti i panni di una piccola volpe in una terra piena di leggende perdute e creature feroci. La particolarità del gioco risiede nel suo manuale: durante l\'esplorazione troverai pagine di un libretto d\'istruzioni vecchio stile, scritto in una lingua misteriosa, che ti daranno indizi su mappe, meccaniche segrete e lore.\n\nSotto l\'aspetto colorato e adorabile si nasconde una sfida degna di un \"souls-like\", con boss ostici e segreti stratificati che richiedono un\'osservazione attenta. Tunic cattura perfettamente il senso di meraviglia e scoperta dei giochi dell\'infanzia, dove non tutto era spiegato e ogni angolo poteva nascondere un tesoro o una scorciatoia geniale. È un puzzle monumentale travestito da gioco d\'azione.', 12, 9, 'Andrew Shouldice');

-- --------------------------------------------------------

--
-- Struttura della tabella `game_tags`
--

CREATE TABLE `game_tags` (
  `id_game` int(11) NOT NULL,
  `id_tag` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `game_tags`
--

INSERT INTO `game_tags` (`id_game`, `id_tag`) VALUES
(1, 4),
(1, 5),
(1, 13),
(1, 15),
(1, 20),
(1, 21),
(1, 23),
(1, 71),
(1, 105),
(2, 1),
(2, 5),
(2, 13),
(2, 15),
(2, 21),
(2, 23),
(2, 45),
(2, 102),
(2, 113),
(3, 3),
(3, 10),
(3, 16),
(3, 17),
(3, 22),
(3, 26),
(3, 36),
(3, 59),
(3, 84),
(3, 114),
(4, 11),
(4, 15),
(4, 17),
(4, 25),
(4, 27),
(4, 52),
(4, 58),
(4, 85),
(4, 94),
(5, 13),
(5, 15),
(5, 16),
(5, 22),
(5, 23),
(5, 24),
(5, 30),
(5, 100),
(5, 113),
(6, 9),
(6, 13),
(6, 15),
(6, 17),
(6, 21),
(6, 22),
(6, 31),
(6, 54),
(6, 93),
(7, 5),
(7, 7),
(7, 15),
(7, 21),
(7, 45),
(7, 72),
(7, 79),
(7, 101),
(7, 111),
(7, 113),
(8, 12),
(8, 15),
(8, 17),
(8, 19),
(8, 44),
(8, 91),
(8, 92),
(8, 113),
(9, 1),
(9, 13),
(9, 15),
(9, 17),
(9, 21),
(9, 22),
(9, 45),
(9, 71),
(9, 113),
(10, 4),
(10, 13),
(10, 17),
(10, 20),
(10, 21),
(10, 22),
(10, 30),
(10, 102),
(10, 105),
(11, 12),
(11, 17),
(11, 20),
(11, 22),
(11, 24),
(11, 31),
(11, 67),
(11, 106),
(12, 1),
(12, 3),
(12, 10),
(12, 12),
(12, 14),
(12, 17),
(12, 18),
(12, 36),
(12, 44),
(13, 1),
(13, 12),
(13, 14),
(13, 17),
(13, 19),
(13, 44),
(13, 66),
(13, 70),
(13, 94),
(14, 13),
(14, 17),
(14, 18),
(14, 21),
(14, 24),
(14, 35),
(14, 110),
(14, 113),
(15, 14),
(15, 15),
(15, 17),
(15, 21),
(15, 68),
(15, 80),
(15, 104),
(15, 111),
(15, 113),
(16, 12),
(16, 16),
(16, 22),
(16, 24),
(16, 37),
(16, 38),
(16, 105),
(16, 109),
(16, 110),
(17, 13),
(17, 15),
(17, 21),
(17, 23),
(17, 41),
(17, 44),
(17, 101),
(17, 113),
(18, 1),
(18, 13),
(18, 15),
(18, 17),
(18, 22),
(18, 23),
(18, 30),
(18, 104),
(18, 113),
(19, 2),
(19, 5),
(19, 8),
(19, 14),
(19, 17),
(19, 20),
(19, 25),
(19, 105),
(19, 123),
(20, 2),
(20, 8),
(20, 9),
(20, 17),
(20, 20),
(20, 22),
(20, 31),
(20, 58),
(20, 93),
(21, 1),
(21, 16),
(21, 23),
(21, 26),
(21, 37),
(21, 44),
(21, 94),
(21, 114),
(22, 1),
(22, 2),
(22, 3),
(22, 10),
(22, 16),
(22, 17),
(22, 26),
(22, 36),
(22, 58),
(23, 3),
(23, 6),
(23, 10),
(23, 17),
(23, 26),
(23, 46),
(23, 47),
(23, 117),
(23, 119),
(24, 4),
(24, 5),
(24, 13),
(24, 17),
(24, 20),
(24, 21),
(24, 105),
(24, 108),
(25, 6),
(25, 7),
(25, 9),
(25, 17),
(25, 51),
(25, 54),
(25, 103),
(25, 123),
(26, 12),
(26, 16),
(26, 24),
(26, 37),
(26, 60),
(26, 94),
(26, 102),
(26, 103),
(27, 1),
(27, 5),
(27, 12),
(27, 15),
(27, 21),
(27, 23),
(27, 45),
(27, 101),
(28, 3),
(28, 6),
(28, 14),
(28, 17),
(28, 43),
(28, 48),
(28, 104),
(28, 116),
(29, 3),
(29, 10),
(29, 13),
(29, 16),
(29, 21),
(29, 26),
(29, 45),
(29, 114),
(30, 6),
(30, 7),
(30, 16),
(30, 17),
(30, 47),
(30, 72),
(30, 104),
(30, 109),
(31, 1),
(31, 3),
(31, 13),
(31, 22),
(31, 23),
(31, 43),
(31, 95),
(31, 110),
(32, 2),
(32, 15),
(32, 17),
(32, 20),
(32, 25),
(32, 57),
(32, 58),
(32, 95),
(33, 13),
(33, 14),
(33, 17),
(33, 22),
(33, 31),
(33, 44),
(33, 66),
(33, 113),
(34, 2),
(34, 17),
(34, 20),
(34, 22),
(34, 31),
(34, 37),
(34, 61),
(34, 123),
(35, 17),
(35, 27),
(35, 28),
(35, 47),
(35, 52),
(35, 99),
(35, 120),
(36, 15),
(36, 17),
(36, 27),
(36, 28),
(36, 52),
(36, 85),
(36, 113),
(37, 2),
(37, 8),
(37, 14),
(37, 17),
(37, 22),
(37, 25),
(37, 33),
(37, 61),
(38, 13),
(38, 14),
(38, 15),
(38, 41),
(38, 44),
(38, 104),
(38, 111),
(38, 113),
(39, 3),
(39, 6),
(39, 14),
(39, 17),
(39, 21),
(39, 25),
(39, 46),
(39, 115),
(39, 116),
(40, 10),
(40, 17),
(40, 27),
(40, 28),
(40, 48),
(40, 49),
(40, 115),
(41, 13),
(41, 16),
(41, 22),
(41, 24),
(41, 40),
(41, 44),
(41, 102),
(41, 113),
(42, 15),
(42, 17),
(42, 25),
(42, 27),
(42, 104),
(42, 107),
(42, 111),
(42, 121),
(43, 9),
(43, 14),
(43, 15),
(43, 18),
(43, 19),
(43, 25),
(43, 35),
(43, 51),
(44, 12),
(44, 16),
(44, 21),
(44, 24),
(44, 37),
(44, 43),
(44, 80),
(44, 102),
(45, 6),
(45, 7),
(45, 16),
(45, 47),
(45, 72),
(45, 104),
(45, 107),
(45, 108),
(46, 1),
(46, 13),
(46, 15),
(46, 17),
(46, 18),
(46, 22),
(46, 30),
(46, 43),
(46, 110),
(47, 1),
(47, 3),
(47, 10),
(47, 13),
(47, 21),
(47, 43),
(47, 101),
(48, 12),
(48, 16),
(48, 18),
(48, 22),
(48, 24),
(48, 37),
(48, 110),
(48, 113),
(49, 12),
(49, 14),
(49, 15),
(49, 24),
(49, 44),
(49, 60),
(49, 113),
(50, 12),
(50, 16),
(50, 18),
(50, 25),
(50, 35),
(50, 37),
(50, 60),
(50, 113),
(51, 16),
(51, 19),
(51, 25),
(51, 37),
(51, 124),
(52, 3),
(52, 10),
(52, 16),
(52, 22),
(52, 24),
(52, 36),
(52, 37),
(52, 114),
(53, 3),
(53, 16),
(53, 17),
(53, 18),
(53, 25),
(53, 36),
(53, 55),
(53, 103),
(53, 110),
(54, 1),
(54, 3),
(54, 10),
(54, 14),
(54, 17),
(54, 22),
(54, 36),
(54, 44),
(55, 5),
(55, 6),
(55, 7),
(55, 16),
(55, 47),
(55, 72),
(55, 108),
(55, 109),
(56, 17),
(56, 27),
(56, 28),
(56, 44),
(56, 60),
(56, 98),
(56, 120),
(57, 13),
(57, 15),
(57, 17),
(57, 21),
(57, 24),
(57, 44),
(57, 101),
(57, 113),
(58, 13),
(58, 14),
(58, 17),
(58, 18),
(58, 24),
(58, 44),
(58, 110),
(59, 12),
(59, 13),
(59, 15),
(59, 17),
(59, 22),
(59, 24),
(59, 44),
(59, 113),
(60, 13),
(60, 14),
(60, 15),
(60, 17),
(60, 25),
(60, 34),
(60, 111),
(60, 113),
(61, 12),
(61, 15),
(61, 17),
(61, 21),
(61, 23),
(61, 24),
(61, 44),
(61, 113),
(62, 3),
(62, 6),
(62, 10),
(62, 17),
(62, 20),
(62, 25),
(62, 47),
(62, 115),
(62, 116),
(63, 6),
(63, 7),
(63, 15),
(63, 16),
(63, 45),
(63, 72),
(63, 104),
(63, 111),
(64, 1),
(64, 13),
(64, 16),
(64, 21),
(64, 23),
(64, 45),
(64, 47),
(64, 108),
(65, 1),
(65, 13),
(65, 15),
(65, 17),
(65, 21),
(65, 23),
(65, 45),
(65, 107),
(66, 12),
(66, 17),
(66, 20),
(66, 22),
(66, 41),
(66, 95),
(66, 105),
(67, 2),
(67, 15),
(67, 17),
(67, 25),
(67, 41),
(67, 56),
(67, 58),
(67, 95),
(68, 17),
(68, 20),
(68, 22),
(68, 24),
(68, 25),
(68, 55),
(68, 58),
(68, 123),
(69, 1),
(69, 9),
(69, 13),
(69, 16),
(69, 17),
(69, 22),
(69, 24),
(69, 31),
(69, 44),
(70, 12),
(70, 16),
(70, 17),
(70, 23),
(70, 26),
(70, 27),
(70, 117),
(70, 119),
(71, 15),
(71, 17),
(71, 19),
(71, 25),
(71, 33),
(71, 107),
(71, 108),
(71, 124),
(72, 13),
(72, 14),
(72, 17),
(72, 22),
(72, 30),
(72, 44),
(72, 76),
(72, 113),
(73, 12),
(73, 14),
(73, 17),
(73, 22),
(73, 24),
(73, 44),
(73, 76),
(73, 113),
(74, 15),
(74, 17),
(74, 19),
(74, 21),
(74, 25),
(74, 58),
(74, 111),
(74, 113),
(75, 15),
(75, 17),
(75, 18),
(75, 21),
(75, 25),
(75, 35),
(75, 113),
(76, 12),
(76, 16),
(76, 20),
(76, 24),
(76, 30),
(76, 37),
(76, 121),
(76, 123);

-- --------------------------------------------------------

--
-- Struttura della tabella `gpu`
--

CREATE TABLE `gpu` (
  `id` int(11) NOT NULL,
  `manufacturer` varchar(100) NOT NULL,
  `model_name` varchar(100) NOT NULL,
  `vram_gb` int(11) DEFAULT NULL,
  `score` decimal(3,1) DEFAULT 0.0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `gpu`
--

INSERT INTO `gpu` (`id`, `manufacturer`, `model_name`, `vram_gb`, `score`) VALUES
(1, 'NVIDIA', 'GeForce RTX 5090', 32, 10.0),
(2, 'NVIDIA', 'GeForce RTX 4090', 24, 9.9),
(3, 'AMD', 'Radeon RX 7900 XTX', 24, 9.6),
(4, 'NVIDIA', 'GeForce RTX 5080', 16, 9.8),
(5, 'NVIDIA', 'GeForce RTX 4080 Super', 16, 9.5),
(6, 'AMD', 'Radeon RX 7900 XT', 20, 9.2),
(7, 'NVIDIA', 'GeForce RTX 4070 Ti Super', 16, 9.1),
(8, 'Intel', 'Arc B580', 12, 8.4),
(9, 'NVIDIA', 'GeForce RTX 4070 Super', 12, 8.9),
(10, 'AMD', 'Radeon RX 7800 XT', 16, 8.7),
(11, 'NVIDIA', 'GeForce RTX 3080', 10, 8.5),
(12, 'AMD', 'Radeon RX 6800 XT', 16, 8.3),
(13, 'Intel', 'Arc A770', 16, 8.2),
(14, 'NVIDIA', 'GeForce RTX 4060 Ti', 16, 8.0),
(15, 'AMD', 'Radeon RX 7700 XT', 12, 7.9),
(16, 'NVIDIA', 'GeForce RTX 4060', 8, 7.7),
(17, 'AMD', 'Radeon RX 7600 XT', 16, 7.5),
(18, 'NVIDIA', 'GeForce RTX 3060', 12, 7.3),
(19, 'AMD', 'Radeon RX 6700 XT', 12, 7.6),
(20, 'NVIDIA', 'GeForce RTX 2080 Ti', 11, 7.4),
(21, 'AMD', 'Radeon RX 6650 XT', 8, 7.1),
(22, 'NVIDIA', 'GeForce GTX 1080 Ti', 11, 7.0),
(23, 'Intel', 'Arc A380', 6, 6.0),
(24, 'NVIDIA', 'GeForce RTX 3050', 8, 6.5),
(25, 'AMD', 'Radeon RX 6500 XT', 4, 5.8),
(26, 'NVIDIA', 'GeForce GTX 1660 Super', 6, 6.2),
(27, 'AMD', 'Radeon RX 580', 8, 5.5),
(28, 'NVIDIA', 'GeForce GTX 1650', 4, 5.0),
(29, 'NVIDIA', 'GeForce GTX 1050 Ti', 4, 4.5),
(30, 'AMD', 'Radeon RX 560', 4, 4.0),
(31, 'NVIDIA', 'GeForce GT 1030', 2, 3.2),
(32, 'AMD', 'Radeon RX 550', 4, 3.8),
(33, 'NVIDIA', 'GeForce GT 730', 2, 2.0),
(34, 'NVIDIA', 'GeForce GT 710', 2, 1.0);

-- --------------------------------------------------------

--
-- Struttura della tabella `motherboard`
--

CREATE TABLE `motherboard` (
  `id` int(11) NOT NULL,
  `manufacturer` varchar(100) NOT NULL,
  `model_name` varchar(100) NOT NULL,
  `chipset` varchar(50) DEFAULT NULL,
  `socket_type` varchar(50) DEFAULT NULL,
  `score` decimal(3,1) DEFAULT 0.0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `motherboard`
--

INSERT INTO `motherboard` (`id`, `manufacturer`, `model_name`, `chipset`, `socket_type`, `score`) VALUES
(1, 'ASUS', 'ROG Maximus Z890 Extreme', 'Z890', 'LGA 1851', 10.0),
(2, 'MSI', 'MEG X870E GODLIKE', 'X870E', 'AM5', 10.0),
(3, 'Gigabyte', 'X870E AORUS MASTER', 'X870E', 'AM5', 9.8),
(4, 'ASRock', 'Z890 Taichi', 'Z890', 'LGA 1851', 9.7),
(5, 'ASUS', 'ROG Crosshair X670E Hero', 'X670E', 'AM5', 9.6),
(6, 'MSI', 'MPG Z790 Carbon WIFI', 'Z790', 'LGA 1700', 9.4),
(7, 'Gigabyte', 'Z790 AORUS ELITE AX', 'Z790', 'LGA 1700', 8.9),
(8, 'ASUS', 'TUF Gaming X870-Plus WIFI', 'X870', 'AM5', 9.1),
(9, 'MSI', 'MAG B650 Tomahawk WIFI', 'B650', 'AM5', 8.8),
(10, 'ASRock', 'B650E Steel Legend WIFI', 'B650E', 'AM5', 8.9),
(11, 'Gigabyte', 'B650 Gaming X AX', 'B650', 'AM5', 8.5),
(12, 'ASUS', 'ROG STRIX B760-F GAMING WIFI', 'B760', 'LGA 1700', 8.6),
(13, 'MSI', 'PRO B760-P WIFI', 'B760', 'LGA 1700', 7.5),
(14, 'ASRock', 'Z790 Pro RS', 'Z790', 'LGA 1700', 8.2),
(15, 'ASUS', 'ROG STRIX B550-F GAMING', 'B550', 'AM4', 8.1),
(16, 'Gigabyte', 'X570S AORUS Master', 'X570', 'AM4', 8.7),
(17, 'MSI', 'MAG B550 Torpedo', 'B550', 'AM4', 7.9),
(18, 'ASRock', 'B550 Phantom Gaming 4', 'B550', 'AM4', 7.2),
(19, 'ASUS', 'Prime B650M-A WIFI', 'B650', 'AM5', 7.4),
(20, 'Gigabyte', 'A620M GAMING X', 'A620', 'AM5', 6.8),
(21, 'MSI', 'PRO H610M-G DDR4', 'H610', 'LGA 1700', 6.2),
(22, 'ASRock', 'A620M-HDV/M.2', 'A620', 'AM5', 6.0),
(23, 'ASUS', 'Prime H510M-E', 'H510', 'LGA 1200', 5.5),
(24, 'Gigabyte', 'B450M DS3H V2', 'B450', 'AM4', 6.5),
(25, 'MSI', 'A520M-A PRO', 'A520', 'AM4', 5.8),
(26, 'ASRock', 'H110M-DGS', 'H110', 'LGA 1151', 4.5),
(27, 'ASUS', 'H81M-K', 'H81', 'LGA 1150', 3.8),
(28, 'Gigabyte', 'GA-H61M-DS2', 'H61', 'LGA 1155', 3.2),
(29, 'MSI', 'G41M-P33 Combo', 'G41', 'LGA 775', 2.5),
(30, 'Biostar', 'H310MHP', 'H310', 'LGA 1151', 4.2),
(31, 'ASRock', 'N68-GS4 FX', 'nForce 630a', 'AM3+', 2.0);

-- --------------------------------------------------------

--
-- Struttura della tabella `pc`
--

CREATE TABLE `pc` (
  `id` int(11) NOT NULL,
  `config_name` varchar(150) DEFAULT NULL,
  `id_ram` int(11) NOT NULL,
  `id_motherboard` int(11) NOT NULL,
  `id_cpu` int(11) NOT NULL,
  `id_gpu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `pc`
--

INSERT INTO `pc` (`id`, `config_name`, `id_ram`, `id_motherboard`, `id_cpu`, `id_gpu`) VALUES
(1, 'Enthusiast Ultra (2025)', 1, 1, 4, 1),
(2, 'Enthusiast Pro (2025)', 5, 2, 5, 1),
(3, 'High-End Gaming (2025)', 12, 5, 6, 2),
(4, 'High-End Streamer Edition', 15, 6, 8, 5),
(5, 'Upper Mid-Range Performance', 18, 8, 12, 10),
(6, 'Mid-Range Gaming (2025)', 22, 11, 18, 16),
(7, 'Standard Gaming Build', 25, 15, 20, 20),
(8, 'Balanced Budget Build', 28, 18, 21, 22),
(9, 'Entry Level Gaming Plus', 30, 20, 22, 24),
(10, 'Entry Level Gaming', 33, 24, 23, 26),
(11, 'Budget Performance PC', 38, 24, 25, 27),
(12, 'Minimum Performance PC', 41, 25, 26, 28),
(13, 'Advanced Office PC', 48, 27, 30, 30),
(16, 'config', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `ram`
--

CREATE TABLE `ram` (
  `id` int(11) NOT NULL,
  `brand` varchar(100) NOT NULL,
  `model_name` varchar(100) NOT NULL,
  `quantity_gb` int(11) NOT NULL,
  `frequency_mhz` int(11) NOT NULL,
  `memory_type` varchar(10) NOT NULL,
  `score` decimal(3,1) DEFAULT 0.0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `ram`
--

INSERT INTO `ram` (`id`, `brand`, `model_name`, `quantity_gb`, `frequency_mhz`, `memory_type`, `score`) VALUES
(1, 'G.Skill', 'Trident Z5 CK (CUDIMM) 32GB', 32, 9000, 'DDR5', 10.0),
(2, 'G.Skill', 'Trident Z5 RGB 48GB', 48, 8400, 'DDR5', 10.0),
(3, 'Corsair', 'Dominator Titanium 64GB', 64, 8000, 'DDR5', 9.9),
(4, 'TeamGroup', 'T-Force XTREEM ARGB 32GB', 32, 8200, 'DDR5', 9.9),
(5, 'Kingston', 'Fury Renegade Pro 128GB', 128, 5600, 'DDR5', 9.9),
(6, 'Patriot', 'Viper Xtreme 5 32GB', 32, 8000, 'DDR5', 9.8),
(7, 'Kingston', 'Fury Renegade RGB 48GB', 48, 8000, 'DDR5', 9.8),
(8, 'Corsair', 'Dominator Platinum RGB 32GB', 32, 7200, 'DDR5', 9.8),
(9, 'G.Skill', 'Trident Z5 RGB 32GB', 32, 6400, 'DDR5', 9.7),
(10, 'G.Skill', 'Trident Z Royal 64GB', 64, 3600, 'DDR4', 9.6),
(11, 'Corsair', 'Vengeance RGB 64GB', 64, 6000, 'DDR5', 9.5),
(12, 'G.Skill', 'Trident Z5 Neo RGB (AMD Expo) 32GB', 32, 6000, 'DDR5', 9.5),
(13, 'Kingston', 'Fury Renegade 32GB', 32, 7200, 'DDR5', 9.5),
(14, 'Corsair', 'Vengeance RGB 32GB', 32, 6400, 'DDR5', 9.4),
(15, 'Patriot', 'Viper Venom 32GB', 32, 7400, 'DDR5', 9.4),
(16, 'TeamGroup', 'T-Force Delta RGB 48GB', 48, 7200, 'DDR5', 9.4),
(17, 'ADATA', 'XPG Lancer Blade RGB 32GB', 32, 6400, 'DDR5', 9.3),
(18, 'Patriot', 'Viper Steel 16GB', 16, 4400, 'DDR4', 9.3),
(19, 'Lexar', 'ARES RGB 32GB', 32, 6400, 'DDR5', 9.2),
(20, 'G.Skill', 'Trident Z Neo 32GB', 32, 4000, 'DDR4', 9.2),
(21, 'TeamGroup', 'T-Force Delta RGB 32GB', 32, 6000, 'DDR5', 9.1),
(22, 'Crucial', 'Pro Overclocking 32GB', 32, 6000, 'DDR5', 9.1),
(23, 'Mushkin', 'Redline Lumina 32GB', 32, 4133, 'DDR4', 9.0),
(24, 'ADATA', 'XPG Lancer RGB 32GB', 32, 6000, 'DDR5', 8.8),
(25, 'Thermaltake', 'TOUGHRAM RGB 16GB', 16, 4400, 'DDR4', 8.8),
(26, 'G.Skill', 'Ripjaws V 16GB', 16, 3600, 'DDR4', 8.7),
(27, 'Crucial', 'Ballistix 16GB', 16, 3600, 'DDR4', 8.6),
(28, 'Corsair', 'Vengeance RGB Pro 16GB', 16, 3200, 'DDR4', 8.5),
(29, 'Gigabyte', 'AORUS RGB 16GB', 16, 3733, 'DDR4', 8.5),
(30, 'Crucial', 'Pro RAM 32GB', 32, 5600, 'DDR5', 8.5),
(31, 'Corsair', 'Vengeance LPX 32GB', 32, 3200, 'DDR4', 8.4),
(32, 'Kingston', 'Fury Beast 16GB', 16, 5200, 'DDR5', 8.3),
(33, 'PNY', 'XLR8 Gaming Epic-X 16GB', 16, 3200, 'DDR4', 8.0),
(34, 'G.Skill', 'Trident Z RGB 8GB', 8, 3000, 'DDR4', 7.9),
(35, 'TeamGroup', 'T-Force Vulcan Z 16GB', 16, 3200, 'DDR4', 7.8),
(36, 'Samsung', 'OEM Desktop 16GB', 16, 3200, 'DDR4', 7.5),
(37, 'Crucial', 'Standard Desktop 8GB', 8, 4800, 'DDR5', 7.2),
(38, 'TeamGroup', 'Elite DDR5 16GB', 16, 4800, 'DDR5', 6.9),
(39, 'Crucial', 'Classic Desktop 16GB', 16, 3200, 'DDR4', 6.8),
(40, 'Silicon Power', 'DDR4 16GB RAM', 16, 3200, 'DDR4', 6.5),
(41, 'Kingston', 'ValueRAM 8GB', 8, 2666, 'DDR4', 6.2),
(42, 'ADATA', 'Premier 8GB', 8, 3200, 'DDR4', 6.1),
(43, 'Patriot', 'Signature Line 8GB', 8, 2400, 'DDR4', 5.9),
(44, 'Pny', 'Performance 8GB', 8, 2666, 'DDR4', 5.5),
(45, 'G.Skill', 'Value Series 4GB', 4, 2400, 'DDR4', 4.8),
(46, 'Samsung', 'OEM Green Stick 4GB', 4, 2133, 'DDR4', 4.5),
(47, 'Apacer', 'DDR4 Unbuffered 4GB', 4, 2400, 'DDR4', 4.4),
(48, 'Mushkin', 'Essentials 8GB', 8, 1600, 'DDR3', 4.2),
(49, 'Timetec', 'Hynix IC 8GB', 8, 1600, 'DDR3', 4.0),
(50, 'Hynix', 'Generic Desktop 4GB', 4, 1600, 'DDR3', 3.8),
(51, 'Crucial', 'CT51264BA160B 4GB', 4, 1600, 'DDR3', 3.5),
(52, 'Kingston', 'KVR DDR3 4GB', 4, 1333, 'DDR3', 3.2),
(53, 'Patriot', 'Signature Line 4GB', 4, 1333, 'DDR3', 3.0),
(54, 'Integral', 'Value Series 2GB', 2, 1333, 'DDR3', 2.1);

-- --------------------------------------------------------

--
-- Struttura della tabella `tags`
--

CREATE TABLE `tags` (
  `id_tag` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `tags`
--

INSERT INTO `tags` (`id_tag`, `name`) VALUES
(57, '2D'),
(58, '3D'),
(119, '4X'),
(130, 'Abstract'),
(22, 'Action'),
(71, 'Action RPG'),
(1, 'Adventure'),
(133, 'Anime'),
(62, 'Arcade'),
(111, 'Arena Shooter'),
(137, 'Asynchronous Multiplayer'),
(14, 'Atmospheric'),
(83, 'Auto Battler'),
(127, 'Automation'),
(97, 'Automobile Sim'),
(84, 'Base Building'),
(115, 'Battle Royale'),
(74, 'Beat \'em up'),
(116, 'Boomer Shooter'),
(10, 'Building'),
(32, 'Bullet Hell'),
(50, 'Card Battler'),
(53, 'Casual'),
(99, 'Character Customization'),
(121, 'Choices Matter'),
(48, 'City Builder'),
(89, 'Clicker'),
(37, 'Co-op'),
(125, 'Colony Sim'),
(38, 'Competitive'),
(36, 'Crafting'),
(138, 'Cross-Platform'),
(79, 'CRPG'),
(41, 'Cyberpunk'),
(5, 'Dark Fantasy'),
(86, 'Dating Sim'),
(51, 'Deckbuilding'),
(67, 'Detective'),
(20, 'Difficult'),
(54, 'Dungeon Crawler'),
(47, 'Economy'),
(65, 'Educational'),
(39, 'eSports'),
(129, 'Experimental'),
(94, 'Exploration'),
(114, 'Extraction Shooter'),
(11, 'Farming Sim'),
(75, 'Fighting'),
(12, 'First-Person'),
(98, 'Flight Sim'),
(135, 'FMV'),
(88, 'God Game'),
(73, 'Grand Strategy'),
(109, 'Grimdark'),
(31, 'Hack and Slash'),
(132, 'Hand-drawn'),
(113, 'Hero Shooter'),
(90, 'Hidden Object'),
(106, 'Historical'),
(18, 'Horror'),
(76, 'Immersive Sim'),
(25, 'Indie'),
(78, 'JRPG'),
(85, 'Life Sim'),
(136, 'Local Co-Op'),
(92, 'Logic'),
(103, 'Loot'),
(80, 'Looter Shooter'),
(108, 'Lovecraftian'),
(46, 'Management'),
(96, 'Mechs'),
(45, 'Medieval'),
(8, 'Metroidvania'),
(110, 'Minimalist'),
(40, 'MMORPG'),
(16, 'Multiplayer'),
(100, 'Multiple Endings'),
(63, 'Music'),
(66, 'Mystery'),
(123, 'Narrative'),
(68, 'Noir'),
(122, 'Nonlinear'),
(23, 'Open World'),
(124, 'Open World Survival Craft'),
(95, 'Parkour'),
(82, 'Party Game'),
(102, 'Perma-death'),
(91, 'Physics'),
(59, 'Pixel Art'),
(2, 'Platformer'),
(33, 'Point & Click'),
(105, 'Political'),
(43, 'Post-apocalyptic'),
(101, 'Procedural Generation'),
(35, 'Psychological Horror'),
(19, 'Puzzle'),
(28, 'Racing'),
(118, 'Real-Time Strategy'),
(52, 'Relaxing'),
(126, 'Resource Management'),
(61, 'Retro'),
(64, 'Rhythm'),
(93, 'Rogue-lite'),
(9, 'Roguelike'),
(21, 'RPG'),
(26, 'Sandbox'),
(44, 'Sci-fi'),
(77, 'Shoot \'em up'),
(24, 'Shooter'),
(56, 'Side Scroller'),
(27, 'Simulation'),
(17, 'Singleplayer'),
(81, 'Social Deduction'),
(4, 'Souls-like'),
(69, 'Space'),
(29, 'Sports'),
(30, 'Stealth'),
(42, 'Steampunk'),
(15, 'Story Rich'),
(6, 'Strategy'),
(131, 'Stylized'),
(3, 'Survival'),
(120, 'Survival Horror'),
(72, 'Tactical'),
(87, 'Text-Based'),
(13, 'Third-Person'),
(55, 'Top-Down'),
(49, 'Tower Defense'),
(104, 'Trading'),
(7, 'Turn-Based'),
(117, 'Turn-Based Tactics'),
(112, 'Twin Stick Shooter'),
(128, 'Vehicle Building'),
(34, 'Visual Novel'),
(134, 'Voxel'),
(60, 'VR'),
(70, 'Walking Simulator'),
(107, 'War');

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `id_main_pc` int(11) DEFAULT NULL,
  `registration_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`id`, `username`, `password_hash`, `id_main_pc`, `registration_date`) VALUES
(1, 'Kynda', '$2y$10$5WCy65o2Im23rQHGPsNpOe61N2jxjqvqoUqYH4VZLKEwZXpQRaXyW', 16, '2026-01-31 15:53:50');

-- --------------------------------------------------------

--
-- Struttura della tabella `user_games`
--

CREATE TABLE `user_games` (
  `id_user` int(11) NOT NULL,
  `id_game` int(11) NOT NULL,
  `purchase_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `cpu`
--
ALTER TABLE `cpu`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `model_name` (`model_name`);

--
-- Indici per le tabelle `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id_game`),
  ADD KEY `id_min_pc` (`id_min_pc`),
  ADD KEY `id_recommended_pc` (`id_recommended_pc`);

--
-- Indici per le tabelle `game_tags`
--
ALTER TABLE `game_tags`
  ADD PRIMARY KEY (`id_game`,`id_tag`),
  ADD KEY `id_tag` (`id_tag`);

--
-- Indici per le tabelle `gpu`
--
ALTER TABLE `gpu`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `model_name` (`model_name`);

--
-- Indici per le tabelle `motherboard`
--
ALTER TABLE `motherboard`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `model_name` (`model_name`);

--
-- Indici per le tabelle `pc`
--
ALTER TABLE `pc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ram` (`id_ram`),
  ADD KEY `id_motherboard` (`id_motherboard`),
  ADD KEY `id_cpu` (`id_cpu`),
  ADD KEY `id_gpu` (`id_gpu`);

--
-- Indici per le tabelle `ram`
--
ALTER TABLE `ram`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `model_name` (`model_name`);

--
-- Indici per le tabelle `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id_tag`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `id_main_pc` (`id_main_pc`);

--
-- Indici per le tabelle `user_games`
--
ALTER TABLE `user_games`
  ADD PRIMARY KEY (`id_user`,`id_game`),
  ADD KEY `id_game` (`id_game`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `cpu`
--
ALTER TABLE `cpu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT per la tabella `games`
--
ALTER TABLE `games`
  MODIFY `id_game` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT per la tabella `gpu`
--
ALTER TABLE `gpu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT per la tabella `motherboard`
--
ALTER TABLE `motherboard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT per la tabella `pc`
--
ALTER TABLE `pc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT per la tabella `ram`
--
ALTER TABLE `ram`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT per la tabella `tags`
--
ALTER TABLE `tags`
  MODIFY `id_tag` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT per la tabella `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `games`
--
ALTER TABLE `games`
  ADD CONSTRAINT `games_ibfk_1` FOREIGN KEY (`id_min_pc`) REFERENCES `pc` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `games_ibfk_2` FOREIGN KEY (`id_recommended_pc`) REFERENCES `pc` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Limiti per la tabella `game_tags`
--
ALTER TABLE `game_tags`
  ADD CONSTRAINT `game_tags_ibfk_1` FOREIGN KEY (`id_game`) REFERENCES `games` (`id_game`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `game_tags_ibfk_2` FOREIGN KEY (`id_tag`) REFERENCES `tags` (`id_tag`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `pc`
--
ALTER TABLE `pc`
  ADD CONSTRAINT `pc_ibfk_1` FOREIGN KEY (`id_ram`) REFERENCES `ram` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pc_ibfk_2` FOREIGN KEY (`id_motherboard`) REFERENCES `motherboard` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pc_ibfk_3` FOREIGN KEY (`id_cpu`) REFERENCES `cpu` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pc_ibfk_4` FOREIGN KEY (`id_gpu`) REFERENCES `gpu` (`id`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_main_pc`) REFERENCES `pc` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Limiti per la tabella `user_games`
--
ALTER TABLE `user_games`
  ADD CONSTRAINT `user_games_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_games_ibfk_2` FOREIGN KEY (`id_game`) REFERENCES `games` (`id_game`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

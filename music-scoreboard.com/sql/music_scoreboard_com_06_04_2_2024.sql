-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-06-2024 a las 04:39:21
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `music_scoreboard_com`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `albumes`
--

CREATE TABLE `albumes` (
  `id` int(11) NOT NULL,
  `artista_id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `ruta` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `albumes`
--

INSERT INTO `albumes` (`id`, `artista_id`, `nombre`, `ruta`) VALUES
(1, 1, 'Stiff Upper Lip', '/storage/musica/acdc/stiff_upper_lip/presentacion_img.jpg'),
(2, 3, 'Un Verano Sin Ti', '/storage/musica/bad_bunny/un_verano_sin_ti/presentacion_img.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `artistas`
--

CREATE TABLE `artistas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `descripcion` varchar(300) NOT NULL,
  `ruta` varchar(100) NOT NULL,
  `descripcion_larga` mediumtext NOT NULL,
  `slug` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `artistas`
--

INSERT INTO `artistas` (`id`, `nombre`, `categoria_id`, `descripcion`, `ruta`, `descripcion_larga`, `slug`) VALUES
(1, 'AC/DC', 2, 'AC/DC es una banda de hard rock británica-australiana, formada en 1973 en Australia por los hermanos escoceses Malcolm Young y Angus Young y Dave Evans como vocalista. Sus álbumes se han vendido en un total estimado de 200 millones de copias, embarcándose en giras multitudinarias por todo el mundo y', '/storage/musica/acdc/presentacion_img.jpg', '<p>AC/DC es una banda de rock formada en Sídney, Australia, en 1973 por los hermanos Malcolm y Angus Young. Conocidos por su estilo distintivo de rock duro, sus riffs de guitarra electrizantes y su actitud enérgica, AC/DC se ha convertido en una de las bandas más influyentes y exitosas de la historia del rock. A lo largo de su carrera, han vendido más de 200 millones de álbumes en todo el mundo, consolidándose como leyendas del género.</p>\r\n\r\n<p>El sonido de AC/DC se caracteriza por su simplicidad y potencia. La banda ha mantenido un enfoque consistente en la creación de música rock directa y sin pretensiones, con un fuerte énfasis en los riffs de guitarra y ritmos contundentes. Angus Young, conocido por su uniforme escolar y sus frenéticas actuaciones en el escenario, es una figura icónica del rock y ha sido el principal guitarrista y showman de la banda desde su formación. Su estilo de tocar la guitarra, influenciado por el blues, es uno de los sellos distintivos del sonido de AC/DC.</p>\r\n\r\n<p>En 1975, AC/DC lanzó su álbum debut, \"High Voltage\", que rápidamente les ganó una base de fans leal en Australia. Con la incorporación del carismático vocalista Bon Scott, la banda comenzó a ganar reconocimiento internacional. Álbumes como \"T.N.T.\" y \"Dirty Deeds Done Dirt Cheap\" mostraron su talento para crear canciones pegajosas y poderosas, y les ayudaron a consolidar su reputación en la escena del rock.</p>\r\n\r\n<p>El punto de inflexión en la carrera de AC/DC llegó con el lanzamiento de \"Highway to Hell\" en 1979. Este álbum no solo catapultó a la banda al estrellato mundial, sino que también se convirtió en uno de los álbumes de rock más emblemáticos de todos los tiempos. Sin embargo, la tragedia golpeó a la banda en 1980 cuando Bon Scott falleció repentinamente. A pesar de esta pérdida devastadora, AC/DC decidió continuar y reclutó al cantante Brian Johnson para reemplazar a Scott.</p>\r\n\r\n<p>Con Brian Johnson al frente, AC/DC lanzó \"Back in Black\" en 1980, un álbum que se ha convertido en uno de los más vendidos de todos los tiempos. Con éxitos como \"Hells Bells\", \"You Shook Me All Night Long\" y la icónica \"Back in Black\", este álbum consolidó aún más la posición de AC/DC en la cima del rock. \"Back in Black\" es ampliamente considerado un clásico y un testamento a la capacidad de la banda para sobreponerse a la adversidad y seguir creando música poderosa.</p>\r\n\r\n<p>A lo largo de los años 80 y 90, AC/DC continuó lanzando álbumes exitosos y realizando giras mundiales. Álbumes como \"For Those About to Rock We Salute You\", \"The Razors Edge\" y \"Ballbreaker\" mantuvieron su relevancia en la escena del rock. Su capacidad para mantener un sonido consistente y fiel a sus raíces, mientras seguían evolucionando, ha sido una de las claves de su longevidad y éxito continuo.</p>\r\n\r\n<p>En las últimas décadas, AC/DC ha seguido siendo una fuerza imparable en el rock. A pesar de los cambios en la formación y los desafíos personales, la banda ha continuado produciendo música y llenando estadios alrededor del mundo. Su álbum de 2020, \"Power Up\", fue aclamado por críticos y fans, demostrando que, incluso después de casi cinco décadas, AC/DC sigue siendo relevante y poderosa.</p>\r\n\r\n<p>En resumen, AC/DC es una banda que ha dejado una huella indeleble en la historia del rock. Con su estilo inconfundible, su energía inagotable y su dedicación a la música, han influenciado a innumerables artistas y han ganado el cariño de millones de fans en todo el mundo. La historia de AC/DC es una historia de perseverancia, pasión y puro rock and roll.</p>\r\n', 'ac-dc'),
(2, '50 Cent', 1, 'Curtis James Jackson (Queens, Nueva York, 6 de julio de 1975), más conocido por su nombre artístico 50 Cent, es un rapero, compositor y actor estadounidense. Alcanzó la fama mundial con el lanzamiento de sus álbumes Get Rich or Die Tryin’ (2003) y The Massacre (2005), ambos de ellos logrando éxito m', '/storage/musica/50_cent/presentacion_img.jpg', '<p>50 Cent, cuyo nombre real es Curtis James Jackson III, es un rapero, actor, empresario y productor musical estadounidense. Nació el 6 de julio de 1975 en el barrio de Queens, Nueva York, y se convirtió en una de las figuras más destacadas y controvertidas del hip-hop en la década de 2000. Su ascenso al estrellato estuvo marcado por una historia de superación personal, enfrentando numerosos desafíos y adversidades en su vida antes de alcanzar el éxito.</p>\r\n\r\n<p>Antes de su carrera musical, 50 Cent vivió una infancia difícil en South Jamaica, Queens. Criado por su madre soltera, que fue asesinada cuando él tenía solo ocho años, 50 Cent se involucró en la venta de drogas desde una edad temprana. Su vida tomó un giro drástico cuando fue disparado nueve veces en 2000, un incidente que casi le costó la vida. Tras su recuperación, decidió dedicarse plenamente a la música, usando sus experiencias de vida como inspiración para sus letras.</p>\r\n\r\n<p>El primer gran avance de 50 Cent llegó en 2002 cuando fue descubierto por el rapero Eminem y el productor Dr. Dre. Juntos, lo firmaron para sus sellos discográficos, Shady Records y Aftermath Entertainment. Su álbum debut, \"Get Rich or Die Tryin\'\", lanzado en 2003, fue un éxito monumental, vendiendo más de 800,000 copias en su primera semana y eventualmente siendo certificado como multi-platino. Canciones como \"In da Club\", \"21 Questions\" y \"P.I.M.P.\" se convirtieron en éxitos internacionales y consolidaron a 50 Cent como una superestrella del rap.</p>\r\n\r\n<p>\"Get Rich or Die Tryin\'\" no solo fue un éxito comercial, sino que también recibió elogios de la crítica por su producción y letras crudas que detallaban la vida en las calles. El álbum es considerado un clásico del hip-hop y ha tenido una influencia duradera en el género. El éxito de este álbum fue seguido por una película biográfica del mismo nombre en 2005, en la que 50 Cent protagonizó y narró su propia historia de vida.</p>\r\n\r\n<p>En 2005, 50 Cent lanzó su segundo álbum, \"The Massacre\", que también fue un éxito comercial, debutando en el número uno en las listas de Billboard y vendiendo más de un millón de copias en su primera semana. Singles como \"Candy Shop\", \"Just a Lil Bit\" y \"Disco Inferno\" dominaron las ondas de radio y reafirmaron su estatus como uno de los raperos más populares del momento. Su estilo distintivo, marcado por su voz ronca y su enfoque en temas de violencia, drogas y éxito, continuó resonando con una amplia audiencia.</p>\r\n\r\n<p>A lo largo de su carrera, 50 Cent ha diversificado sus intereses y ha demostrado ser un astuto hombre de negocios. Fundó su propio sello discográfico, G-Unit Records, y lanzó exitosamente carreras de otros artistas como Lloyd Banks, Tony Yayo y Young Buck. También incursionó en la actuación, apareciendo en varias películas y series de televisión, incluyendo la exitosa serie \"Power\", que él mismo produjo.</p>\r\n\r\n<p>Además de su éxito en la música y el entretenimiento, 50 Cent ha sido un empresario exitoso. Su inversión en VitaminWater, que fue adquirida por Coca-Cola, le reportó millones de dólares. También ha lanzado líneas de ropa, perfumes y auriculares, y ha escrito varios libros, incluyendo su autobiografía y libros de autoayuda y motivación.</p>\r\n\r\n<p>A pesar de sus éxitos, 50 Cent ha enfrentado numerosos desafíos, incluyendo disputas legales, conflictos con otros artistas y problemas financieros. Sin embargo, su capacidad para reinventarse y superar la adversidad ha sido una constante en su carrera. Su influencia en la cultura del hip-hop y su historia de resiliencia continúan inspirando a muchos.</p>\r\n\r\n<p>En resumen, 50 Cent es una figura multifacética cuya carrera abarca la música, el cine, los negocios y más. Su impacto en el hip-hop y su capacidad para triunfar a pesar de las adversidades lo han convertido en un ícono de la cultura popular contemporánea. Su vida y su obra siguen siendo un testimonio de perseverancia, talento y ambición.</p>\r\n', '50-cent'),
(3, 'Bad Bunny', 3, 'Benito Antonio Martínez Ocasio (Vega Baja, Puerto Rico; 10 de marzo de 1994), conocido artísticamente como Bad Bunny, es un cantante, compositor, productor discográfico y luchador puertorriqueño. Caracterizado por su entonación grave, sus estilos musicales son generalmente definidos como reguetón y ', '/storage/musica/bad_bunny/presentacion_img.jpg', '<p>Bad Bunny, cuyo nombre real es Benito Antonio Martínez Ocasio, es un cantante, rapero y compositor puertorriqueño que ha revolucionado la música latina y el género del reggaetón desde su debut en la escena musical. Nacido el 10 de marzo de 1994 en Vega Baja, Puerto Rico, Bad Bunny se ha convertido en una figura prominente en la música global, conocido por su estilo innovador, sus letras audaces y su impacto cultural significativo.</p>\r\n\r\n<p>Bad Bunny comenzó a ganar reconocimiento en 2016 cuando lanzó su sencillo \"Diles\" en la plataforma SoundCloud. La canción llamó la atención del productor DJ Luian, quien lo firmó para su sello Hear This Music. Este fue el punto de partida de su carrera meteórica, que rápidamente lo llevó a colaborar con artistas establecidos como J Balvin, Ozuna y Daddy Yankee. Su estilo único, que mezcla reggaetón, trap latino y otros géneros urbanos, lo distinguió de otros artistas y le ganó una creciente base de fanáticos.</p>\r\n\r\n<p>En 2018, Bad Bunny lanzó su álbum debut \"X 100PRE\", que fue aclamado tanto por críticos como por fans. El álbum incluía éxitos como \"Mía\" con Drake, \"Estamos Bien\" y \"Solo de Mí\". \"X 100PRE\" mostró la versatilidad de Bad Bunny, incorporando una variedad de estilos musicales y temáticas en sus canciones, desde la fiesta y el amor hasta la reflexión y la crítica social. Este álbum consolidó su estatus como una de las nuevas estrellas más brillantes de la música latina.</p>\r\n\r\n<p>El éxito de Bad Bunny continuó con el lanzamiento de \"Oasis\", un álbum colaborativo con J Balvin en 2019, que produjo éxitos como \"Qué Pretendes\" y \"La Canción\". Ese mismo año, también participó en la canción \"I Like It\" con Cardi B y J Balvin, que se convirtió en un éxito mundial y le valió una nominación al Grammy. Bad Bunny continuó demostrando su capacidad para cruzar barreras culturales y lingüísticas, atrayendo a una audiencia global con su música.</p>\r\n\r\n<p>En 2020, Bad Bunny lanzó dos álbumes que tuvieron un gran impacto: \"YHLQMDLG\" y \"El Último Tour Del Mundo\". \"YHLQMDLG\" (Yo Hago Lo Que Me Da La Gana) fue un álbum que reafirmó su independencia artística y su disposición a experimentar con nuevos sonidos. Incluía éxitos como \"Vete\", \"Safaera\" y \"Yo Perreo Sola\", esta última siendo particularmente notable por su mensaje de empoderamiento femenino y su video musical provocador. \"El Último Tour Del Mundo\" fue un proyecto más introspectivo y experimental, con influencias del rock y otros géneros, y se convirtió en el primer álbum completamente en español en alcanzar el número uno en la lista Billboard 200.</p>\r\n\r\n<p>Bad Bunny también ha sido una voz prominente en cuestiones sociales y políticas. Ha usado su plataforma para abogar por los derechos de la comunidad LGBTQ+, criticar al gobierno de Puerto Rico y apoyar movimientos sociales como el feminismo y Black Lives Matter. Su disposición a abordar temas controvertidos y su autenticidad han resonado con una amplia audiencia, ganándole respeto y admiración más allá de su música.</p>\r\n\r\n<p>Además de su éxito musical, Bad Bunny ha incursionado en la actuación y la moda. Ha participado en la serie de Netflix \"Narcos: México\" y ha lanzado su propia línea de ropa. Su estilo personal, que desafía las normas de género y la moda convencional, ha sido parte integral de su identidad artística y ha influenciado a muchos jóvenes seguidores.</p>\r\n\r\n<p>En resumen, Bad Bunny es una figura revolucionaria en la música contemporánea, cuyo impacto trasciende las fronteras del reggaetón y el trap latino. Con su talento, versatilidad y compromiso con causas sociales, ha redefinido lo que significa ser un artista en el siglo XXI. Su carrera continúa evolucionando y su influencia sigue creciendo, consolidándolo como una de las voces más importantes de su generación.</p>\r\n', 'bad-bunny'),
(4, 'Rihanna', 4, 'Robyn Rihanna Fenty (Parroquia de Saint Michael, Barbados; 20 de febrero de 1988), conocida simplemente como Rihanna, es una cantante, actriz, diseñadora y empresaria barbadense. Nacida en Saint Michael y criada en Bridgetown, Barbados, Rihanna hizo una audición para el productor de discos estadouni', '/storage/musica/rihanna/presentacion_img.jpg', '<p>Rihanna, cuyo nombre completo es Robyn Rihanna Fenty, es una cantante, compositora, actriz y empresaria nacida el 20 de febrero de 1988 en Saint Michael, Barbados. Desde su debut en la industria musical, Rihanna ha dejado una marca indeleble en el panorama del pop y el R&B, convirtiéndose en una de las artistas más influyentes y exitosas de todos los tiempos. Su versatilidad artística y su capacidad para reinventarse continuamente han sido claves para su duradera popularidad.</p>\r\n\r\n<p>Rihanna fue descubierta en Barbados por el productor musical Evan Rogers, quien la llevó a Estados Unidos para grabar una maqueta que eventualmente llegó a las manos de Jay-Z, entonces presidente de Def Jam Recordings. En 2005, firmó un contrato con Def Jam y lanzó su álbum debut, \"Music of the Sun\". El sencillo principal, \"Pon de Replay\", fue un éxito inmediato y catapultó a Rihanna a la fama internacional.</p>\r\n\r\n<p>El éxito inicial de Rihanna fue seguido por el lanzamiento de su segundo álbum, \"A Girl Like Me\", en 2006. Este álbum incluyó éxitos como \"SOS\" y \"Unfaithful\", que consolidaron su posición en la industria musical. Sin embargo, fue su tercer álbum, \"Good Girl Gone Bad\" (2007), el que realmente transformó su carrera. Con éxitos como \"Umbrella\", \"Don\'t Stop the Music\" y \"Disturbia\", Rihanna mostró una imagen más madura y atrevida, y el álbum recibió múltiples nominaciones y premios, incluyendo un Grammy por \"Umbrella\".</p>\r\n\r\n<p>A lo largo de los años, Rihanna ha continuado evolucionando como artista. Sus álbumes posteriores, como \"Rated R\" (2009), \"Loud\" (2010), \"Talk That Talk\" (2011) y \"Unapologetic\" (2012), mostraron su capacidad para explorar diferentes géneros y estilos, desde el dancehall y el reggae hasta el pop y el EDM. Canciones como \"Rude Boy\", \"Only Girl (In the World)\", \"We Found Love\" y \"Diamonds\" se convirtieron en éxitos masivos, consolidando su estatus como una de las principales figuras del pop.</p>\r\n\r\n<p>En 2016, Rihanna lanzó su octavo álbum de estudio, \"Anti\", que fue aclamado por la crítica y mostró una dirección más experimental y artística. Con sencillos como \"Work\", \"Needed Me\" y \"Love on the Brain\", \"Anti\" fue elogiado por su cohesión y su exploración de sonidos y temáticas más profundas. El álbum consolidó aún más su reputación como una innovadora musical capaz de desafiar las expectativas y mantenerse relevante en la industria.</p>\r\n\r\n<p>Además de su carrera musical, Rihanna ha demostrado ser una exitosa empresaria. En 2017, lanzó Fenty Beauty, una línea de cosméticos que recibió elogios por su amplia gama de tonos de piel y su enfoque inclusivo. Fenty Beauty se convirtió rápidamente en un éxito comercial y ha sido una fuerza impulsora en la industria de la belleza. También ha lanzado su propia línea de moda, Fenty, en colaboración con LVMH, y Savage X Fenty, una línea de lencería que ha sido celebrada por su inclusividad y su enfoque en la diversidad corporal.</p>\r\n\r\n<p>Rihanna también ha incursionado en la actuación, apareciendo en películas como \"Battleship\" (2012), \"Valerian and the City of a Thousand Planets\" (2017) y \"Ocean\'s 8\" (2018). Su carisma y presencia en pantalla han demostrado que es una artista versátil capaz de trascender la música para hacer su marca en otras áreas del entretenimiento.</p>\r\n\r\n<p>Más allá de su éxito profesional, Rihanna es conocida por su filantropía y su activismo. Fundó la Clara Lionel Foundation en 2012, una organización benéfica que apoya programas de educación y respuesta a emergencias en todo el mundo. Ha sido una defensora vocal de diversas causas sociales, incluyendo los derechos de las mujeres y la comunidad LGBTQ+, y ha utilizado su plataforma para generar conciencia sobre importantes cuestiones globales.</p>\r\n\r\n<p>En resumen, Rihanna es una artista multifacética cuya influencia se extiende mucho más allá de la música. Con su talento, su visión empresarial y su compromiso con el activismo, ha dejado una huella imborrable en la cultura popular contemporánea. Su capacidad para reinventarse y su dedicación a la innovación continúan inspirando a millones de personas en todo el mundo.</p>\r\n', 'rihanna');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `canciones`
--

CREATE TABLE `canciones` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `album_id` int(11) NOT NULL,
  `letra` mediumtext DEFAULT NULL,
  `ruta` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `canciones`
--

INSERT INTO `canciones` (`id`, `nombre`, `album_id`, `letra`, `ruta`) VALUES
(1, 'Satellite Blues', 1, 'She make the place a-jumpin\'\r\nThe way she move around\r\nShe like a rump and rollin\'\r\nThat\'s when she get it out\r\nAnd when she start a-rockin\'\r\nShe bring me to the boil\r\nShe like to give it out some\r\nNew satellite blues\r\nNew satellite blues\r\nNew satellite blues\r\nNew satellite blues\r\nA picture clear for watchin\'\r\nThe dish is runnin\' hot\r\nThe box is set for pumpin\'\r\nShe gonna take the lot\r\nThe way she get the butt in\r\nShe\'s gettin\' set to ball\r\nI like to chew it up some\r\nNew satellite blues\r\nNew satellite blues\r\nNew satellite blues\r\nNew satellite blues, yeah, yeah\r\nNew satellite blues\r\nNew satellite blues\r\nNew satellite blues\r\nNew satellite blues\r\nCan\'t get nothin\' on the dial\r\nThe frigin\' thing gone wild\r\nAll I get is the dumbed down news\r\nNew satellite blues\r\nNew satellite blues\r\nNew satellite blues\r\nNew satellite blues\r\nNew satellite blues\r\nI got new satellite blues\r\nNew satellite blues\r\nNew satellite blues\r\nNew satellite blues\r\nThis thing not allowed here\r\nI\'m gonna send it right back\r', '/storage/musica/acdc/stiff_upper_lip/satellite_blues.mp3'),
(2, 'Yo No Soy Celoso', 2, 'Ey, ey\r\nEl que esté libre de pecado que tire una piedra\r\nY yo tiro un peñón, yo tiro un peñón\r\nAnoche soñé contigo y me levanté gruñón\r\nBebiendo desde temprano, Dios me cuide el hígado y riñón, ey, ey, ey\r\nExtrañando toa\' la\' noche\' de caviar y mignon\r\nAhora eres de fuego como Olga Tañón, je\r\nY en el cora me dejaste el Gran Cañón\r\nTú y yo éramo\' lo\' Thunder y se rompió el equipo\r\nAyer te vieron dizque en Fifty-Eight con otro tipo\r\nYo también ando con una galla que con ella flipo\r\nY no, no\r\nYo no soy celoso, ¿pero quién e\'ese cabrón?\r\nDime quién e\'ese cabrón\r\nTranquila, no soy psycho\r\nNo vo\'a hacer un papelón, pero\r\nAuch, mi corazón\r\nYo no soy celoso, ¿pero quién e\'ese cabrón?\r\nDime quién e\'ese cabrón\r\nTranquila, no soy psycho\r\nNo vo\'a hacer un papelón, pero\r\nAuch, mi corazón, eh\r\nGuau, sé que soy un caripelao, encojonao por eso\r\nCuando con má\' de mil he estao, ¿a cuántas no le\' he dao?, eh\r\nPero tranquila, que yo mismo me tengo amenazao\r\nYo sé lo que tenía, lo que no sabía es qué se se', '/storage/musica/bad_bunny/un_verano_sin_ti/yo_no_soy_celoso.mp3'),
(3, 'Meltdown', 1, 'I look at my watch to find out the right time of the day\r\nI look at her libido hey hey hey\r\nI gotta get up and climb her, to roll her on the hay\r\nMakin\' a sweat, temperature rise all through the day\r\n\r\nMan it\'s getting hot hot hot\r\nI said man it\'s getting hot hot hot\r\nIt\'s getting hotter and hotter\r\nMan it\'s getting hot hot\r\nGetting hot around here\r\n\r\nIt\'s a meltdown\r\nIt\'s a meltdown\r\n\r\nI got a feelin\' in my bones\r\nI been rackin\' my brains out all night long\r\nStokin\' up the fire take it right up to the wire\r\nBurnin\' on and on\' burnin\' on\r\n\r\nMan it\'s getting hot hot hot\r\nI said man it\'s getting hot hot hot\r\nIt\'s getting hotter and hotter\r\nMan it\'s getting hot hot\r\nGetting hot around here\r\n\r\nIt\'s a meltdown\r\nIt\'s a meltdown\r\nIt\'s a meltdown\r\nIt\'s a meltdown\r\nMeltdown\r\n\r\nMan it\'s getting hot hot hot\r\nI said man it\'s getting hot hot hot\r\nIt\'s getting hotter and hotter\r\nAnd hotter and hotter\r\n\r\nIt\'s a meltdown, it\'s a meltdown\r\nIt\'s a meltdown, it\'s a meltdown\r\nIt\'s a meltdown, gonna burn, it\'s a meltdown\r\nI said burn down\r\nIt\'s a meltdown, meltdown, meltdown\r\nIt\'s a meltdown, it\'s a meltdown', '/storage/musica/acdc/Stiff Upper Lip/Meltdown.mp3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text NOT NULL,
  `ruta` varchar(100) NOT NULL,
  `descripcion_larga` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `descripcion`, `ruta`, `descripcion_larga`) VALUES
(1, 'Rap', 'El rap llegó en los ochenta para cambiarlo todo. Este estilo, enmarcado en la cultura del hip hop, surgió a finales de la década de 1970 en los barrios más marginales de Nueva York como una derivación del funk, y su aparición significó una verdadera revolución en el mundo de la música.', '/storage/categorias/rap.jpg', '<p>El rap es un género musical que se originó en los barrios afroamericanos y latinos de Nueva York a finales de los años 70. Surgió como una forma de expresión cultural entre los jóvenes que vivían en condiciones socioeconómicas difíciles y rápidamente se convirtió en un movimiento global. El rap se caracteriza por su ritmo fuerte y su enfoque en la lírica, donde los artistas, conocidos como raperos, hablan, o \"rapean\", sobre una variedad de temas que van desde sus experiencias personales hasta cuestiones sociales y políticas.</p>\r\n\r\n<p>El rap forma parte del movimiento cultural más amplio conocido como hip-hop, que también incluye el breakdancing, el graffiti y el DJing. Cada uno de estos elementos contribuye a la identidad y la comunidad del hip-hop. El DJing, por ejemplo, proporciona las bases musicales y los ritmos sobre los que los raperos construyen sus letras. Estas bases, llamadas \"beats\", son esenciales para el rap y son creadas a partir de una mezcla de sonidos, incluyendo muestras de otras canciones, ritmos programados y efectos sonoros.</p>\r\n\r\n<p>Una característica distintiva del rap es el uso del flow, que se refiere a la cadencia, el ritmo y la entonación con los que se entregan las rimas. Un buen flow puede hacer que una canción de rap sea pegajosa y memorable, y es a menudo lo que distingue a un gran rapero de uno promedio. Además, las letras del rap suelen ser poéticas y narrativas, usando juegos de palabras, metáforas y otros recursos literarios para transmitir mensajes poderosos y resonar con la audiencia.</p>\r\n\r\n<p>A lo largo de los años, el rap ha evolucionado y diversificado, dando lugar a subgéneros y estilos distintos. Desde el rap de la vieja escuela, que se centra en la fiesta y la diversión, hasta el gangsta rap, que explora la violencia y la vida en las calles, pasando por el conscious rap, que aborda temas sociales y políticos con una perspectiva reflexiva. Esta diversidad ha permitido que el rap atraiga a una audiencia amplia y variada, y que artistas de diferentes trasfondos culturales y geográficos puedan aportar sus propias experiencias y perspectivas al género.</p>\r\n\r\n<p>El impacto del rap en la cultura popular es innegable. Ha influido en la moda, el lenguaje y las actitudes de generaciones de jóvenes en todo el mundo. Artistas de rap han logrado un éxito comercial significativo, rompiendo barreras y estableciendo nuevos estándares en la industria de la música. Además, el rap ha sido una plataforma para la protesta y el cambio social, dando voz a comunidades y problemas que a menudo son ignorados por los medios de comunicación tradicionales.</p>\r\n\r\n<p>En resumen, el rap es un género musical dinámico y en constante evolución que ha dejado una marca indeleble en la cultura global. Con su enfoque en la lírica y su capacidad para contar historias de manera poderosa y auténtica, el rap continúa siendo una forma vital de expresión artística y social.</p>\r\n'),
(2, 'Rock', 'De forma tradicional, el Rock es un género reconocido por la predominancia de la guitarra eléctrica, los compases de 4/4 y una estructura verso-estribillo. Aunque dada su evolución, en la actualidad es complicado avistar unas características fehacientemente comunes. Sus temáticas apuntan a lo social', '/storage/categorias/rock.jpg', '<p>El rock es un género musical que surgió en los Estados Unidos en la década de 1950 y rápidamente se extendió por todo el mundo, convirtiéndose en uno de los estilos más influyentes y populares de la música contemporánea. Nacido de una amalgama de géneros como el rhythm and blues, el country y el gospel, el rock se caracteriza por el uso predominante de guitarras eléctricas, una sección rítmica de bajo y batería, y una estructura de canciones con versos y estribillos pegajosos.</p>\r\n\r\n<p>En sus primeros años, el rock and roll, como se le conocía entonces, se asoció con una actitud de rebeldía y juventud. Artistas pioneros como Elvis Presley, Chuck Berry y Little Richard marcaron el comienzo de una nueva era musical, capturando la atención de adolescentes y provocando a menudo la desaprobación de generaciones mayores debido a sus letras provocativas y sus enérgicas actuaciones en el escenario. Este espíritu rebelde y de desafío se mantendría como un rasgo distintivo del género a lo largo de las décadas.</p>\r\n\r\n<p>Durante los años 60 y 70, el rock experimentó una enorme evolución y diversificación. Bandas británicas como The Beatles y The Rolling Stones revolucionaron el género con sus innovaciones musicales y su enorme popularidad. Surgieron subgéneros como el rock psicodélico, que buscaba replicar la experiencia de los alucinógenos a través de sonidos experimentales y letras surrealistas, y el rock progresivo, que incorporaba complejas estructuras musicales y técnicas instrumentales avanzadas.</p>\r\n\r\n<p>En los años 70 y 80, el rock se diversificó aún más con el surgimiento del hard rock y el heavy metal, géneros que enfatizaban riffs de guitarra poderosos, voces agresivas y una actitud más dura y desafiante. Bandas como Led Zeppelin, AC/DC y Black Sabbath definieron este sonido, mientras que el punk rock, con bandas como The Ramones y The Sex Pistols, ofrecía una reacción cruda y minimalista contra el exceso percibido del rock progresivo y el rock de estadio.</p>\r\n\r\n<p>El rock también ha sido un vehículo para la expresión social y política. En los años 60, bandas como The Doors y artistas como Bob Dylan utilizaron su música para comentar sobre temas como la guerra de Vietnam, los derechos civiles y la justicia social. En las décadas siguientes, el rock continuó sirviendo como plataforma para la protesta y la crítica, abordando una amplia gama de cuestiones desde la desigualdad económica hasta la salud mental.</p>\r\n\r\n<p>En la era contemporánea, el rock sigue siendo un género vital, aunque ha visto una fusión con otros estilos musicales y ha dado lugar a nuevas formas híbridas. El grunge de los 90, liderado por bandas como Nirvana y Pearl Jam, revitalizó el género con su sonido crudo y emocional. Hoy en día, el rock continúa evolucionando, integrando elementos de la música electrónica, el hip-hop y otros géneros, y produciendo una nueva generación de artistas que llevan el legado del rock hacia el futuro.</p>\r\n\r\n<p>En resumen, el rock es un género musical que ha demostrado una capacidad única para adaptarse y transformarse a lo largo de las décadas, manteniendo siempre su esencia de energía, rebeldía y creatividad. Con sus profundas raíces históricas y su influencia continua en la cultura popular, el rock sigue siendo una fuerza poderosa en el mundo de la música.</p>\r\n'),
(3, 'Reggaeton', 'El reggaetón o reguetón es un género de música que combina el reggae con el rap y el hip hop. Surgió en América Central a finales de la década de 1980, pero tardó unos veinte años en popularizarse y llegar a otras regiones del mundo.', '/storage/categorias/reggaeton.jpg', '<p>El reggaetón es un género musical que tiene sus raíces en Puerto Rico durante la década de 1990, aunque sus influencias se remontan a la música de Jamaica y Panamá. Este género es una mezcla de reggae en español, hip-hop y música latina, y se caracteriza por su ritmo contagioso y sus letras pegajosas. El reggaetón se ha convertido en un fenómeno global, conquistando pistas de baile y listas de éxitos en todo el mundo.</p>\r\n\r\n<p>La base rítmica del reggaetón, conocida como \"dembow\", es un elemento distintivo que le da su ritmo inconfundible. Este ritmo proviene del reggae jamaiquino, específicamente de la canción \"Dem Bow\" de Shabba Ranks. A lo largo de los años, el reggaetón ha incorporado una amplia gama de influencias musicales, incluyendo el dancehall, la salsa y el merengue, creando un sonido dinámico y versátil que atrae a una amplia audiencia.</p>\r\n\r\n<p>Los primeros artistas del reggaetón, como Daddy Yankee, Don Omar y Tego Calderón, fueron pioneros en establecer el género a nivel internacional. Sus letras, a menudo centradas en temas de la vida urbana, el amor y la fiesta, resonaron con jóvenes de todo el mundo. Estos artistas no solo popularizaron el reggaetón, sino que también ayudaron a moldear la cultura del género, que incluye una moda distintiva y un estilo de vida asociado con la música.</p>\r\n\r\n<p>El reggaetón ha evolucionado significativamente desde sus inicios. En la década de 2000, el género comenzó a fusionarse con otros estilos de música, dando lugar a subgéneros como el reggaetón pop y el trap latino. Artistas como J Balvin, Bad Bunny y Karol G han llevado el reggaetón a nuevas alturas, colaborando con músicos de diferentes géneros y alcanzando un éxito comercial masivo. Estos artistas han llevado el reggaetón a un público más amplio, manteniendo al mismo tiempo las raíces y la esencia del género.</p>\r\n\r\n<p>Además de su éxito comercial, el reggaetón ha tenido un impacto cultural significativo. Ha influido en la moda, el baile y el lenguaje, con términos y frases del reggaetón incorporados en el vocabulario cotidiano de muchos jóvenes. El género también ha sido una plataforma para la expresión cultural y la representación de la identidad latina, celebrando sus raíces y dando voz a experiencias y narrativas a menudo marginadas en los medios convencionales.</p>\r\n\r\n<p>Sin embargo, el reggaetón no ha estado exento de controversias. Ha sido criticado por algunos debido a sus letras explícitas y su representación de la mujer. No obstante, muchos artistas de reggaetón han respondido a estas críticas, adaptando sus letras y promoviendo mensajes más positivos y empoderadores. Esta evolución refleja la capacidad del reggaetón para adaptarse y cambiar con el tiempo, manteniendo su relevancia y conexión con su audiencia.</p>\r\n\r\n<p>En resumen, el reggaetón es un género musical vibrante y en constante evolución que ha dejado una marca indeleble en la música y la cultura global. Con sus ritmos contagiosos y su capacidad para fusionar diferentes estilos, el reggaetón sigue siendo una fuerza dominante en la industria musical, reflejando y celebrando la diversidad y la creatividad de la cultura latina.</p>\r\n'),
(4, 'Pop', 'Dentro de los diferentes estilos musicales el pop es uno de los más comerciales y escuchados en todo el mundo. Debe su nombre a la abreviación “popular music” que, como bien nos indica en inglés, hace referencia a los sonidos, temas y melodías para el público de masas.', '/storage/categorias/pop.jpg', '<p>El pop es un género musical que se caracteriza por su amplia accesibilidad y atractivo comercial. Surgió a mediados del siglo XX y desde entonces ha dominado las listas de éxitos en todo el mundo. El término \"pop\" proviene de la palabra \"popular\", lo que refleja su objetivo de atraer a una audiencia masiva. La música pop se distingue por sus melodías pegajosas, estructuras de canciones sencillas y letras que suelen abordar temas universales como el amor, la alegría y las relaciones.</p>\r\n\r\n<p>Una de las características más notables del pop es su capacidad para incorporar elementos de otros géneros musicales. A lo largo de las décadas, el pop ha absorbido influencias del rock, el hip-hop, la música electrónica, el R&B, y más recientemente, el reggaetón y el K-pop. Esta flexibilidad ha permitido que el pop se mantenga relevante y en constante evolución, adaptándose a las tendencias cambiantes y a los gustos del público.</p>\r\n\r\n<p>Los años 60 marcaron un período de auge para la música pop con la llegada de bandas como The Beatles y The Beach Boys, quienes revolucionaron el género con sus armonías vocales y complejas producciones. En las décadas siguientes, artistas como Michael Jackson y Madonna llevaron el pop a nuevas alturas con sus innovadoras videoclips y actuaciones en vivo, estableciendo nuevos estándares para el entretenimiento y la producción musical.</p>\r\n\r\n<p>En los años 90 y 2000, el pop continuó dominando la industria musical con la aparición de estrellas del pop como Britney Spears, Christina Aguilera y Justin Timberlake. Estos artistas no solo lograron un éxito comercial masivo, sino que también se convirtieron en íconos culturales, influyendo en la moda, el baile y el estilo de vida de millones de fans en todo el mundo. Durante este período, la música pop también comenzó a fusionarse con otros géneros, dando lugar a subgéneros como el pop rock y el pop electrónico.</p>\r\n\r\n<p>El siglo XXI ha visto la expansión global del pop, con la incorporación de influencias internacionales y la aparición de nuevas estrellas globales. El K-pop, encabezado por grupos como BTS y BLACKPINK, ha llevado la música pop coreana a una audiencia mundial, mientras que artistas latinos como Shakira y Ricky Martin han integrado ritmos latinos en el pop, ampliando aún más su alcance y diversidad. Además, la música pop actual a menudo aborda temas más variados y profundos, reflejando cambios sociales y culturales.</p>\r\n\r\n<p>El pop también ha sido una plataforma para la innovación tecnológica en la música. La producción de música pop ha evolucionado con el uso de tecnologías avanzadas, incluyendo la auto-tune, los sintetizadores y las técnicas de producción digital. Los videoclips de alta calidad, las actuaciones en directo elaboradas y las estrategias de marketing en redes sociales han sido cruciales para el éxito de los artistas pop modernos, permitiéndoles conectar con sus audiencias de nuevas maneras.</p>\r\n\r\n<p>En resumen, la música pop es un género dinámico y adaptable que ha logrado mantener su relevancia a lo largo de las décadas. Con su capacidad para integrar diversas influencias y su enfoque en la creación de canciones accesibles y memorables, el pop continúa siendo una fuerza dominante en la industria musical y una parte integral de la cultura popular global.</p>\r\n'),
(5, 'EDM', 'La Electronic Dance Music (EDM), conocida en español como música electrónica de baile, es un género musical amplio que abarca varios subgéneros, todos caracterizados por su enfoque en ritmos electrónicos y producción digital. Surgió a finales del siglo XX y se popularizó en clubes nocturnos y festivales de música. Los DJ y productores utilizan equipos y software especializados para crear sonidos sintetizados y ritmos potentes diseñados para hacer que la gente baile.\r\n\r\nEntre los subgéneros más populares de la EDM se encuentran el house, techno, dubstep, trance y drum and bass. Cada uno tiene características distintivas, pero todos comparten un énfasis en los ritmos repetitivos y energéticos, efectos de sonido electrónicos y, a menudo, una estructura de \"build-up\" y \"drop\" para maximizar el impacto en la pista de baile.', '/storage/categorias/edm.jpg', '<p>La Electronic Dance Music (EDM), o música electrónica de baile, es un género musical que abarca una amplia variedad de estilos y subgéneros centrados en la creación de ritmos y sonidos mediante tecnología digital y equipos electrónicos. Surgida a finales de los años 70 y principios de los 80, la EDM ha evolucionado considerablemente, convirtiéndose en un fenómeno global presente en clubes nocturnos, festivales y listas de éxitos.</p>\r\n    \r\n    <h2>Características Principales</h2>\r\n    <ul>\r\n        <li>\r\n            <strong>Producción Electrónica:</strong> \r\n            <p>La música EDM se produce principalmente utilizando sintetizadores, cajas de ritmos, secuenciadores y software de producción musical. Estos instrumentos permiten a los productores crear sonidos únicos que no pueden lograrse con instrumentos acústicos tradicionales.</p>\r\n        </li>\r\n        <li>\r\n            <strong>Ritmo y Tempo:</strong> \r\n            <p>La mayoría de las pistas de EDM tienen un tempo rápido, generalmente entre 120 y 150 BPM (beats per minute), aunque algunos subgéneros pueden variar significativamente. El ritmo es una característica central, diseñado para ser hipnótico y mantener a los oyentes bailando.</p>\r\n        </li>\r\n        <li>\r\n            <strong>Estructura de las Canciones:</strong> \r\n            <p>Las canciones de EDM suelen tener una estructura específica, que incluye:</p>\r\n            <ul>\r\n                <li><strong>Intro:</strong> Comienza de manera suave para establecer el ambiente.</li>\r\n                <li><strong>Build-Up:</strong> Una acumulación gradual de energía y elementos musicales.</li>\r\n                <li><strong>Drop:</strong> El punto culminante de la canción, con un cambio drástico en el ritmo y la intensidad.</li>\r\n                <li><strong>Breakdown:</strong> Una sección más tranquila después del drop, que a menudo prepara el terreno para otro build-up.</li>\r\n                <li><strong>Outro:</strong> La conclusión de la pista, que puede ir disminuyendo en intensidad.</li>\r\n            </ul>\r\n        </li>\r\n        <li>\r\n            <strong>Subgéneros:</strong> \r\n            <p>La EDM incluye una variedad de subgéneros, cada uno con sus propias características distintivas:</p>\r\n            <ul>\r\n                <li><strong>House:</strong> Caracterizado por su ritmo constante de 4/4 y un tempo entre 120-130 BPM.</li>\r\n                <li><strong>Techno:</strong> Enfocado en ritmos repetitivos y minimalistas, con un tempo similar al house.</li>\r\n                <li><strong>Dubstep:</strong> Reconocido por sus bajos profundos y “wobble” bass, con tempos entre 140-150 BPM.</li>\r\n                <li><strong>Trance:</strong> Con melodías emotivas y buildups largos, generalmente entre 125-150 BPM.</li>\r\n                <li><strong>Drum and Bass:</strong> Tempos rápidos (160-180 BPM) y patrones de batería complejos.</li>\r\n            </ul>\r\n        </li>\r\n        <li>\r\n            <strong>Festivales y Eventos:</strong> \r\n            <p>La EDM es una parte integral de la cultura de festivales de música, con eventos masivos como Tomorrowland, Ultra Music Festival y Electric Daisy Carnival, que atraen a cientos de miles de asistentes de todo el mundo.</p>\r\n        </li>\r\n        <li>\r\n            <strong>Cultura del DJ:</strong> \r\n            <p>Los DJs son figuras centrales en la escena EDM, conocidos por mezclar y producir música en vivo, creando experiencias únicas para el público. Algunos de los DJs más conocidos han alcanzado estatus de celebridades, como David Guetta, Tiësto, Calvin Harris y Martin Garrix.</p>\r\n        </li>\r\n    </ul>\r\n\r\n    <h2>Evolución y Popularidad</h2>\r\n    <p>La EDM ha evolucionado desde sus raíces en el disco y el techno de Detroit y Chicago, pasando por la explosión del rave en Europa en los 90, hasta convertirse en un fenómeno global en el siglo XXI. Su popularidad se ha visto impulsada por la accesibilidad de la producción musical digital, las redes sociales y la globalización de la música a través de plataformas de streaming.</p>\r\n    \r\n    <p>En resumen, la EDM es un género dinámico y diverso, definido por su enfoque en la producción electrónica y su capacidad para crear experiencias energéticas y emocionantes para el público.</p>'),
(6, 'R&B', 'El Rhythm and Blues (R&B) es un género musical que se originó en la década de 1940 en Estados Unidos, combinando elementos del jazz, gospel y blues. Caracterizado por sus ritmos suaves, melodías emotivas y letras que abordan temas de amor y relaciones, el R&B ha evolucionado a lo largo de las décadas, incorporando influencias del funk, soul, hip-hop y pop. Artistas icónicos del género incluyen a Ray Charles, Aretha Franklin y más recientemente, a artistas como Beyoncé y Usher. El R&B es conocido por su capacidad para transmitir emociones profundas a través de una combinación de vocales poderosas y una producción musical refinada.', '/storage/categorias/r_and_b.jpg', '<p>El Rhythm and Blues (R&B) es un género musical que se originó en la década de 1940 en Estados Unidos. Inicialmente, el término se utilizaba para describir la música popular afroamericana que combinaba elementos del jazz, gospel y blues. A lo largo de los años, el R&B ha evolucionado y se ha diversificado, incorporando una amplia variedad de influencias y dando lugar a numerosos subgéneros.</p>\r\n    \r\n    <h2>Características Principales</h2>\r\n    <ul>\r\n        <li>\r\n            <strong>Ritmos Suaves:</strong> \r\n            <p>El R&B se caracteriza por sus ritmos suaves y cadenciosos, que a menudo incluyen patrones rítmicos complejos y sincopados. La batería y el bajo suelen jugar un papel central en la creación de estos ritmos.</p>\r\n        </li>\r\n        <li>\r\n            <strong>Melodías Emotivas:</strong> \r\n            <p>Las melodías en el R&B son a menudo melódicas y llenas de emoción, diseñadas para conectar profundamente con el oyente. Las líneas melódicas pueden ser simples o complejas, pero siempre están cargadas de sentimiento.</p>\r\n        </li>\r\n        <li>\r\n            <strong>Letras Temáticas:</strong> \r\n            <p>Las letras del R&B suelen abordar temas de amor, desamor, relaciones y experiencias personales. Las narrativas líricas son introspectivas y a menudo reflejan las luchas y triunfos emocionales de los artistas.</p>\r\n        </li>\r\n        <li>\r\n            <strong>Vocales Poderosas:</strong> \r\n            <p>El R&B es conocido por sus vocales poderosas y expresivas. Los cantantes de R&B a menudo utilizan técnicas vocales como el vibrato, melisma y el falsete para añadir emoción y profundidad a sus interpretaciones.</p>\r\n        </li>\r\n    </ul>\r\n\r\n    <h2>Evolución del R&B</h2>\r\n    <p>Desde sus orígenes, el R&B ha experimentado una significativa evolución. En las décadas de 1950 y 1960, el R&B se fusionó con otros estilos para dar origen al soul, con artistas icónicos como Ray Charles y Aretha Franklin. En las décadas siguientes, el R&B continuó evolucionando, incorporando elementos del funk, pop y hip-hop, lo que dio lugar a subgéneros como el contemporary R&B y el neo-soul.</p>\r\n\r\n    <h2>Influencias y Artistas Destacados</h2>\r\n    <p>El R&B ha influenciado y ha sido influenciado por numerosos géneros musicales. A lo largo de las décadas, muchos artistas han dejado una marca indeleble en el género. Algunos de los artistas más destacados incluyen a Marvin Gaye, Stevie Wonder, Whitney Houston, Beyoncé y Usher. Estos artistas han contribuido a la popularización del R&B a nivel mundial y han establecido estándares altos en términos de calidad vocal y producción musical.</p>\r\n\r\n    <h2>Producción Musical en el R&B</h2>\r\n    <p>La producción musical en el R&B es refinada y detallada, con un enfoque en la calidad del sonido y la complejidad de los arreglos. Se utilizan una variedad de instrumentos, tanto tradicionales como electrónicos, para crear paisajes sonoros ricos y envolventes. La tecnología de producción moderna ha permitido a los productores de R&B experimentar con nuevos sonidos y técnicas, manteniendo el género fresco y relevante.</p>\r\n\r\n    <h2>Impacto Cultural</h2>\r\n    <p>El R&B ha tenido un impacto significativo en la cultura popular, no solo en la música, sino también en la moda, el cine y la televisión. Las temáticas abordadas en las canciones de R&B a menudo reflejan las experiencias y realidades de las comunidades afroamericanas, convirtiéndolo en un género que no solo entretiene, sino que también educa y empodera.</p>\r\n\r\n    <p>En resumen, el R&B es un género musical dinámico y emotivo, conocido por sus ritmos suaves, melodías emotivas y letras introspectivas. A lo largo de las décadas, ha evolucionado y se ha diversificado, manteniéndose como una fuerza poderosa en la música popular.</p>'),
(7, 'Country', 'El género musical country se originó en el sur de Estados Unidos en la década de 1920. Se caracteriza por su instrumentación tradicional, que incluye la guitarra acústica, el banjo, el violín y el pedal steel, y por sus letras narrativas que abordan temas de la vida rural, el amor y las luchas personales. A lo largo de los años, el country ha evolucionado incorporando influencias del rock, pop y hip-hop, manteniéndose como un pilar de la música popular. Artistas destacados incluyen a Johnny Cash, Dolly Parton y Taylor Swift.', '/storage/categorias/country.jpg', '<p>El género musical country se originó en la década de 1920 en el sur de Estados Unidos. Se desarrolló a partir de las tradiciones musicales de los inmigrantes europeos, particularmente las canciones folk y las baladas de los británicos, irlandeses y escoceses. El country también incorporó influencias del blues, el gospel y otras formas de música popular afroamericana, creando un sonido distintivo y fácilmente reconocible.</p>\r\n    \r\n    <h2>Características Principales</h2>\r\n    <ul>\r\n        <li>\r\n            <strong>Instrumentación Tradicional:</strong> \r\n            <p>El country utiliza una instrumentación específica que incluye la guitarra acústica, el banjo, el violín (fiddle), el contrabajo y el pedal steel. Estos instrumentos crean un sonido cálido y orgánico que es característico del género.</p>\r\n        </li>\r\n        <li>\r\n            <strong>Letras Narrativas:</strong> \r\n            <p>Las letras en la música country suelen contar historias sobre la vida rural, el amor, el desamor, la familia, y las luchas personales. Las canciones a menudo son narrativas y reflejan experiencias personales y emocionales.</p>\r\n        </li>\r\n        <li>\r\n            <strong>Vocales Auténticas:</strong> \r\n            <p>Los cantantes de country suelen tener voces claras y auténticas, con una pronunciación distintiva que refleja las raíces sureñas del género. El estilo vocal es directo y sincero, con un enfoque en la claridad y la expresión emocional.</p>\r\n        </li>\r\n    </ul>\r\n    \r\n    <h2>Evolución del Country</h2>\r\n    <p>Desde sus orígenes, el country ha evolucionado significativamente. En las décadas de 1940 y 1950, el género incorporó influencias del swing y el jazz, dando lugar al western swing y al honky-tonk. En los años 60 y 70, el country se fusionó con el rock, creando el country rock y el outlaw country. En los años 80 y 90, el género se popularizó aún más con el country pop y el neotradicionalismo. Hoy en día, el country continúa evolucionando, incorporando influencias del pop, el rock y el hip-hop.</p>\r\n    \r\n    <h2>Influencias y Artistas Destacados</h2>\r\n    <p>El country ha influenciado y ha sido influenciado por otros géneros musicales, como el rock, el pop y el blues. Algunos de los artistas más destacados del género incluyen a Hank Williams, Patsy Cline, Johnny Cash, Dolly Parton, Willie Nelson, Garth Brooks y más recientemente, a artistas como Taylor Swift, Chris Stapleton y Kacey Musgraves. Estos artistas han contribuido a la evolución y popularización del country a nivel mundial.</p>\r\n    \r\n    <h2>Producción Musical en el Country</h2>\r\n    <p>La producción en el country puede variar desde arreglos simples y acústicos hasta producciones más elaboradas con múltiples capas de instrumentos. Los estudios de grabación en Nashville, Tennessee, a menudo denominados \"Music Row\", son conocidos por su influencia en la producción de música country. La calidad vocal y la claridad de la narrativa son elementos cruciales en la producción de música country.</p>\r\n    \r\n    <h2>Impacto Cultural</h2>\r\n    <p>El country ha tenido un impacto significativo en la cultura popular estadounidense, reflejando y moldeando las realidades de la vida rural. Las temáticas abordadas en las canciones de country a menudo reflejan los valores y las experiencias de la clase trabajadora y las comunidades rurales. Además, ha influido en la moda, el cine y la televisión, y continúa siendo una parte integral de la identidad cultural de muchas comunidades en Estados Unidos.</p>\r\n    \r\n    <p>En resumen, el country es un género musical rico en tradición y narrativa, conocido por su instrumentación distintiva y letras emotivas. A lo largo de los años, ha evolucionado y se ha diversificado, manteniéndose como un pilar de la música popular y reflejando las experiencias y valores de la vida rural estadounidense.</p>'),
(8, 'Latin', 'La música latina es un género musical diverso originario de América Latina y España. Caracterizado por sus ritmos vibrantes, melodías contagiosas y una mezcla de influencias culturales, incluyendo elementos indígenas, africanos y europeos. Los géneros latinos como la salsa, el merengue, la bachata y el reguetón han ganado popularidad a nivel mundial y han influido en la música pop global. Artistas destacados incluyen a Celia Cruz, Tito Puente, Shakira y J Balvin.', '/storage/categorias/latin.jpg', '<p>El género musical country se originó en el sur de Estados Unidos en la década de 1920. Se caracteriza por su instrumentación tradicional, que incluye la guitarra acústica, el banjo, el violín y el pedal steel, y por sus letras narrativas que abordan temas de la vida rural, el amor y las luchas personales. A lo largo de los años, el country ha evolucionado incorporando influencias del rock, pop y hip-hop, manteniéndose como un pilar de la música popular. Artistas destacados incluyen a Johnny Cash, Dolly Parton y Taylor Swift.</p>\r\n</body>\r\n</html>\r\n\r\n\r\n\r\ndescribe el género musical latin brevemente\r\nChatGPT\r\nhtml\r\nCopiar código\r\n<!DOCTYPE html>\r\n<html lang=\"es\">\r\n<head>\r\n    <meta charset=\"UTF-8\">\r\n    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n    <title>Descripción Breve del Género Latin</title>\r\n</head>\r\n<body>\r\n    <h1>Latin</h1>\r\n    <p>La música latina es un género musical diverso originario de América Latina y España. Caracterizado por sus ritmos vibrantes, melodías contagiosas y una mezcla de influencias culturales, incluyendo elementos indígenas, africanos y europeos. Los géneros latinos como la salsa, el merengue, la bachata y el reguetón han ganado popularidad a nivel mundial y han influido en la música pop global. Artistas destacados incluyen a Celia Cruz, Tito Puente, Shakira y J Balvin.</p>\r\n</body>\r\n</html>\r\ndescribe de forma más detallada el género musical Latin\r\nChatGPT\r\nhtml\r\nCopiar código\r\n<!DOCTYPE html>\r\n<html lang=\"es\">\r\n<head>\r\n    <meta charset=\"UTF-8\">\r\n    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n    <title>Descripción Detallada del Género Latin</title>\r\n</head>\r\n<body>\r\n    <h1>Latin</h1>\r\n    <p>La música latina es un género musical amplio y diverso que tiene sus raíces en América Latina y España. Este género abarca una variedad de estilos y ritmos, incluyendo la salsa, el merengue, la bachata, el reguetón, la cumbia, entre otros.</p>\r\n    \r\n    <h2>Características Principales</h2>\r\n    <ul>\r\n        <li>\r\n            <strong>Ritmos y Percusión:</strong> \r\n            <p>La música latina se caracteriza por sus ritmos vibrantes y contagiosos, impulsados por una rica variedad de percusión que incluye instrumentos como congas, bongos, timbales y maracas. Estos ritmos animados invitan al baile y a la celebración.</p>\r\n        </li>\r\n        <li>\r\n            <strong>Influencias Culturales:</strong> \r\n            <p>Los géneros latinos reflejan una mezcla de influencias culturales, incluyendo elementos indígenas, africanos y europeos. Esta fusión de culturas da como resultado una música diversa y única, con una amplia variedad de estilos y sonidos.</p>\r\n        </li>\r\n        <li>\r\n            <strong>Vocales y Melodías:</strong> \r\n            <p>Las melodías en la música latina son a menudo pegajosas y emotivas, con letras que abordan una amplia gama de temas, desde el amor y la celebración hasta la lucha y la resistencia. Los cantantes suelen utilizar técnicas vocales apasionadas para transmitir la emoción de la música.</p>\r\n        </li>\r\n    </ul>\r\n    \r\n    <h2>Evolución de la Música Latina</h2>\r\n    <p>La música latina ha evolucionado a lo largo de los siglos, desde sus raíces en las tradiciones indígenas y africanas hasta convertirse en una parte integral de la música popular global. En las últimas décadas, géneros como el reguetón y la música urbana latina han ganado una inmensa popularidad a nivel mundial, llevando la música latina a nuevos públicos y estableciendo su lugar en la escena musical internacional.</p>\r\n    \r\n    <h2>Influencias y Artistas Destacados</h2>\r\n    <p>La música latina ha influido en muchos otros géneros musicales y ha sido influenciada por ellos. Artistas destacados en la música latina incluyen a Celia Cruz, Tito Puente, Juan Luis Guerra, Shakira, J Balvin, y muchos más. Estos artistas han dejado una marca indeleble en el género y han ayudado a popularizar la música latina en todo el mundo.</p>\r\n    \r\n    <h2>Producción Musical en la Música Latina</h2>\r\n    <p>La producción musical en la música latina varía según el subgénero, pero generalmente incluye una combinación de instrumentos tradicionales y modernos. La percusión juega un papel central en muchos géneros latinos, y las producciones suelen ser ricas en ritmo y energía.</p>\r\n    \r\n    <h2>Impacto Cultural</h2>\r\n    <p>La música latina ha tenido un impacto cultural significativo en todo el mundo, promoviendo el baile, la celebración y la expresión cultural. Ha influido en la moda, el cine y la televisión, y ha sido una forma de identidad y orgullo para las comunidades latinas en todo el mundo. La música latina continúa evolucionando y creciendo en popularidad, reflejando su importancia cultural y musical en la escena global.</p>\r\n    \r\n    <p>En resumen, la música latina es un género musical diverso y vibrante, conocido por sus ritmos contagiosos, melodías emocionantes y letras apasionadas. Su evolución a lo largo de los años ha creado una rica y variada tradición musical que sigue siendo una fuerza poderosa en la música popular global.</p>'),
(9, 'K-Pop', 'El K-pop, abreviatura de \"pop coreano\", es un género musical originario de Corea del Sur que ha ganado una inmensa popularidad a nivel global en las últimas décadas. Caracterizado por su producción visual altamente estilizada, coreografías elaboradas y una variedad de estilos musicales que incluyen pop, hip-hop, R&B y música electrónica, el K-pop ha alcanzado un estatus de fenómeno cultural mundial. Artistas y grupos como BTS, Blackpink y EXO son algunas de las figuras más prominentes del género.', '/storage/categorias/kpop.jpg', '<p>El K-pop, o pop coreano, es un género musical originario de Corea del Sur que ha ganado una inmensa popularidad a nivel global en las últimas décadas. Caracterizado por su producción visual altamente estilizada, coreografías elaboradas y una variedad de estilos musicales, el K-pop es mucho más que solo música: es un fenómeno cultural que abarca la música, el baile, la moda y el entretenimiento en general.</p>\r\n    \r\n    <h2>Características Principales</h2>\r\n    <ul>\r\n        <li>\r\n            <strong>Producción Visual:</strong> \r\n            <p>El K-pop es conocido por sus videos musicales visualmente impresionantes, que suelen incluir coreografías elaboradas, escenarios llamativos y una estética de moda cuidadosamente diseñada. Estos videos son una parte integral de la experiencia del K-pop y contribuyen a su atractivo global.</p>\r\n        </li>\r\n        <li>\r\n            <strong>Coreografías Elaboradas:</strong> \r\n            <p>Las actuaciones de K-pop suelen incluir coreografías precisas y energéticas, que son una parte central de la identidad del género. Los grupos de K-pop pasan meses entrenando para perfeccionar estas actuaciones, y el resultado son presentaciones altamente sincronizadas y emocionantes.</p>\r\n        </li>\r\n        <li>\r\n            <strong>Estilo Musical Versátil:</strong> \r\n            <p>El K-pop incorpora una amplia gama de influencias musicales, incluyendo pop, hip-hop, R&B, música electrónica y más. Esta diversidad de estilos musicales permite que el K-pop tenga un atractivo amplio y atraiga a una variedad de audiencias en todo el mundo.</p>\r\n        </li>\r\n    </ul>\r\n    \r\n    <h2>Evolución del K-pop</h2>\r\n    <p>El K-pop comenzó a ganar tracción en los años 90, pero fue en los años 2000 y 2010 cuando realmente explotó a nivel internacional. Grupos como BTS, EXO y Blackpink han llevado el K-pop a nuevas alturas, alcanzando el éxito en mercados globales y encabezando listas de éxitos en todo el mundo. Además, el K-pop ha evolucionado constantemente, adaptándose a las tendencias musicales y culturales cambiantes y manteniéndose relevante en la escena musical internacional.</p>\r\n    \r\n    <h2>Influencias y Artistas Destacados</h2>\r\n    <p>El K-pop ha sido influenciado por una variedad de géneros musicales globales, incluyendo pop occidental, hip-hop y música electrónica. Algunos de los artistas más destacados del K-pop incluyen a BTS, Blackpink, EXO, TWICE, Red Velvet y más. Estos artistas han ganado una base de fans dedicada en todo el mundo y han contribuido a la creciente popularidad del K-pop fuera de Corea del Sur.</p>\r\n    \r\n    <h2>Producción Musical en el K-pop</h2>\r\n    <p>La producción musical en el K-pop es altamente profesional y sofisticada, con un enfoque en la perfección técnica y la innovación sonora. Las canciones suelen ser producidas por equipos internacionales de compositores y productores, lo que contribuye a su atractivo global y su sonido distintivo.</p>\r\n    \r\n    <h2>Impacto Cultural</h2>\r\n    <p>El K-pop ha tenido un impacto cultural significativo en todo el mundo, no solo en la música, sino también en la moda, la televisión, el cine y la cultura en general. Ha creado una base de fans dedicada en todo el mundo y ha ayudado a promover la cultura coreana a nivel global. Además, el K-pop ha sido una fuerza de unidad y conexión para las personas de diferentes culturas y países, que comparten su amor por la música y la cultura del K-pop.</p>\r\n    \r\n    <p>En resumen, el K-pop es un género musical dinámico y multifacético que ha ganado popularidad a nivel mundial gracias a su producción visual impresionante, coreografías elaboradas y estilo musical versátil. Su impacto cultural sigue creciendo, consolidando su lugar en la industria musical internacional.</p>'),
(10, 'Jazz', 'El jazz es un género musical que se originó a principios del siglo XX en las comunidades afroamericanas de Estados Unidos. Se caracteriza por su énfasis en la improvisación, la síncopa y las complejas progresiones armónicas. Influenciado por el blues, el ragtime y la música clásica, el jazz ha evolucionado en una multitud de subgéneros y estilos que abarcan desde el Dixieland y el swing hasta el bebop y el jazz fusion.', '/storage/categorias/jazz.jpg', '<p>El jazz es un género musical que se originó a principios del siglo XX en las comunidades afroamericanas de Estados Unidos, particularmente en Nueva Orleans. Es una forma de expresión artística que se caracteriza por su énfasis en la improvisación, la síncopa y las complejas progresiones armónicas.</p>\r\n    \r\n    <h2>Características Principales</h2>\r\n    <ul>\r\n        <li>\r\n            <strong>Improvisación:</strong> \r\n            <p>La improvisación es una parte fundamental del jazz, donde los músicos crean y desarrollan la música sobre la marcha. Esto permite una expresión individual única y una interacción creativa entre los músicos durante la interpretación.</p>\r\n        </li>\r\n        <li>\r\n            <strong>Síncopa y Ritmo:</strong> \r\n            <p>El jazz emplea ritmos sincopados y complejos, que le dan una sensación de fluidez y movimiento. La síncopa es una característica distintiva del jazz y contribuye a su distintivo \"swing\".</p>\r\n        </li>\r\n        <li>\r\n            <strong>Progresiones Armónicas:</strong> \r\n            <p>El jazz utiliza progresiones armónicas complejas y a menudo inusuales, que permiten una mayor libertad creativa para los músicos. Esto proporciona una rica paleta sonora y la posibilidad de explorar nuevas direcciones musicales.</p>\r\n        </li>\r\n    </ul>\r\n    \r\n    <h2>Evolución del Jazz</h2>\r\n    <p>Desde sus inicios en Nueva Orleans, el jazz ha evolucionado a lo largo de varias décadas y ha dado lugar a una multitud de subgéneros y estilos. Algunos de los estilos más conocidos incluyen el Dixieland, el swing, el bebop, el cool jazz, el jazz modal y el jazz fusion. Cada estilo ha traído nuevas innovaciones y enfoques al género, enriqueciendo su legado y su diversidad.</p>\r\n    \r\n    <h2>Influencias y Artistas Destacados</h2>\r\n    <p>El jazz ha influido en muchos otros géneros musicales y ha sido influenciado por ellos. Algunos de los artistas más destacados del jazz incluyen a Louis Armstrong, Duke Ellington, Charlie Parker, Miles Davis y John Coltrane. Estos músicos han dejado una marca indeleble en el género y han ayudado a definir su evolución.</p>\r\n    \r\n    <h2>Producción Musical en el Jazz</h2>\r\n    <p>La producción musical en el jazz puede variar desde grabaciones en vivo que capturan la espontaneidad de la improvisación hasta álbumes de estudio con arreglos cuidadosamente orquestados. La calidad del sonido y la interacción entre los músicos son elementos clave en las producciones de jazz.</p>\r\n    \r\n    <h2>Impacto Cultural</h2>\r\n    <p>El jazz ha tenido un impacto profundo en la cultura global, influyendo en la música, la danza, la moda y el arte en general. Ha sido una forma de expresión artística para las comunidades afroamericanas y ha jugado un papel crucial en los movimientos de derechos civiles y la integración cultural.</p>\r\n    \r\n    <p>En resumen, el jazz es un género musical rico y dinámico, conocido por su énfasis en la improvisación, la síncopa y las complejas progresiones armónicas. Su evolución a lo largo del tiempo ha generado una variedad de estilos y ha dejado una marca indeleble en la música y la cultura global.</p>');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios_canciones`
--

CREATE TABLE `comentarios_canciones` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_cancion` int(11) NOT NULL,
  `comentario` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `comentarios_canciones`
--

INSERT INTO `comentarios_canciones` (`id`, `id_usuario`, `id_cancion`, `comentario`) VALUES
(1, 1, 1, 'Satellite Blues es mi canción favorita de AC/DC, esto tiene que tener un 20/10, por favor desarrolladores subid a 20 el límite máximo del voto'),
(21, 1, 3, 'Prueba de comentario'),
(22, 1, 3, 'Prueba de comentario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `likes_comentarios`
--

CREATE TABLE `likes_comentarios` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_comentario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `likes_comentarios`
--

INSERT INTO `likes_comentarios` (`id`, `id_usuario`, `id_comentario`) VALUES
(26, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `old_canciones`
--

CREATE TABLE `old_canciones` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `artista` varchar(100) NOT NULL,
  `categoria` varchar(20) NOT NULL,
  `epoca` int(11) NOT NULL,
  `votos` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `old_canciones`
--

INSERT INTO `old_canciones` (`id`, `titulo`, `artista`, `categoria`, `epoca`, `votos`) VALUES
(1, 'Stairway to Heaven', 'Led Zeppelin', 'Rock', 1971, 0),
(2, 'Bohemian Rhapsody', 'Queen', 'Rock', 1975, 0),
(3, 'Hotel California', 'Eagles', 'Rock', 1976, 0),
(4, 'Imagine', 'John Lennon', 'Rock', 1971, 0),
(5, 'Smells Like A Teen Spirit', 'Nirvana', 'Rock', 2006, 0),
(6, 'Rapper\'s Delight', 'Sugarhill Gang', 'Rap', 1979, 0),
(7, 'Nuthin\' But a \'G\' Thang', 'Snoop Dogg', 'Rap', 1992, 0),
(8, 'Juicy', 'The Notorious B.I.G', 'Rap', 1994, 0),
(9, 'Lose Yourself', 'Eminem', 'Rap', 2008, 0),
(10, 'Hotline Bling', 'Drake', 'Rap', 2015, 0),
(11, 'Gasolina', 'Daddy Yankee', 'Reggaeton', 2004, 0),
(12, 'Despacito', 'Luis Fonsi', 'Reggaeton', 2017, 0),
(13, 'Danza Kuduro', 'Don Omar', 'Reggaeton', 2010, 0),
(14, 'Hasta Abajo', 'Don Omar', 'Reggaeton', 2010, 0),
(15, 'Shaky Shaky', 'Daddy Yankee', 'Reggaeton', 2016, 0),
(16, 'Billie Jean', 'Michael Jakson', 'Pop', 1982, 0),
(17, 'Like a Prayer', 'Madonna', 'Pop', 1989, 0),
(18, 'Someone Like You', 'Adele', 'Pop', 2011, 0),
(19, 'Shape of You', 'Ed Sheeran', 'Pop', 2017, 0),
(20, 'Bad Guy', 'Billie Eilish', 'Pop', 2019, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puntuaciones`
--

CREATE TABLE `puntuaciones` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `cancion_id` int(11) NOT NULL,
  `puntuacion` int(11) NOT NULL DEFAULT 0
) ;

--
-- Volcado de datos para la tabla `puntuaciones`
--

INSERT INTO `puntuaciones` (`id`, `usuario_id`, `cancion_id`, `puntuacion`) VALUES
(1, 2, 1, 9),
(2, 3, 2, 4),
(3, 3, 1, 6),
(4, 1, 1, 10),
(21, 1, 3, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombreUsuario` varchar(50) NOT NULL,
  `contrasena` varchar(20) NOT NULL,
  `ruta` varchar(100) DEFAULT '/storage/imagenes_perfil/predeterminado.png',
  `correo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombreUsuario`, `contrasena`, `ruta`, `correo`) VALUES
(1, 'Admin', 'adminadmin', '/storage/imagenes_perfil/admin.png', 'admin@admin.com'),
(2, 'UsuarioRock', 'rockrock', '/storage/imagenes_perfil/usuario_rock.jpg', 'rock@rock.com'),
(3, 'UsuarioRap', 'rapraprap', '/storage/imagenes_perfil/usuario_rap.jpg', 'rap@rap.com'),
(4, 'UsuarioPop', 'pop', '/storage/imagenes_perfil/usuario_pop.jpg', 'pop@pop.com'),
(5, 'UsuarioReggaeton', 'reggaeton', '/storage/imagenes_perfil/usuario_reggaeton.jpg', 'reggaeton@reggaeton.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `albumes`
--
ALTER TABLE `albumes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre_artista_id_uq` (`artista_id`,`nombre`);

--
-- Indices de la tabla `artistas`
--
ALTER TABLE `artistas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Indices de la tabla `canciones`
--
ALTER TABLE `canciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `album_id` (`album_id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `comentarios_canciones`
--
ALTER TABLE `comentarios_canciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario_fk` (`id_usuario`),
  ADD KEY `id_cancion_fk` (`id_cancion`);

--
-- Indices de la tabla `likes_comentarios`
--
ALTER TABLE `likes_comentarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_usuario_id_comentario_uq` (`id_usuario`,`id_comentario`);

--
-- Indices de la tabla `old_canciones`
--
ALTER TABLE `old_canciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `puntuaciones`
--
ALTER TABLE `puntuaciones`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `puntuacion_uk` (`usuario_id`,`cancion_id`),
  ADD KEY `cancion_id` (`cancion_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre_uq` (`nombreUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `albumes`
--
ALTER TABLE `albumes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `artistas`
--
ALTER TABLE `artistas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `canciones`
--
ALTER TABLE `canciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `comentarios_canciones`
--
ALTER TABLE `comentarios_canciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `likes_comentarios`
--
ALTER TABLE `likes_comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `old_canciones`
--
ALTER TABLE `old_canciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `puntuaciones`
--
ALTER TABLE `puntuaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `artistas`
--
ALTER TABLE `artistas`
  ADD CONSTRAINT `artistas_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);

--
-- Filtros para la tabla `canciones`
--
ALTER TABLE `canciones`
  ADD CONSTRAINT `canciones_ibfk_1` FOREIGN KEY (`album_id`) REFERENCES `albumes` (`id`);

--
-- Filtros para la tabla `comentarios_canciones`
--
ALTER TABLE `comentarios_canciones`
  ADD CONSTRAINT `id_cancion_fk` FOREIGN KEY (`id_cancion`) REFERENCES `canciones` (`id`),
  ADD CONSTRAINT `id_usuario_fk` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `puntuaciones`
--
ALTER TABLE `puntuaciones`
  ADD CONSTRAINT `puntuaciones_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `puntuaciones_ibfk_2` FOREIGN KEY (`cancion_id`) REFERENCES `canciones` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

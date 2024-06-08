-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-05-2024 a las 20:33:18
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
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `albumes`
--

INSERT INTO `albumes` (`id`, `artista_id`, `nombre`) VALUES
(1, 1, 'Stiff Upper Lip');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `artistas`
--

CREATE TABLE `artistas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `descripcion` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `artistas`
--

INSERT INTO `artistas` (`id`, `nombre`, `categoria_id`, `descripcion`) VALUES
(1, 'AC/DC', 2, 'AC/DC es una banda de hard rock británica-australiana, formada en 1973 en Australia por los hermanos escoceses Malcolm Young y Angus Young y Dave Evans como vocalista. Sus álbumes se han vendido en un total estimado de 200 millones de copias, embarcándose en giras multitudinarias por todo el mundo y'),
(2, '50 Cent', 1, 'Curtis James Jackson (Queens, Nueva York, 6 de julio de 1975), más conocido por su nombre artístico 50 Cent, es un rapero, compositor y actor estadounidense. Alcanzó la fama mundial con el lanzamiento de sus álbumes Get Rich or Die Tryin’ (2003) y The Massacre (2005), ambos de ellos logrando éxito m'),
(3, 'Bad Bunny', 3, 'Benito Antonio Martínez Ocasio (Vega Baja, Puerto Rico; 10 de marzo de 1994), conocido artísticamente como Bad Bunny, es un cantante, compositor, productor discográfico y luchador puertorriqueño. Caracterizado por su entonación grave, sus estilos musicales son generalmente definidos como reguetón y '),
(4, 'Rihanna', 4, 'Robyn Rihanna Fenty (Parroquia de Saint Michael, Barbados; 20 de febrero de 1988), conocida simplemente como Rihanna, es una cantante, actriz, diseñadora y empresaria barbadense. Nacida en Saint Michael y criada en Bridgetown, Barbados, Rihanna hizo una audición para el productor de discos estadouni');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `canciones`
--

CREATE TABLE `canciones` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `album_id` int(11) NOT NULL,
  `letra` varchar(1000) DEFAULT NULL,
  `ruta` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `canciones`
--

INSERT INTO `canciones` (`id`, `nombre`, `album_id`, `letra`, `ruta`) VALUES
(1, 'Satellite Blues', 1, 'She make the place a-jumpin\'\r\nThe way she move around\r\nShe like a rump and rollin\'\r\nThat\'s when she get it out\r\nAnd when she start a-rockin\'\r\nShe bring me to the boil\r\nShe like to give it out some\r\nNew satellite blues\r\nNew satellite blues\r\nNew satellite blues\r\nNew satellite blues\r\nA picture clear for watchin\'\r\nThe dish is runnin\' hot\r\nThe box is set for pumpin\'\r\nShe gonna take the lot\r\nThe way she get the butt in\r\nShe\'s gettin\' set to ball\r\nI like to chew it up some\r\nNew satellite blues\r\nNew satellite blues\r\nNew satellite blues\r\nNew satellite blues, yeah, yeah\r\nNew satellite blues\r\nNew satellite blues\r\nNew satellite blues\r\nNew satellite blues\r\nCan\'t get nothin\' on the dial\r\nThe frigin\' thing gone wild\r\nAll I get is the dumbed down news\r\nNew satellite blues\r\nNew satellite blues\r\nNew satellite blues\r\nNew satellite blues\r\nNew satellite blues\r\nI got new satellite blues\r\nNew satellite blues\r\nNew satellite blues\r\nNew satellite blues\r\nThis thing not allowed here\r\nI\'m gonna send it right back\r', '/storage/musica/acdc/Stiff Upper Lip');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Rap', 'El rap llegó en los ochenta para cambiarlo todo. Este estilo, enmarcado en la cultura del hip hop, surgió a finales de la década de 1970 en los barrios más marginales de Nueva York como una derivación del funk, y su aparición significó una verdadera revolución en el mundo de la música.'),
(2, 'Rock', 'De forma tradicional, el Rock es un género reconocido por la predominancia de la guitarra eléctrica, los compases de 4/4 y una estructura verso-estribillo. Aunque dada su evolución, en la actualidad es complicado avistar unas características fehacientemente comunes. Sus temáticas apuntan a lo social'),
(3, 'Reggaeton', 'El reggaetón o reguetón es un género de música que combina el reggae con el rap y el hip hop. Surgió en América Central a finales de la década de 1980, pero tardó unos veinte años en popularizarse y llegar a otras regiones del mundo.'),
(4, 'Pop', 'Dentro de los diferentes estilos musicales el pop es uno de los más comerciales y escuchados en todo el mundo. Debe su nombre a la abreviación “popular music” que, como bien nos indica en inglés, hace referencia a los sonidos, temas y melodías para el público de masas.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_cancion` int(11) NOT NULL,
  `comentario` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombreUsuario` varchar(50) NOT NULL,
  `contrasena` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombreUsuario`, `contrasena`) VALUES
(1, 'Admin', 'admin'),
(2, 'UsuarioRock', 'rock'),
(3, 'UsuarioRap', 'rap'),
(4, 'UsuarioPop', 'pop'),
(5, 'UsuarioReggaeton', 'reggaeton');

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
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `old_canciones`
--
ALTER TABLE `old_canciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `albumes`
--
ALTER TABLE `albumes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `artistas`
--
ALTER TABLE `artistas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `canciones`
--
ALTER TABLE `canciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `old_canciones`
--
ALTER TABLE `old_canciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

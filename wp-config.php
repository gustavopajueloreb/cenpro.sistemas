<?php
/** 
 * Configuración básica de WordPress.
 *
 * Este archivo contiene las siguientes configuraciones: ajustes de MySQL, prefijo de tablas,
 * claves secretas, idioma de WordPress y ABSPATH. Para obtener más información,
 * visita la página del Codex{@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} . Los ajustes de MySQL te los proporcionará tu proveedor de alojamiento web.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** Ajustes de MySQL. Solicita estos datos a tu proveedor de alojamiento web. ** //
/** El nombre de tu base de datos de WordPress */
define('DB_NAME', 'cenpro.sistemas');

/** Tu nombre de usuario de MySQL */
define('DB_USER', 'root');

/** Tu contraseña de MySQL */
define('DB_PASSWORD', '');

/** Host de MySQL (es muy probable que no necesites cambiarlo) */
define('DB_HOST', 'localhost');

/** Codificación de caracteres para la base de datos. */
define('DB_CHARSET', 'utf8mb4');

/** Cotejamiento de la base de datos. No lo modifiques si tienes dudas. */
define('DB_COLLATE', '');

/**#@+
 * Claves únicas de autentificación.
 *
 * Define cada clave secreta con una frase aleatoria distinta.
 * Puedes generarlas usando el {@link https://api.wordpress.org/secret-key/1.1/salt/ servicio de claves secretas de WordPress}
 * Puedes cambiar las claves en cualquier momento para invalidar todas las cookies existentes. Esto forzará a todos los usuarios a volver a hacer login.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', 'GbnY>bQS^;?!A^p/bKvhz@5^s:<!RgA&M-^|PN$<uKk;sd0iFDor17mRhG[Cqdj4');
define('SECURE_AUTH_KEY', '(lQnkgK&Kx%Kz$b B$0GfC=|iF>ojt(hAcJAdEuByh=b6Du8fW0hwpcVE7G@!j#H');
define('LOGGED_IN_KEY', '`;)zV#4b6c.y(f{C5h4oy=V~DKi:M~>IbfN<Kg2BEyP&sA4d?E=fa`k%awH1NI[G');
define('NONCE_KEY', 'JZx$S &M>kosxO5KJ4@n<<Yr Q_?`:}0m<$v&)P?*HK-p01T)>6KhdbX>oDgUEd+');
define('AUTH_SALT', 'zL,q,pZAD8<c!xs:YH[r0!=(B}9g!^xVPZ-ocu5u.~n#&^}Q}yh>0ZNHdT|i@-l)');
define('SECURE_AUTH_SALT', 'Y~b?uHzM=hSkM@dE~XZAvrdd7Q{aCI+|+vYybX~QeN{R3v:w>e9`918MSGpqzF0<');
define('LOGGED_IN_SALT', 'vQn8sBI$mQ/T`A~+GF >Cn7`!%;vq@(9:4i_6l^@7>B||CC45a4G~ReRfw.11jf~');
define('NONCE_SALT', '?+==)u,qn{Tb2/tGKQ3qP`+OJmT|F;.jc85Wb?>wh= ]cE+@_y;~,unhS7hgSrnW');

/**#@-*/

/**
 * Prefijo de la base de datos de WordPress.
 *
 * Cambia el prefijo si deseas instalar multiples blogs en una sola base de datos.
 * Emplea solo números, letras y guión bajo.
 */
$table_prefix  = 'wpc1s_';


/**
 * Para desarrolladores: modo debug de WordPress.
 *
 * Cambia esto a true para activar la muestra de avisos durante el desarrollo.
 * Se recomienda encarecidamente a los desarrolladores de temas y plugins que usen WP_DEBUG
 * en sus entornos de desarrollo.
 */
define('WP_DEBUG', false);

/* ¡Eso es todo, deja de editar! Feliz blogging */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');


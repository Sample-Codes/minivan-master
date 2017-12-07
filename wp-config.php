<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clés secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C’est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'minibus-facile');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'root');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', '');

/** Adresse de l’hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8mb4');

/** Type de collation de la base de données.
  * N’y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'y_K[5JT)i&&~dd)4~mb2c(r.L9gTY-C+b:x}ktrwmWSydt^I:t lw]^t~N k.v{*');
define('SECURE_AUTH_KEY',  '^fF0{u]gLg}4jYBp6I#=c-6*5uUG(g?+{^U{sTbtg,+`g::Sx`EI#8gM(`aF|2H$');
define('LOGGED_IN_KEY',    'AW3eI*<-1BC.?%w9J*4<UNEI&Zp;urkfTXkQj^j; )U5A>`wk,8s^3+H$;f2fJ<i');
define('NONCE_KEY',        'yluGc6ewI$[h7}Fx8mUoX7b~?.p3>Z1FUrOgv1PBoM-)oU#S`_#u(bMV&9e(%@?I');
define('AUTH_SALT',        '/m!RC`~3vV&Zj5e>$`G~` /&]&DI,:y#}(/u8*jx6yGf<YeXwGY={%4_jRtp-oQv');
define('SECURE_AUTH_SALT', 'Ew!ZH|c2ty~.=~6dc%z]0eXgUf49/Vo52De< /Lrk1d4cfX~!<[@=hstfunFJa*i');
define('LOGGED_IN_SALT',   't9**_K#)YYu(xA0`L5tyy?:w_]Hgu&mNc5pCj`xUNJ`0:J8?sqmI!_O!pb?o 4w;');
define('NONCE_SALT',       '3zA%W@bH3sHzCxp5lwpg YhU~/HTj>Txs#tvx|Xxvw)g02#NBgEIz4Uf:Li`)P3p');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix  = 'wp_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* C’est tout, ne touchez pas à ce qui suit ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');
<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clés secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link https://fr.wordpress.org/support/article/editing-wp-config-php/ Modifier
 * wp-config.php}. C’est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @link https://fr.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define( 'DB_NAME', 'sitePhotos' );

/** Utilisateur de la base de données MySQL. */
define( 'DB_USER', 'root' );

/** Mot de passe de la base de données MySQL. */
define( 'DB_PASSWORD', '' );

/** Adresse de l’hébergement MySQL. */
define( 'DB_HOST', 'localhost' );

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Type de collation de la base de données.
  * N’y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clés secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'h2as4>5gxqy%!<fJ}gepNE!G/dZ?F`-Z@`HDL`gKogi7.L_~n4%^f,:5rs1/dldy' );
define( 'SECURE_AUTH_KEY',  '[[0YX{Rn5ertsDa`M}|&K/F/`Yy2F3-D#7tJrA;pjb5![ZL~nrEfPBr4;$Muxl9D' );
define( 'LOGGED_IN_KEY',    '+ YoJQsQ|@.G$Co>?6bQSHv)tm[S%aX1lDv`l~eP]g:3|E&XOSEv? $K9C?F4]KH' );
define( 'NONCE_KEY',        ' i|.88oYlb+.gp#b3{2S7/FL>t{cEU`Q3=wV3iDxwB}9+},}qm)r$2]EhE#JwWJ3' );
define( 'AUTH_SALT',        'f%9 (.cB*s;#`yhH6ycDYU%iARe.q?$V:]CV^>llyi$M(:w|3`^APNCvbkUn!+}E' );
define( 'SECURE_AUTH_SALT', 'QR<q)7#LD~E(bClnY<2*+ogvm`TIiuM($QR<#EJjt/w9CwYa_fMo[$[KY=i1EUK3' );
define( 'LOGGED_IN_SALT',   'm.kPAijl{IC/}2Nj+CD,mEi6ekZw9_r*Vw6#6!wTBncUvtlf C+6<~?3G|ew9w t' );
define( 'NONCE_SALT',       'CW+`+?F>9E:DxT=#vaBk_Nnp1%gpe-J^!?0~IwGpbd<rdM8Jr.Lz:VTbUO(vY~<9' );
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix = 'wp_';

/**
 * Pour les développeurs et développeuses : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortement recommandé que les développeurs et développeuses d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur la documentation.
 *
 * @link https://fr.wordpress.org/support/article/debugging-in-wordpress/
 */
define('WP_DEBUG', false);

/* C’est tout, ne touchez pas à ce qui suit ! Bonne publication. */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');

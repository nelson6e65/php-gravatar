<?php
/**
 * PHP: Gravatar Library file
 *
 * Content:
 * - Global functions definition.
 *
 * Copyright © 2015 Nelson Martell (http://nelson6e65.github.io)
 *
 * Licensed under The MIT License (MIT)
 * For full copyright and license information, please see the LICENSE
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright 2015 Nelson Martell
 * @link      http://nelson6e65.github.io/php_nml/
 * @since     v0.1.0
 * @license   http://www.opensource.org/licenses/mit-license.php The MIT License (MIT)
 * */

use NelsonMartell\Extensions\String;

/**
 * Busca un mensaje único traducido en el dominio 'NM_GRAVATAR_GETTEXT_DOMAIN'.
 * El mensaje puede contener cadenas de formato.
 *
 * @param string      $message Mensaje con formato que se va a buscar.
 * @param array|mixed $args    Un objeto, una lista de objetos o múltiples
 *   argumentos que se van a incluir en las cadenas de formato del mensaje.
 *
 * @return string
 * @see    dgettext
 * */
function nm_gravatar_msg($message, $args = null)
{
    $translated = dgettext(NM_GRAVATAR_GETTEXT_DOMAIN, $message);

    if (func_num_args() > 2) {
        $args = array_slice(func_get_args(), 1);
    }

    return String::format($translated, $args);
}


/**
 * Busca un mensaje único, en singular y plural, traducido en el dominio 'nml'.
 * El mensaje puede contener cadenas de formato.
 *
 * @param string      $singular Mensaje con formato que se va a buscar cuando $n
 *   es uno (1).
 * @param string      $plural   Mensaje con formato que se va a buscar cuando $n
 *   es distinto a (1).
 * @param integer     $n        Cantidad
 * @param array|mixed $args     Un objeto, una lista de objetos o múltiples
 *   argumentos que se van a incluir en las cadenas de formato del mensaje.
 *
 * @return string
 * @see    dngettext
 * */
function nm_gravatar_nmsg($singular, $plural, $n, $args = null)
{
    $translated = dngettext(NM_GRAVATAR_GETTEXT_DOMAIN, $singular, $plural, $n);

    if (func_num_args() > 4) {
        $args = array_slice(func_get_args(), 3);
    }

    return String::format($translated, $args);
}

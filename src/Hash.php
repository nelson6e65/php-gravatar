<?php
/**
 * PHP: Gravatar Library file
 *
 * Content:
 * - Class definition:  [NelsonMartell\Gravatar] Hash
 *
 * Copyright © 2015 Nelson Martell (http://nelson6e65.github.io)
 *
 * Licensed under The MIT License (MIT)
 * For full copyright and license information, please see the LICENSE
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright 2015 Nelson Martell
 * @link      http://nelson6e65.github.io/php-gravatar/
 * @since     v0.1.0
 * @license   http://www.opensource.org/licenses/mit-license.php The MIT License (MIT)
 * */

namespace NelsonMartell\Gravatar;

use \InvalidArgumentException;

class Hash
{
    public function __construct($email)
    {
        $this->setEmail($email);
    }

    private $email;

    /**
     * Gets the Gravatar e-mail.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Sets the Gravatar e-amil.
     *
     * @param string $email
     */
    private function setEmail($email)
    {
        if (!is_string($email)) {
            throw new InvalidArgumentException(
                _('Invalid e-mail. The $email argument must to be an string.')
            );
        }

        $this->email = strtolower(trim($email));
    }

    private $hash = null;

    /**
     * Comvert this instance to string explicitly .
     *
     * @param string $format Output format, using placeholder. Default: `{hash}`.
     * @param array  $data   Extra data for the output string.
     *                       You can NOT override this placeholders: `{email}` and `{hash}`.
     *
     * @todo   Implement the format features.
     * @return string
     */
    public function toString($format = '{hash}', array $data = null)
    {
        static $default = '{hash}';

        if (!$format || !is_string($format)) {
            $format = $default;
        }

        if ($this->hash === null) {
            $this->hash = md5($this->email);
        }

        $data['hash'] = $this->hash;


        return $this->hash;
    }

    public function __toString()
    {
        return $this->toString();
    }

    /**
     * Gets the hash string for the email provided.
     *
     * @param string $email  E-mail.
     * @param string $format Output format.
     * @param array  $data   Extra data for output.
     *
     * @return string Hash MD5 for the email provided.
     */
    public static function get($email, $format = null, array $data = null)
    {
        $hash = new Hash($email);

        return $hash->toString($format, $data);
    }
}

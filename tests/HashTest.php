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

namespace NelsonMartell\Gravatar\Test;

use NelsonMartell\Gravatar\Hash;
use \PHPUnit_Framework_TestCase as TestCase;
use \InvalidArgumentException;

/**
 *
 * @coversDefaultClass \NelsonMartell\Gravatar\Hash
 */
class HashTest extends TestCase
{

    /**
     * Tests the constructor with valid emails.
     *
     *
     * @covers ::__construct
     * @covers ::setEmail
     *
     * @dataProvider validEmailsProvider
     *
     * @return array With Hash object and original email.
     */
    public function testConstructorWithValidEmails($email)
    {
        $hash = new Hash($email);
        $this->assertTrue(true);
        //
        //
        // $data = [$hash, $email];
        //
        // $this->assertTrue(is_array($data));
        //

        // return $hash;
    }

    /**
     * Tests the constructor with non valid emails.
     *
     * @covers ::__construct
     * @covers ::setEmail
     *
     * @dataProvider      invalidEmailsProvider
     * @expectedException InvalidArgumentException
     *
     * @return array With Hash object and original $email.
     */
    public function testConstructorWithInvalidEmails($email)
    {
        $hash = new Hash($email);
    }

    /**
     * Tests Email property.
     *
     * @covers ::getEmail
     * @covers ::setEmail
     * @covers ::__construct
     *
     * @depends      testConstructorWithValidEmails
     * @dataProvider validEmailsProvider
     */
    public function testEmailPropertyIsValid($email)
    {
        $hash = new Hash($email);
        $expected = strtolower(trim($email));
        $actual = $hash->getEmail();
        $this->assertTrue(is_string($actual));
        $this->assertEquals($expected, $actual);
    }



    /**
     * Tests explicit casting to string, getting hashes.
     *
     * @covers ::__construct
     * @covers ::toString
     * @covers ::getEmail
     * @covers ::setEmail
     *
     * @depends testConstructorWithValidEmails
     * @dataProvider validHashesProvider
     * @return string
     */
    public function testToString($email, $hash)
    {
        $obj = new Hash($email);
        $expected = $hash;
        $actual = $obj->toString();

        $this->assertTrue(is_string($actual), '"toString" method must return an string.');

        $this->assertEquals($expected, $actual);


        $actualCustomized = $obj->toString(null);
        $this->assertEquals($actual, $actualCustomized);

        $actualCustomized = $obj->toString(null, null);
        $this->assertEquals($actual, $actualCustomized);

        return $actual;
    }

    /**
     * Tests explicit casting to string, getting hashes.
     *
     *
     * @covers ::__construct
     * @covers ::setEmail
     * @covers ::toString
     *
     * @depends testToString
     * @dataProvider validHashesProvider
     *
     * @return string
     */
    public function testToStringCustomized($email, $hash)
    {
        // TODO: Implement formating and remove this line:
        $this->markTestIncomplete(
            'This test is for a feature still in development, and has not been implemented yet.'
        );


        $formats = [
            [
                'format' => '{hash}.php',
                'data'   => null,
                'expected' => $hash.'.php'
            ],
            [
                'format' => '{hash}.json',
                'data'   => ['hash' => 'Not allowed hash placeholder replacement'],
                'expected' => $hash.'.json'
            ],
            [
                'format' => '{email} ({hash})',
                'data'   => [
                    'hash' => 'Not allowed hash placeholder replacement',
                    'email' => 'And not allowed email replacement.'
                ],
                'expected' => $email.' ('.$hash.')'
            ],
            [
                'format' => '{hash} -> {img}',
                'data'   => [
                    'img' => 'Image',
                ],
                'expected' => $hash.' -> Image'
            ],
        ];

        $obj = new Hash($email);


        foreach ($formats as $args) {
            $expected = $args['expected'];
            $actual = $obj->toString($args['format'], $args['data']);

            $this->assertEquals($expected, $actual);
        }


    }


    /**
     * Tests the implicit cast to string, that should be the hash.
     *
     * @covers ::__construct
     * @covers ::__toString
     * @covers ::toString
     * @covers ::getEmail
     * @covers ::setEmail
     *
     * @depends testToString
     * @dataProvider validHashesProvider
     *
     * @return
     */
    public function testImplicitCastToString($email, $hash)
    {
        $obj = new Hash($email);
        $actual = $obj->__toString();
        $this->assertEquals($hash, $actual);

        $actual = (string) $obj;
        $this->assertEquals($hash, $actual);

        $actual = $obj.'';
        $this->assertEquals($hash, $actual);
    }



    /**
     * Provides valid emails.
     *
     * @return array
     */
    public function validEmailsProvider()
    {
        $data = [
            ['Nelson6e65-dev@yahoo.es'],
            ['Nelson6eEduardo65@gmail.com'],
            [' nelson6e65-github@yahoo.es    '],
        ];

        return $data;
    }

    /**
     * Provides invalid emails.
     *
     * @return array
     */
    public function invalidEmailsProvider()
    {
        $data = [
            [null],
            [0],
            [array()],
            // ['nelson6e65- dev@yahoo.es'],
        ];

        return $data;
    }



    /**
     * Provides valid hashes for some emails.
     *
     * @return array
     */
    public function validHashesProvider()
    {
        static $data = [
            // [{email}, {hash}]
            ['nelson6e65-dev@yahoo.es', '3ce7e14fb12e6542cfd11ec91bf18434'],
            ['nelson6eeduardo65@gmail.com', 'c63996b719b7c10c1d9664bef9aa8fe7'],
            ['nelson6e65-github@yahoo.es', 'fae2f119bd6b18f5982d15aeec25d674'],
        ];

        return $data;
    }
}

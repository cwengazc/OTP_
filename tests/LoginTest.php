<?php

require 'vendor/autoload.php';

use otp\Login;
use otp\Database;

use PHPUnit\Framework\TestCase;

class LoginTest extends TestCase
{
      /**
      * @covers otp\Database
      * @covers otp\Login
    */
    public function testAuthenticateWithValidCredentials()
    {
        // Create a mock database object
        $databaseMock = $this->getMockBuilder(Database::class)
            ->getMock();

        // Set up the mock to return true for valid credentials
        $databaseMock->expects($this->once())
            ->method('isValidCredentials')
            ->willReturn(true);

        $login = new Login('admin', 'password', $databaseMock);
        $result = $login->authenticate();

        $this->assertTrue($result);
    }

      /**
     * @covers otp\Database
     * @covers otp\Login
    */

    public function testAuthenticateWithInvalidCredentials()
    {
        // Create a mock database object
        $databaseMock = $this->getMockBuilder(Database::class)
            ->getMock();

        // Set up the mock to return false for invalid credentials
        $databaseMock->expects($this->once())
            ->method('isValidCredentials')
            ->willReturn(false);

        $login = new Login('john', '123456', $databaseMock);
        $result = $login->authenticate();

        $this->assertFalse($result);
    }
}

<?php
use otp\UpdateDatabase;
use otp\UpdatePassword;
use PHPUnit\Framework\TestCase;

class UpdatePasswordTest extends TestCase
{

       /**
         * @covers otp\UpdateDatabase
         * @covers otp\UpdatePassword
         */
    public function testUpdatePasswordSuccess()
    {

     
        // Create a mock database object
        $updateDatabaseMock = $this->getMockBuilder(UpdateDatabase::class)
            ->getMock();

        // Set up the mock to return true for successful password update
        $updateDatabaseMock->expects($this->once())
            ->method('updatePassword')
            ->willReturn(true);

        $updatePassword = new UpdatePassword($updateDatabaseMock);
        $result = $updatePassword->changePassword('admin', 'newpassword');

        $this->assertTrue($result);
    }
    
       /**
         * @covers otp\UpdateDatabase
         * @covers otp\UpdatePassword
         */
    public function testUpdatePasswordFailure()
    {
        // Create a mock database object
        $updateDatabaseMock = $this->getMockBuilder(UpdateDatabase::class)
            ->getMock();

        // Set up the mock to return false for failed password update
        $updateDatabaseMock->expects($this->once())
            ->method('updatePassword')
            ->willReturn(false);

        $updatePassword = new UpdatePassword($updateDatabaseMock);
        $result = $updatePassword->changePassword('admin', 'newpassword');

        $this->assertFalse($result);
    }
}

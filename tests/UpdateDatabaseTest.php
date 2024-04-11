<?php
use otp\UpdateDatabase;
use otp\UpdatePassword;
use PHPUnit\Framework\TestCase;

class UpdateDatabaseTest extends TestCase
{

       /**
         * @covers otp\UpdateDatabase
         * @covers otp\UpdatePassword
         */
        public function testUpdatePasswordWithValidUsername()
        {
            $updateDatabase = new UpdateDatabase();
    
            // Call the updatePassword method with a valid username
            $result = $updateDatabase->updatePassword('admin', 'newpassword');
    
            // Assert that the update was successful
            $this->assertTrue($result);
        }
    
    
       /**
         * @covers otp\UpdateDatabase
         * @covers otp\UpdatePassword
         */

    public function testUpdatePasswordWithInvalidUsername()
    {
        $updateDatabase = new UpdateDatabase();

        // Call the updatePassword method with an invalid username
        $result = $updateDatabase->updatePassword('user', 'newpassword');

        // Assert that the update failed
        $this->assertFalse($result);
    }
   
}

<?php
namespace otp;

// signup mock testing 

class Signup
{
    public function register($name, $email, $password, $confirmPassword)
    {
        if (empty($name) || empty($email) || empty($password) || empty($confirmPassword)) {
            return false;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        if ($password !== $confirmPassword) {
            return false;
        }
        // if not false then we have successful registration
        return true;
    }

  
}

class Login
{
    private $username;
    private $password;
    private $database;

    public function __construct($username, $password, Database $database)
    {
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
    }

    public function authenticate()
    {
        // Use the database object to authenticate the user
        return $this->database->isValidCredentials($this->username, $this->password);
    }
}

class Database
{
    public function isValidCredentials($username, $password)
    {
        // Replace this with your actual database logic
        if ($username === 'admin' && $password === 'password') {
            return true;
        }

        return false;
    }
}

class UpdatePassword
{
    private $updateDatabase;

    public function __construct(UpdateDatabase $updateDatabase)
    {
        $this->updateDatabase = $updateDatabase;
    }

    public function changePassword($username, $newPassword)
    {
        // Call the updatePassword method of the updateDatabase object
        return $this->updateDatabase->updatePassword($username, $newPassword);
    }
}

class UpdateDatabase
{
    public function updatePassword($username, $newPassword)
    {
        // Simulate a successful password update if the username is 'admin'
        if ($username === 'admin') {
            return true;
        }

        return false;
    }
}



// game history function 

// retrieves necessary game information from mock database for tests

class GameHistory
{
    private $gameDatabase;


    // database constructor
    public function __construct(GameDatabase $gameDatabase)
    {
        $this->gameDatabase = $gameDatabase;
    }

    public function retrieveGameHistory()
    {
        // Call the getGameHistory method of the game database object
        return $this->gameDatabase->getGameHistory();
    }
}


// Game Database 
class GameDatabase
{
    public function getGameHistory()
    {
    
        // Simulate retrieving game history data from the database
        return [
            [
                'id' => 1,
                'player_id' => 1,
                'opponent_id' => 2,
                'result' => 'win',
                'played_at' => '2023-06-01 19:30:00'
            ],
            [
                'id' => 2,
                'player_id' => 1,
                'opponent_id' => 3,
                'result' => 'loss',
                'played_at' => '2023-06-02 14:45:00'
            ],
            [
                'id' => 3,
                'player_id' => 2,
                'opponent_id' => 3,
                'result' => 'win',
                'played_at' => '2023-06-02 16:15:00'
            ],
        ];
    }
}


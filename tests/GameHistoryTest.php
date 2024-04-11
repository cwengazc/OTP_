<?php


use otp\GameDatabase;
use otp\GameHistory;
use PHPUnit\Framework\TestCase;


class GameHistoryTest extends TestCase
{


  /**
     * @covers otp\GameDatabase
     * @covers otp\GameHistory
     */
    public function testRetrieveGameHistory()
    {
        // Create a mock game database object
        $gameDatabaseMock = $this->getMockBuilder(GameDatabase::class)
            ->getMock();

        // Set up the mock to return the game history data
        $gameHistoryData = [
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

        // Set up the mock object to return the game history data
        $gameDatabaseMock->expects($this->once())
            ->method('getGameHistory')
            ->willReturn($gameHistoryData);

        // Create an instance of the GameHistory class with the mock game database
        $gameHistory = new GameHistory($gameDatabaseMock);

        // Call the retrieveGameHistory method to get the game history
        $result = $gameHistory->retrieveGameHistory();

        // Define the expected result
        $expectedResult = [
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

        // Assert that the retrieved game history matches the expected result
        $this->assertEquals($expectedResult, $result);
    }


  /**
     * @covers otp\GameDatabase
     * @covers otp\GameHistory
     */
    public function testRetrieveGameHistoryWithEmptyData()
    {
        // Create a mock game database object
        $gameDatabaseMock = $this->getMockBuilder(GameDatabase::class)
            ->getMock();

        // Set up the mock to return empty game history data
        $gameDatabaseMock->expects($this->once())
            ->method('getGameHistory')
            ->willReturn([]);

        // Create an instance of the GameHistory class with the mock game database
        $gameHistory = new GameHistory($gameDatabaseMock);

        // Call the retrieveGameHistory method to get the game history
        $result = $gameHistory->retrieveGameHistory();

        // Assert that the retrieved game history is an empty array
        $this->assertEmpty($result);
    }

    /**
     * @covers otp\GameDatabase
     * @covers otp\GameHistory
     */
    public function testGetGameHistory()
    {
        $gameDatabase = new GameDatabase();

        // Call the getGameHistory method
        $result = $gameDatabase->getGameHistory();

        // Define the expected result
        $expectedResult = [
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

        // Assert that the retrieved game history matches the expected result
        $this->assertEquals($expectedResult, $result);
    }
}
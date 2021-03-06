<?php

namespace unreal4u\TelegramAPI\tests\Telegram\Methods;

use PHPUnit_Framework_TestCase as TestCase;
#use PHPUnit\Framework\TestCase;
use unreal4u\TelegramAPI\tests\Mock\MockTgLog;
use unreal4u\TelegramAPI\Telegram\Methods\SendLocation;

class SendLocationTest extends TestCase
{
    /**
     * @var MockTgLog
     */
    private $tgLog;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->tgLog = new MockTgLog('TEST-TEST');
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->tgLog = null;
        parent::tearDown();
    }

    public function testSendLocation()
    {
        $sendLocation = new SendLocation();
        $sendLocation->chat_id = 12341234;
        $sendLocation->latitude = 43.296482;
        $sendLocation->longitude = 5.369763;

        $result = $this->tgLog->performApiRequest($sendLocation);
        $this->assertInstanceOf('unreal4u\\TelegramAPI\\Telegram\\Types\\Message', $result);

        $this->assertEquals(13, $result->message_id);
        $this->assertInstanceOf('unreal4u\\TelegramAPI\\Telegram\\Types\\User', $result->from);
        $this->assertInstanceOf('unreal4u\\TelegramAPI\\Telegram\\Types\\Chat', $result->chat);
        $this->assertEquals(123456789, $result->from->id);
        $this->assertEquals('unreal4uBot', $result->from->username);
        $this->assertEquals($sendLocation->chat_id, $result->chat->id);
        $this->assertEquals('unreal4u', $result->chat->username);

        $this->assertEquals(1452209867, $result->date);
        $this->assertNull($result->audio);

        $this->assertInstanceOf('unreal4u\\TelegramAPI\\Telegram\\Types\\Location', $result->location);
        // We have to round because what we send isn't necessarily what we get
        $this->assertEquals(round($sendLocation->latitude, 6), round($result->location->latitude, 6));
        $this->assertEquals(round($sendLocation->longitude, 6), round($result->location->longitude, 6));
    }
}

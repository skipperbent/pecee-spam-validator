<?php

class SpamTest extends PHPUnit_Framework_TestCase  {

    protected $service;
    protected $spamMessage = 'Eow, check this cool website 01-soittoaanet.com';
    protected $message = 'This is not a spam message. Seriously!';

    public function __construct() {
        $this->service = new \Pecee\Service\SpamValidator();
        $this->service->setPathToSpamList(__DIR__ . DIRECTORY_SEPARATOR . 'spamlist.txt');
        parent::__construct();
    }

    public function testSpamMessage() {

        return $this->assertTrue($this->service->isSpam($this->spamMessage));

    }

    public function testMessage() {
        return $this->assertFalse($this->service->isSpam($this->message));
    }

}
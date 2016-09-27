<?php
namespace Pecee\Service;

class SpamValidator {

    const SERVICE_URI = 'http://master.moinmo.in/BadContent?action=raw';

    protected $text;
    protected $list;
    protected $pathToSpamlist;

    public function downloadList() {

        $contextOptions = [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
            ],
        ];

        $this->list = file_get_contents(static::SERVICE_URI, false, stream_context_create($contextOptions));
    }

    protected function getList() {

        if($this->pathToSpamlist === null) {
            $this->downloadList();
        } else {
            if($this->list === null) {
                $this->list = file_get_contents($this->pathToSpamlist, FILE_USE_INCLUDE_PATH);

                if($this->list === null) {
                    throw new \ErrorException('Spamlist file doesn\'t exist');
                }
            }
        }
    }

    public function isSpam($text = null) {

        $this->text = $text;

        if($this->text === null || empty($this->text)) {
            return false;
        }

        if($this->list === null) {
            $this->getList();
        }

        $this->list = explode(chr(10), $this->list);

        if(count($this->list)) {
            $ignoreTags = array('#');
            foreach($this->list as $regex) {
                $regex = trim($regex);
                if(!in_array(substr($regex, 0, 1), $ignoreTags) && !empty($regex) && strlen($regex) > 3) {
                    if(preg_match('/'.preg_quote(str_replace('\\', '', $regex), '/').'/is', $this->text)) {
                        return true;
                    }
                }
            }
        }
        return false;
    }

    public function setPathToSpamList($path) {
        $this->pathToSpamlist = $path;
    }

    public function setList($spamList) {
        $this->list = $spamList;
    }

    public function setText($text) {
        $this->text = $text;
    }

    public function getText() {
        return $this->text;
    }

}
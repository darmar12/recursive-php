<?php
class File {
    public $file;
    public $currentTime;

    public function __construct($file, $currentTime) {
        $this->file = $file;
        $this->currentTime = $currentTime;
    }

    public function checkUpdate() {
        clearstatcache(false, $this->file);
        $nowTime = filemtime($this->file);
        if ($nowTime != $this->currentTime) {
            $this->currentTime = $nowTime;
            echo "File was modified \n";
        }
    }
}
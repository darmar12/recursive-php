<?php
class File {
    public $file;
    public $arrCurrentTimes;

    public function __construct($file, $arrCurrentTimes = []) {
        $this->file = $file;
        $this->arrCurrentTimes = $arrCurrentTimes;
        $this->readPath($this->file, $this->arrCurrentTimes);
    }

    // public function checkUpdate() {
    //     clearstatcache(false, $this->file);
    //     $nowTime = filemtime($this->file);
    //     if ($nowTime != $this->arrCurrentTime) {
    //         $this->arrCurrentTime = $nowTime;
    //         echo "File was modified \n";
    //     }
    // }

    public function checkUpdate() {
        $arrNewTimes = [];
        $this->readPath($this->file, $arrNewTimes);
        foreach($this->arrCurrentTimes as $file => $time) {
            if(!isset($arrNewTimes[$file])) {
                echo $file." was deleted";
            } else if ($arrNewTimes[$file] !== $time) {
                echo $file." was update";
            }
        }

        foreach($arrNewTimes as $file => $time) {
            if(!isset($this->arrCurrentTimes[$file])) {
                echo $file." was added";
            }
        }

        $this->arrCurrentTimes = $arrNewTimes;
    }

    public function readPath($path = $this->file, &$arrFiles) {
        $arrFiles[$path] = filemtime($path);
        if(is_dir($path)) {
            $files = scandir($path);
            foreach($files as $file) {
                if ($file === '.' || $file === '..')
                    continue;
                $newPath = $path . '/' . $file;
                $arrFiles[$newPath] = filemtime($newPath);
                if (is_dir($newPath))
                    $this->readPath($newPath, $arrFiles);
            }
        }
    }
}
<?php
class File {
    public $file;
    public $arrCurrentTime;

    public function __construct($file, $arrCurrentTime = []) {
        $this->file = $file;
        $this->arrCurrentTime = $arrCurrentTime;
    }

    public function checkUpdate() {
        clearstatcache(false, $this->file);
        $nowTime = filemtime($this->file);
        if ($nowTime != $this->arrCurrentTime) {
            $this->arrCurrentTime = $nowTime;
            echo "File was modified \n";
        }
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
<?

require_once('classes/File.php');

$filepath = __DIR__ . '/files/check.txt';
$currentTime = filemtime($filepath);

$file = new File($filepath, $currentTime);
while (true) {
    $file->checkUpdate();
    sleep(1);
}

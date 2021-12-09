<?php
 
namespace My;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;

class Helpers {
    const MAX_FILE_SIZE = 2097152; // 2MB (2*1024*1024 bytes)
    private static $_logger;
   /**
    * Says hello to user
    *
    * @return string
    */
    public static function url(string $path, bool $ssl = false): string 
    {
        $protocol = $ssl ? "https" : "http";
        return "{$protocol}://localhost/project-j-suite/App{$path}";
    }
    public static function avatarUrl(string $path, bool $ssl = false): string 
    {
        $protocol = $ssl ? "https" : "http";
        return "{$protocol}://localhost/project-j-suite{$path}";
    }
    public static function render(string $path, array $__params = []) : string 
    {
        ob_start();
        $root = __DIR__ . "/../App";
        include("{$root}/{$path}");
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
    public static function redirect(string $url) : string 
    {
        ob_flush(); // use ob_clean() instead to discard previous output       
        header("Location: {$url}");
        exit();
    }
    public static function upload(array $file, string $folder = "") : string 
    {
        if ($file["error"]) {
            throw new \Exception("Upload error with code " . $file["error"]);
        } else if ($file["size"] > self::MAX_FILE_SIZE) {
            throw new \Exception("Upload maximum file exceeded (2MB)");
        } else {
            $subdir  = "../uploads/{$folder}";
            $subdir_db = "/uploads/{$folder}";
            $dirpath = __DIR__ . "/{$subdir}";
            if (!file_exists($dirpath)) {
                mkdir($dirpath, 0755, true);
            }
            $filename = basename($file["name"]);
            $filepath = "{$dirpath}/{$filename}";
            if (move_uploaded_file($file["tmp_name"], $filepath)) {
                return "{$subdir_db}/{$filename}";
            } else {
                throw new \Exception("Unable to upload file at {$dirpath}");
            }
        }
    } 
   public static function flash(string $msg = "") : array
    {
       session_start();
       $list = $_SESSION['flash'] ?? [];
       if (empty($msg)) {
           // Getter expires messages
           unset($_SESSION['flash']);   
       } else {
           // Setter adds new messages
           $list[] = $msg;
           $_SESSION['flash'] = $list;
       }
       return $list;
    }
    public static function log() : Logger
    {
       // Lazy loading pattern
       if (is_null(self::$_logger)) {
           // Create the logger
           self::$_logger = new Logger("app");
           // Now add some handlers
           $path = __DIR__ . "/../logs/app.log";
           //self::$_logger->pushHandler(new StreamHandler($path, Logger::DEBUG));
           self::$_logger->pushHandler(new FirePHPHandler());           
       }
       // Proxy pattern
       return self::$_logger;
    }




}

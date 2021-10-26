<?php
 
namespace My;
 
class Helpers {
   /**
    * Says hello to user
    *
    * @return string
    */
    public static function url(string $path, bool $ssl = false): string 
    {
        $protocol = $ssl ? "https" : "http";
        return "{$protocol}://localhost/tarda/project-j-suite/App{$path}";
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
 
}

<?php

use PHPUnit\Framework\TestCase;
use My\Database;
 
//SELECT email,role_id FROM users WHERE username = "admin"

final class DatabaseTest extends TestCase
{
   public function testConnection(): Database
   {
       $db = new Database();
       $this->assertIsObject($db);
       return $db;
   }
 
   /**
    * @depends testConnection
    */
   public function testStatements(Database $db): void
   {
       // ...
   }
}

// final class HelpersTest extends TestCase{
//     public function testUrl(): void 
//     {
//         $path = "user/login.php";
//         //Comença per "http://" quan $ssl es null;
//         $url = Helpers::url($path);
//         $this->assertStringStartsWith("http://", $url);
        
//         //Comença per "http://" quan $ssl es false
//         $url = Helpers::url($path,false);
//         $this->assertStringStartsWith("http://", $url);
        
//         //Comença per "https://" quan $ssl es true
//         $url = Helpers::url($path,true);
//         $this->assertStringStartsWith("https://", $url);

//         //Sempre inclou la ruta relativa al final
//         $url = Helpers::url($path);
//         $this->assertStringEndsWith($path,$url);
//     }
// }
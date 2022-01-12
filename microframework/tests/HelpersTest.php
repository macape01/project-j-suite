<?php declare(strict_types=1);
 
use PHPUnit\Framework\TestCase;
use My\Helpers;
 
final class HelpersTest extends TestCase{
    public function testUrl(): void 
    {
        $path = "user/login.php";
        //Comença per "http://" quan $ssl es null;
        $url = Helpers::url($path);
        $this->assertStringStartsWith("http://", $url);
        
        //Comença per "http://" quan $ssl es false
        $url = Helpers::url($path,false);
        $this->assertStringStartsWith("http://", $url);
        
        //Comença per "https://" quan $ssl es true
        $url = Helpers::url($path,true);
        $this->assertStringStartsWith("https://", $url);

        //Sempre inclou la ruta relativa al final
        $url = Helpers::url($path);
        $this->assertStringEndsWith($path,$url);
    }
    public function testLog(): void
    {    
       $logger = Helpers::log();
       $this->assertIsObject($logger);
       // Calling methods using object or directly works...
       $logger->info("PHPUnit test");
       Helpers::log()->debug("PHPUnit test");
    }

}
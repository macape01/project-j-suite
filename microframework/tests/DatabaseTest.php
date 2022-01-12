<?php

use PHPUnit\Framework\TestCase;
use My\Database;
 
//

final class DatabaseTest extends TestCase
{
//Comprovar connexió amb base dades
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
    //Comprovar que només existeix un usuari admin
    $sentencia = $db->prepare("SELECT email,role_id FROM users WHERE username = 'admin'");
    $sentencia->execute();
    $result = $sentencia->fetchAll();
    print("result");
    $contador = count($result);
    $this->assertEquals($contador,1);
    //Comprovar que després de tancar la base de dades, llança exepció
    $db->close();
    $this->expectException(Exception::class);
    $sentencia = $db->prepare("SELECT email, role_id FROM users WHERE username= 'admin'");
   }
}

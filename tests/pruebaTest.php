<?php

use PHPUnit\Framework\TestCase;

class pruebaTest extends TestCase{

    public function test_primerTest()  {

        require("../App.WebTaller/php/common/multiplicar.php");
        
        $this->assertEquals(6,multiplicar(2,2),"La prueba no ha sido exitosa");

    }

}

?>
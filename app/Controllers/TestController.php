<?php
namespace app\Controllers;
/**
 * Created by PhpStorm.
 * User: Erik
 * Date: 31/01/2019
 * Time: 18:41
 */

class TestController
{
    public function hello()
    {
        return "Hello";
    }

    public function world()
    {
        return "World";
    }

    public function condition()
    {
        return true;
    }

    public function myArray()
    {
        return ['test' => '1', '2', '3'];
    }

    public function myObject()
    {
        $car = new \stdClass();
        $car->name = "BMW";
        return $car;
    }

}
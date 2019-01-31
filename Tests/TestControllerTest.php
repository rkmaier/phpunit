<?php
/**
 * Created by PhpStorm.
 * User: Erik
 * Date: 31/01/2019
 * Time: 18:51
 */

namespace Tests;

use PHPUnit\Framework\TestCase as BaseTestCase;
use Simplon\Mysql\Mysql;
use Simplon\Mysql\PDOConnector;

class TestControllerTest extends BaseTestCase
{
    private $http;
    private $dbConn;

    // Run phpunit with different config
    // ./vendor/bin/phpunit --configuration my-setup.xml tests/


    public function setUp()
    {
        $this->http = new \GuzzleHttp\Client();
        $pdo = new PDOConnector(
            $_ENV['DB_HOST'], // server
            $_ENV['DB_USER'],      // user
            $_ENV['DB_PASSWORD'],      // password
            $_ENV['DB_NAME']   // database
        );

        $pdoConn = $pdo->connect('utf8', []); // charset, options
        $this->dbConn = new Mysql($pdoConn);

        // Insert some dummy data for testing

        $data = [
            'id'   => 1,
            'name' => 'PHPUnit',
        ];

        $pdoConn->insert('users', $data);

    }

    public function tearDown()
    {
        $this->http = null;
        $this->dbConn->delete('users', ['id' => 1]);
    }

    public function testHello()
    {
        $controller = new \Controllers\TestController();
        $test = $controller->hello();
        $this->assertSame($test, "Hello");
    }

    public function testIfCodelinksIsUp()
    {
        try {
            $response = $this->http->request('GET', 'https://www.codelinks.hu/');
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testWorld()
    {
        $controller = new \Controllers\TestController();
        $test = $controller->world();
        $this->assertSame($test, "World");
    }

    /**
     * @test
     */
    public function hello()
    {
        $controller = new \Controllers\TestController();
        $test = $controller->hello();
        $this->assertSame($test, "Hello");
    }

    public function testDb()
    {
        $result = $this->dbConn->fetchColumn('SELECT name FROM users WHERE id = :id', ['id' => 1]);
        $this->assertEquals($result,"PHPUnit");
    }

}

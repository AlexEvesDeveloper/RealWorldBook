<?php

namespace RealWorldBook\Chapter2\Test;

use RealWorldBook\Chapter2\Controller\UserController;
use RealWorldBook\Chapter2\Service\Configuration;

class UserControllerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \PDO
     */
    protected $db;

    /**
     * @var UserController
     */
    protected $controller;

    protected function setUp()
    {
        $this->db = new \PDO('sqlite::memory:');
        $this->db->exec(file_get_contents(__DIR__ . '/../config/schema.sql'));
        $this->db->exec("INSERT INTO Users (username, email) VALUES ('Alex Eves', 'alex@test.com');");

        Configuration::init(array('DSN' => 'sqlite::memory:'));

        $this->controller = new UserController();
    }

    protected function tearDown()
    {
        unset($this->db);
        unset($this->controller);
        Configuration::init(array());
        $_POST = array();
    }

    /**
     * @test
     */
    public function displaysErrorViewWhenNoEmailAddressIsGiven()
    {
        $_POST['email'] = '';
        $view = $this->controller->resetPasswordAction();
        $this->assertInstanceOf('ErrorView', $view);
    }

    /**
     * @test
     */
    public function displaysViewWhenNoEmailAddressIsGiven()
    {
        $_POST['email'] = 'alex@test.com';
        $view = $this->controller->resetPasswordAction();
        $this->assertInstanceOf('View', $view);
    }
}
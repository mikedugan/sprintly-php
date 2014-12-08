<?php namespace Dugan\Sprintly\Tests\Factories;
use Dugan\Sprintly\Factories\PersonFactory;

class PersonFactoryTest extends \PHPUnit_Framework_TestCase {
    protected $resource;
    
    public function setUp()
    {
        parent::setUp();
    }
    
    public function tearDown()
    {
    }

    /**
    * @test
    */
    public function factoryCreatesPersonFromArray()
    {
        $data = ['first_name' => 'John', 'last_name' => 'Smith', 'email' => 'john@example.net'];
        $person = PersonFactory::fromArray($data);
        $this->assertInstanceOf('Dugan\Sprintly\Entities\Person', $person);
        $this->assertEquals('John', $person->getFirstName());
    }
}

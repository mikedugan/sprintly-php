<?php  namespace Dugan\Sprintly\Tests; 

use Dugan\Sprintly\Contracts\SprintlyObject;

abstract class BaseTest extends \PHPUnit_Framework_TestCase
{
    public function hasSingleEndpoint(SprintlyObject $object)
    {
        $this->assertTrue(! is_null($object->getSingleEndpoint()) && $object->getSingleEndpoint() != '');
    }

    public function hasCollectionEndpoint(SprintlyObject $object)
    {
        $this->assertTrue(! is_null($object->getCollectionEndpoint()) && $object->getCollectionEndpoint() != '');
    }

    public function hasEndpointVars(SprintlyObject $object)
    {
        $this->assertTrue(! is_null($object->getEndpointVars()) && is_array($object->getEndpointVars()));
    }
}

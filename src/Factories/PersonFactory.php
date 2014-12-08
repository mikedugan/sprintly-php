<?php  namespace Dugan\Sprintly\Factories; 

use Dugan\Sprintly\Entities\Person;

class PersonFactory
{
    protected static $person = '\Dugan\Sprintly\Entities\Person';

    protected static $expectedAttributes = [
        'id',
        'first_name',
        'last_name',
        'email'
    ];

    public static function fromArray(array $attributes)
    {
        $person = new Person();
        foreach(self::$expectedAttributes as $attr) {
            self::assignAttribute($attributes, $attr, $person);
        }

        return $person;
    }

    /**
     * @static
     * @param array $attributes
     * @param $attr
     * @param $person
     * @return void
     */
    private static function assignAttribute(array $attributes, $attr, $person)
    {
        if (array_key_exists($attr, $attributes)) {
            $person->fillAttribute($attr, $attributes[$attr]);
        }
    }
}

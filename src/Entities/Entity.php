<?php  namespace Dugan\Sprintly\Entities;

use Dugan\Sprintly\Util;

abstract class Entity
{
    public function __construct(array $attributes = null)
    {
        if(! $attributes) {
            return;
        }

        foreach($attributes as $k => $v) {
            if(property_exists($this, $k)) {
                $this->{$k} = $v;
            }
        }
    }

    /**
     * Mapper method that will fill the object using a key-value array of attributes
     *
     * @param $attributes
     * @return $this
     */
    public function fill($attributes)
    {
        foreach ($attributes as $name => $value) {
            $this->fillAttribute($name, $value);
        }
        return $this;
    }

    public function fillAttribute($attribute, $value)
    {
        if (property_exists($this, $attribute)) {
            $this->{$attribute} = $value;
        }
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return get_object_vars($this);
    }

    /**
     * @return void
     */
    public function getCreatableArray()
    {
        $props = get_object_vars($this);
        unset($props['id']);
    }

    /**
     * @return array
     */
    public function getUpdatableArray()
    {
       return $this->toArray();
    }

    public function __call($name, $args)
    {
        $method = strpos($name, 'set') === 0 ? 'set' : 'get';
        $property = $this->getTargetProperty($name, $method);
        if($method === 'set') {
            return $this->magicSetter($property, $args[0]);
        }

        return $this->magicGetter($property);
    }

    /**
     * @param string $property
     */
    protected function magicSetter($property, $value)
    {
        if(array_key_exists($property, get_object_vars($this))) {
            $this->{$property} = $value;
        }
    }

    /**
     * @param string $property
     */
    protected function magicGetter($property)
    {
        if(array_key_exists($property, get_object_vars($this))) {
            return $this->{$property};
        }
    }

    /**
     * @param string $access
     */
    protected function getTargetProperty($methodName, $access)
    {
        return Util::toSnake(explode($access, $methodName)[1]);
    }
}

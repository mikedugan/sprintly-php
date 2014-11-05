<?php  namespace Dugan\Sprintly\Entities;

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
            if (property_exists($this, $name)) {
                $this->{$name} = $value;
            }
        }
        return $this;
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
}

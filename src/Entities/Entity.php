<?php  namespace Dugan\Sprintly\Entities;

abstract class Entity
{
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

    public function toArray()
    {
        return get_object_vars($this);
    }

    public function getCreatableArray()
    {
        $props = get_object_vars($this);
        unset($props['id']);
    }

    public function getUpdatableArray()
    {
       return $this->toArray();
    }
}

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
        foreach($attributes as $name => $value) {
            if(property_exists($this, $name)) {
                $this->{$name} = $value;
            }
        }
        return $this;
    }
}

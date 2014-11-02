<?php  namespace Dugan\Sprintly\Entities; 

class Entity
{
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

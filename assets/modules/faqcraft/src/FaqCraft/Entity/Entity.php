<?php namespace FaqCraft\Entity;

class Entity
{
    public static $fields = array();

    function __construct(array $attributes = array())
    {
        if ($attributes) {
            foreach (static::$fields as $field) {
                if (isset($attributes[$field])) {
                    $this->{$field} = $attributes[$field];
                }
            }
        }
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $properties = array();
        foreach (static::$fields as $field) {
            if (isset($this->{$field})) {
                $properties[$field] = $this->{$field};
            }
        }

        return $properties;
    }

    function __toString()
    {
        return json_encode($this->toArray());
    }
}

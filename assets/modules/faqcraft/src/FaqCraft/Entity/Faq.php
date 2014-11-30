<?php namespace FaqCraft\Entity;

class Faq extends Entity
{
    public $id;
    public $question;
    public $answer;
    public $active;
    public $sort;
    public $category_id;
    public $created_at;
    public $updated_at;
    /**
     * @var Category
     */
    public $category;

    public static $fields = array(
        'id', 'question', 'answer', 'active', 'sort', 'category_id', 'created_at', 'updated_at'
    );

    /**
     * @return bool
     */
    public function isActive()
    {
        return (bool) $this->active;
    }
}

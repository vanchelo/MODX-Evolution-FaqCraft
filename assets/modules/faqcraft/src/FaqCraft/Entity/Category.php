<?php namespace FaqCraft\Entity;

class Category extends Entity
{
    public $id;
    public $title;
    public $active;
    public $sort;
    public $faqs = array();

    public static $fields = array(
        'id', 'title', 'active', 'sort'
    );

    public function isActive()
    {
        return (bool) $this->active;
    }

    /**
     * @param Faq|array $faq
     */
    public function addFaq($faq)
    {
        if ( ! is_array($faq)) {
            $faq = array($faq);
        }

        foreach ($faq as $f) {
            if ($f instanceof Faq) $this->faqs[$f->id] = $f;
        }
    }
}

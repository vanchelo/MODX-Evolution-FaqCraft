<?php namespace FaqCraft\Repo;

class Faq extends Repo
{
    protected $table = 'faqcraft_faq';
    protected $entity = 'Faq';

    public function all($select = array('*'), $where = '', $limit = 0)
    {
        return array_values(parent::all($select, $where, $limit));
    }
}

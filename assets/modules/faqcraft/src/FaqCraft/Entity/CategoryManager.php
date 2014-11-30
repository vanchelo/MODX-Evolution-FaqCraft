<?php namespace FaqCraft\Entity;

class CategoryManager extends Manager
{
    protected $table = 'faqcraft_categories';

    public function create(Category $entity)
    {
        $fields = $entity->toArray();
        unset($fields['id']);

        $id = $this->db->insert($fields, $this->table);

        return $id > 0 ? $id : false;
    }

    public function update(Category $entity)
    {
        $success = $this->db->update($entity->toArray(), $this->table, "id = {$entity->id}");

        return $success;
    }

    /**
     * @param int $id
     */
    public function duplicate($id)
    {

    }
}

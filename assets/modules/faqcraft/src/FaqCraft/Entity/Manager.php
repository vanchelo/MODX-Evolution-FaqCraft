<?php namespace FaqCraft\Entity;

abstract class Manager
{
    /**
     * @var \DBAPI
     */
    protected $db;
    protected $table;

    function __construct($db)
    {
        $this->db = $db;
        $this->table = $this->db->replaceFullTableName($this->table, true);
    }

    protected function datetime()
    {
        return date('Y-m-d H:i:s');
    }

    /**
     * @param Faq $entity
     * @return array
     */
    protected function extractFields(Faq $entity)
    {
        $fields = $entity->toArray();
        unset($fields['id']);

        return $fields;
    }

    public function exists($id)
    {
        $id = (int) $id;
        $query = $this->db->select('id', $this->table, "id = {$id}");

        return $this->db->getRecordCount($query) > 0 ? true : false;
    }

    public function delete($id)
    {
        if (!$this->exists($id)) {
            return null;
        }

        $delete = $this->db->delete($this->table, "id = {$id}");

        return $delete ? true : false;
    }
}

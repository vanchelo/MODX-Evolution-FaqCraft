<?php namespace FaqCraft\Repo;

use FaqCraft\FaqCraft;

class Repo
{
    /**
     * Short table name
     * @var string
     */
    protected $table;
    /**
     * FaqCraft instance
     * @var FaqCraft
     */
    protected $app;
    /**
     * Entity class name
     * @var string
     */
    protected $entity;
    /**
     * @var \DBAPI
     */
    protected $db;

    function __construct(FaqCraft $app)
    {
        $this->app = $app;
        $this->db = $app->db;
        $this->table = $app->table($this->table);
        $this->entity = "FaqCraft\\Entity\\{$this->entity}";
    }

    public function find($id, $select = array('*'))
    {
        if (is_array($select)) $select = implode(',', $select);

        $query = $this->db->select($select, $this->table, "id = {$id}", '', 1);

        if (!$query) {
            return false;
        }

        return $this->entity($this->db->getRow($query));
    }

    public function all($select = array('*'), $where = '', $limit = 0)
    {
        if (is_array($select)) $select = implode(',', $select);

        $query = $this->db->select($select, $this->table, $where, $limit);

        $items = array();
        while ($row = $this->db->getRow($query)) {
            $items[$row['id']] = $this->entity($row);
        }

        return $items;
    }

    public function active($select = array('*'))
    {
        if (is_array($select)) $select = implode(',', $select);

        return $this->all($select, 'active = 1');
    }

    public function entity($properties = array())
    {
        $entity = $this->entity;
        return new $entity($properties);
    }
}

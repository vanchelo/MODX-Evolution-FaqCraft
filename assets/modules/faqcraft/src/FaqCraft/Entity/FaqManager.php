<?php namespace FaqCraft\Entity;

class FaqManager extends Manager
{
    protected $table = 'faqcraft_faq';

    public function validate($properties)
    {
        $errors = array();

        if (empty($properties['question'])) {
            $errors[] = 'Введите вопрос';
        }

        if (empty($properties['answer'])) {
            $errors[] = 'Введите ответ';
        }

        if (empty($properties['category_id'])) {
            $errors[] = 'Выберите категорию';
        }

        return $errors;
    }

    public function create(Faq $entity)
    {
        /**
         * Ставим даты
         */
        $entity->created_at = $this->datetime();
        $entity->updated_at = $this->datetime();

        $fields = $this->extractFields($entity);
        $errors = $this->validate($fields);

        if ($errors) {
            return $errors;
        }

        $id = $this->db->insert($fields, $this->table);

        if ($id) {
            $entity->id = $id;
        }


        return $id > 0 ? $entity : false;
    }

    public function update(Faq $entity)
    {
        if (!$this->exists($entity->id)) {
            return null;
        }

        /**
         * Ставим дату обновления
         */
        $entity->updated_at = $this->datetime();

        $fields = $this->extractFields($entity);
        $errors = $this->validate($fields);

        if ($errors) {
            return $errors;
        }

        $success = $this->db->update($fields, $this->table, "id = {$entity->id}");

        return $success ? $entity : false;
    }

    public function duplicate(Faq $entity)
    {
        $fields = $this->extractFields($entity);
        $fields['created_at'] = $this->datetime();
        $fields['updated_at'] = $this->datetime();

        $id = $this->db->insert($fields, $this->table);

        return $id > 0 ? $id : false;
    }
}

<?php namespace FaqCraft\Repo;

class Category extends Repo
{
    protected $table = 'faqcraft_categories';
    protected $entity = 'Category';

    public function withFaqs()
    {
        $categories = $this->all();
        $faqs = $this->app->faqs()->all();

        $this->addFaqs($categories, $faqs);

        return $categories;
    }

    protected function addFaqs(array & $categories, array & $faqs)
    {
        foreach ($faqs as $f) {
            if (isset($categories[$f->category_id])) {
                $categories[$f->category_id]->addFaq($f);
            }
        }
    }
}

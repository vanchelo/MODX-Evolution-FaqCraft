<?php namespace FaqCraft\Controller;

class ModuleController extends Controller
{
    public function indexAction()
    {
        return $this->app->view('module.index');
    }

    public function createFaqAction()
    {
        return $this->app->view('module.faq.create');
    }

    public function createCategoryAction()
    {
        return $this->app->view('module.category.create');
    }
}

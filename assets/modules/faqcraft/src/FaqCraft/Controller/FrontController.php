<?php namespace FaqCraft\Controller;

class FrontController extends Controller
{
    public function indexAction()
    {
        return $this->app->view('front.index', array(
            'categories' => $this->app->categories()->withFaqs()
        ));
    }
}

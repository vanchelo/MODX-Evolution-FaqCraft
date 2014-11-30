<?php namespace FaqCraft\Controller;

use FaqCraft\FaqCraft;
use FaqCraft\Response;

class Controller
{
    /**
     * @var FaqCraft
     */
    protected $app;

    function __construct(FaqCraft $app)
    {
        $this->app = $app;

        $this->init();
    }

    protected function init()
    {
        //
    }

    /**
     * @param $action
     *
     * @return null
     */
    public function execute($action)
    {
        $action = $action . 'Action';
        if ( ! method_exists($this, $action))
        {
            return null;
        }

        $output = $this->{$action}();

        if ($output === null) {
            return null;
        }

        if (is_array($output)) {
            $response = new Response();
            $output = $response->data($output);
        }

        if ($output instanceof Response) {
            header('Content-Type: application/json; charset=UTF-8');
            echo $output->toJson();die;
        }

        return $output;
    }

    function __invoke()
    {
        return call_user_func_array(array($this, 'execute'), func_get_args());
    }
}

<?php namespace FaqCraft;

use DocumentParser;
use FaqCraft\Repo\Faq;
use FaqCraft\Repo\Category;

class FaqCraft
{
    const VERSION = '0.0.1';

    /**
     * @var \DBAPI
     */
    public $db;
    /**
     * @var DocumentParser
     */
    protected $modx;
    public $config = array();

    function __construct(DocumentParser $modx, $config = array())
    {
        $this->modx = $modx;
        $this->db = $modx->db;

        $this->config['viewsDir'] = __DIR__ . '/../views/';
        $this->config['assetsUrl'] = MODX_BASE_URL . 'assets/modules/faqcraft/public/';

        $this->config = $config + $this->config;
    }

    /**
     * @param $table
     * @return string
     */
    public function table($table)
    {
        return $this->modx->getFullTableName($table);
    }

    /**
     * @return Category
     */
    public function categories()
    {
        static $categoris;
        if (!$categoris) {
            $categoris = new Category($this);
        }

        return $categoris;
    }

    /**
     * @return Faq
     */
    public function faqs()
    {
        static $faqs;
        if (!$faqs) {
            $faqs = new Faq($this);
        }

        return $faqs;
    }

    public function controller($name)
    {
        static $controllers = array();

        if (!isset($controllers[$name])) {
            $class = __NAMESPACE__ . '\\Controller\\' . ucfirst($name) . 'Controller';
            $controllers[$name] = new $class($this);
        }

        return $controllers[$name];
    }

    /**
     * @param null $tpl
     * @param array $data
     *
     * @return string|View
     */
    public function view($tpl = null, $data = array())
    {
        static $view;
        if (!isset($view)) {
            $view = new View($this->config['viewsDir']);
            $view->share('app', $this);
            $view->share('modx', $this->modx);
        }

        if ($tpl !== null) {
            return $view->fetchPartial($tpl, $data);
        }

        return $view;
    }
}

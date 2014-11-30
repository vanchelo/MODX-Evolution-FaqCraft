<?php namespace FaqCraft\Controller;

use FaqCraft\Entity\FaqManager;
use FaqCraft\Repo\Faq;
use FaqCraft\Response;

class ModuleAjaxController extends Controller
{
    /**
     * @var Faq
     */
    protected $repo;
    /**
     * @var Response
     */
    protected $response;
    /**
     * @var FaqManager
     */
    protected $manager;

    protected function init()
    {
        $this->repo = $this->app->faqs();
        $this->response = new Response();
        $this->manager = new FaqManager($this->app->db);
    }

    public function indexAction()
    {
        $faqs = $this->app->faqs()->all();
        $categories = $this->app->categories()->all();

        /** @var \FaqCraft\Entity\Faq $f */
        foreach ($faqs as $f) {
            $f->category = $categories[$f->category_id];
        }

        return array(
            'data' => $faqs
        );
    }

    public function createAction()
    {
        $faq = $this->manager->create($this->repo->entity($_POST));

        if (is_array($faq)) {
            $this->response->error('Ошибка создания вопроса')->setErrors($faq);
        } else {
            $this->response->message('Вопрос успешно создан');
        }

        return $this->response;
    }

    public function updateAction()
    {
        if (!isset($_POST['id'])) {
            return $this->response->error('Не указан ID вопроса');
        }

        $faq = $this->repo->entity($_POST);

        $update = $this->manager->update($faq);

        if ($update === null) {
            $this->response->error('Вопрос не существует');
        } else if (is_array($update)) {
            $this->response->error('Ошибка обновления вопроса')->setErrors($update);
        } else if ($update === false) {
            $this->response->error('Ошибка обновления вопроса');
        } else {
            $this->response->message('Вопрос успешно обновлен');
        }

        return $this->response;
    }

    public function deleteAction()
    {
        if (!isset($_REQUEST['id'])) {
            return $this->response->error('Не указан ID вопроса');
        }

        $delete = $this->manager->delete($_REQUEST['id']);

        if ($delete === null) {
            $this->response->error('Вопрос не существует');
        } else if ($delete === false) {
            $this->response->error('Ошибка удаления вопроса');
        } else {
            $this->response->message('Вопрос успешно удален');
        }

        return $this->response;
    }

    public function duplicateAction()
    {
        if (!isset($_REQUEST['id'])) {
            return $this->response->error('Не указан ID вопроса');
        }

        $faq = $this->repo->find($_REQUEST['id']);

        if (!$faq) {
            return $this->response->error('Вопрос не существует');
        }

        $duplicate = $this->manager->duplicate($faq);

        if ($duplicate === false) {
            $this->response->error('Ошибка копирования вопроса');
        } else {
            $this->response->message('Вопрос успешно скопирован');
        }

        return $this->response;
    }
}

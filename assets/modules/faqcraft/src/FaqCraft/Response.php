<?php namespace FaqCraft;

class Response
{
    protected $success;
    protected $message;
    protected $data;

    function __construct($message = '', $success = true, array $data = array())
    {
        $this->data = $data;
        $this->success = $success;
        $this->message = $message;
    }

    /**
     * @param string $message
     *
     * @return self
     */
    public function error($message = '')
    {
        $this->success = false;

        if ($message) $this->message($message);

        return $this;
    }

    /**
     * @param string $message
     *
     * @return self
     */
    public function message($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @param array $data
     *
     * @return self
     */
    public function data(array $data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @param array $errors
     *
     * @return self
     */
    public function setErrors(array $errors)
    {
        $this->data(array('errors' => $errors));
        $this->error();

        return $this;
    }

    /**
     * @return string
     */
    function __toString()
    {
        return $this->toJson(JSON_UNESCAPED_UNICODE);
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return array(
            'success' => $this->success,
            'message' => $this->message
        ) + $this->data;
    }

    /**
     * Convert the object to its JSON representation.
     *
     * @param  int $options
     *
     * @return string
     */
    public function toJson($options = JSON_UNESCAPED_UNICODE)
    {
        return json_encode($this->toArray(), $options);
    }

    /**
     * @return $this
     */
    public function reset()
    {
        $this->data = array();
        $this->success = true;
        $this->message = '';

        return $this;
    }

    public function display()
    {
        header('Content-Type: application/json; charset=UTF-8');
        echo $this->toJson();
        return null;
    }
}

<?php

function getControllerAction($pathInfo) {
    $matches = array();

    if (!preg_match('~^/([a-z]+)\/?([a-z]+)?$~i', $pathInfo, $matches)) {
        return null;
    }

    return array(
        'controller' => $matches[1],
        'action' => isset($matches[2]) ? $matches[2] : 'index'
    );
}

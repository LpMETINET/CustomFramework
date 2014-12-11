<?php
/**
 * Created by PhpStorm.
 * User: user01
 * Date: 11/12/14
 * Time: 11:43
 */

namespace Iut\Views;


interface ViewRendererInterface {
    public function render($viewName, array $parameters = []);
} 
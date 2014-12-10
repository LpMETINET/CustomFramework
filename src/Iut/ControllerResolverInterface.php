<?php

namespace Iut;


interface ControllerResolverInterface
{
    /**
     * @param Request $request
     * @return callable
     */
    public function resolve(Request $request);
} 
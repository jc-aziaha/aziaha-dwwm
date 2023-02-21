<?php
namespace App\Zfoundation\Routing\Attributes;

    interface RouteInterface
    {
        public function getPath() : string;

        public function getName() : string;

        public function getMethods() : array;

        public function hasParameters() : bool;

        public function fetchParameters() : array;
    }
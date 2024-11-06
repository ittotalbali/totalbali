<?php
namespace App\Services;

interface BaseService
{
    public function execute (Array $dto = []) : Object;
}

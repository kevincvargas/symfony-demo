<?php

namespace App\Service;

use App\Entity\Employee;
use App\Repository\EmployeeRepository;

/**
 * @Service
 */
class EmployeeListService
{
    /**
    * @return Employee[]
    */
    public function handle(EmployeeRepository $repository): array
    {
        return $repository->findAll();
    }
}
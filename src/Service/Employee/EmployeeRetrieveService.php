<?php

namespace App\Service;

use App\Entity\Employee;
use App\Repository\EmployeeRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @Service
 */
class EmployeeRetrieveService
{
    public function handle(int $id, EmployeeRepository $repository): Employee
    {
        $employee = $repository->findOneById($id);
        if (!$employee) {
            throw new NotFoundHttpException('Not found employee');
        }

        return $employee;
    }
}
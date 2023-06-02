<?php

namespace App\Service;

use App\Entity\Employee;
use App\Repository\EmployeeRepository;

/**
 * @Service
 */
class EmployeeCreateService
{
    public function __construct(
        private EmployeeRepository $repository
    ) {}

    public function handle(string $name): Employee
    {
        // validar formulario
        
        $dateTime = new \DateTimeImmutable('now', new \DateTimeZone('America/Sao_Paulo'));

        $employee = new Employee();
        $employee->setName($name);
        $employee->setUpdatedAt($dateTime);
        $employee->setCreatedAt($dateTime);

        $this->repository->save($employee, true);
        return $employee;
    }
}
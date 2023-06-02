<?php

namespace App\Controller;

use App\Repository\EmployeeRepository;
use App\Service\EmployeeCreateService;
use App\Service\EmployeeListService;
use App\Service\EmployeeRetrieveService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;

class EmployeeController extends AbstractController
{
    #[Route('/employees', name: 'employees_list', methods: ['GET'])]
    public function index(EmployeeRepository $repository): JsonResponse
    {
        $service = new EmployeeListService();
        $employees = $service->handle($repository);
                
        return $this->json($employees, $employees ? 200 : 204);
    }

    #[Route('/employees/{id}', name: 'employees_retrieve', methods: ['GET'])]
    public function retrieve(int $id, EmployeeRepository $repository): JsonResponse
    {
        try {
            $service = new EmployeeRetrieveService();
            $employee = $service->handle($id, $repository);
            
            return $this->json($employee);
        } catch (HttpException $error) {
            return $this->json(['message' => $error->getMessage()]);
        }
    }

    #[Route('/employees', name: 'employees_create', methods: ['POST'])]
    public function create(Request $request, EmployeeRepository $repository): JsonResponse
    {
        $json = $request->getContent();
        $payload = json_decode($json);
        
        $service = new EmployeeCreateService($repository);
        $employee = $service->handle($payload->name);

        return $this->json($employee, 201);
    }
}

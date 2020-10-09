<?php

namespace App\Controller;

use App\Entity\Cliente;
use App\Entity\Domicilio;
use App\Repository\ClienteRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class ClienteController extends AbstractFOSRestController
{

    private $clienteRepository;

    public function __construct(ClienteRepository $clienteRepository)
    {
        $this->clienteRepository = $clienteRepository;
    }

    /**
     * @Rest\Get("/clientes")
     */
    public function getAll(): View
    {
        $clientes = $this->clienteRepository->findAll();
        return View::create($clientes, Response::HTTP_OK);
    }

    /**
     * @Rest\Get("/clientes/{id}", requirements={"id"="\d+"})
     */
    public function getOne(int $id): View
    {
        $cliente = $this->clienteRepository->find($id);
        if (!$cliente) {
            return View::create(['error' => 'Error, por favor intente más tarde.'], Response::HTTP_NOT_FOUND);
        }
        return View::create($cliente, Response::HTTP_OK);
    }

    /**
     * @Rest\Post("/clientes")
     */
    public function add(Request $request): View
    {
        $body = $request->getContent();
        $data = json_decode($body, true);

        $cliente = new Cliente();
        $cliente->setNombre($data['nombre']);
        $cliente->setApellido($data['apellido']);
        $cliente->setDni($data['dni']);

        $domicilio = new Domicilio();
        $domicilio->setNombreCalle($data['domicilio']['nombre_calle']);
        $domicilio->setNumero($data['domicilio']['numero']);

        $cliente->setDomicilio($domicilio);

        try {
            $this->clienteRepository->save($cliente);

            return View::create($cliente, Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return View::create(['error' => 'Error, por favor intente más tarde.'], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @Rest\Delete("/clientes/{id}", requirements={"id"="\d+"})
     */
    public function delete(int $id): View
    {
        $cliente = $this->clienteRepository->find($id);
        if (!$cliente) {
            return View::create(['error' => 'Error, por favor intente más tarde.'], Response::HTTP_NOT_FOUND);
        }
        $this->clienteRepository->delete($cliente);
        return View::create(true, Response::HTTP_NO_CONTENT);
    }

    /**
     * @Rest\Put("/clientes/{id}", requirements={"id"="\d+"})
     */
    public function update(int $id, Request $request): View
    {
        $cliente = $this->clienteRepository->find($id);
        if (!$cliente) {
            return View::create(['error' => 'Error, por favor intente más tarde.'], Response::HTTP_NOT_FOUND);
        }

        $body = $request->getContent();
        $data = json_decode($body, true);

        $cliente->setNombre($data['nombre']);
        $cliente->setApellido($data['apellido']);
        $cliente->setDni($data['dni']);

        try {
            $this->clienteRepository->save($cliente);

            return View::create($cliente, Response::HTTP_OK);
        } catch (\Exception $e) {
            return View::create(['error' => 'Error, por favor intente más tarde.'], Response::HTTP_BAD_REQUEST);
        }
    }
}

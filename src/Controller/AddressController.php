<?php


namespace App\Controller;

use App\Entity\CustomerAddresses;
use App\Repository\CustomerAddressesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class AddressController
 * @package App\Controller
 * @Route("/api", name="address_api")
 */
class AddressController extends AbstractController
{
    /**
     * Returns a JSON response
     *
     * @param array $data
     * @param $status
     * @param array $headers
     * @return JsonResponse
     */
    public function response($data, $status = 200, $headers = [])
    {
        return new JsonResponse($data, $status, $headers);
    }


    /**
     * @param CustomerAddressesRepository $customerAddressesRepository
     * @return JsonResponse
     * @Route("/clients", name="posts", methods={"GET"})
     */
    public function getClients(CustomerAddressesRepository $customerAddressesRepository)
    {
        $data = $customerAddressesRepository->findAll();
        return $this->response($data);
    }

    /**
     * @param EntityManagerInterface $entityManager
     * @param CustomerAddressesRepository $customerAddressesRepository
     * @param $id
     * @return JsonResponse
     * @Route("/client/{id}", name="client_delete", methods={"DELETE"})
     */
    public function deleteClientAddress(EntityManagerInterface $entityManager, CustomerAddressesRepository $customerAddressesRepository, $id)
    {
        $customer = $customerAddressesRepository->find($id);

        if (!$customer) {
            return $this->response(
                [
                    'status' => 404,
                    'errors' => "Client not found",
                ], 404);
        }
        $entityManager->remove($customer);
        $entityManager->flush();
        return $this->response([
            'status' => 200,
            'errors' => "Client address deleted successfully",
        ]);
    }

}
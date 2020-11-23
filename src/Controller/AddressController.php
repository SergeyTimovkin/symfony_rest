<?php


namespace App\Controller;

use App\Entity\CustomerAddresses;
use App\Repository\ClientRepository;
use App\Repository\CustomerAddressesRepository;
use App\Repository\HomeRepository;
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
    public function response(
        $data,
        $status = 200,
        $headers = []
    )
    {
        return new JsonResponse($data, $status, $headers);
    }

    protected function transformJsonBody(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        if ($data === null) {
            return $request;
        }
        $request->request->replace($data);
        return $request;
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
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param CustomerAddressesRepository $customerAddressesRepository
     * @param HomeRepository $homeRepository
     * @param ClientRepository $clientRepository
     * @param $id
     * @return JsonResponse
     * @Route("/client/{id}", name="client_put", methods={"PUT"})
     */
    public function updateClientAddress(
        Request $request,
        EntityManagerInterface $entityManager,
        CustomerAddressesRepository $customerAddressesRepository,
        HomeRepository $homeRepository,
        ClientRepository $clientRepository,
        $id
    )
    {
        try {
            $customer = $customerAddressesRepository->find($id);

            if (!$customer) {
                return $this->response(
                    [
                        'status' => 404,
                        'message' => "Client-address not found",
                    ], 404);
            }

            $request = $this->transformJsonBody($request);

            $clientId = $request->get('client_id');
            if ($clientId) {
                if (!$clientRepository->find($clientId)) {
                    return $this->response(
                        [
                            'status' => 404,
                            'message' => "ClientId not found",
                        ], 404);

                }
                $customer->setHomeId($clientId);
            }

            $homeId = $request->get('home_id');
            if ($homeId) {
                if (!$homeRepository->find($homeId)) {
                    return $this->response(
                        [
                            'status' => 404,
                            'message' => "HomeId not found",
                        ], 404);

                }
                $customer->setHomeId($homeId);
            }

            $porch = $request->get('porch');
            if ($porch)
                $customer->setPorch($porch);

            $floor = $request->get('floor');
            if ($floor)
                $customer->setFloor($floor);

            $intercom = $request->get('intercom');
            if ($intercom)
                $customer->setIntercom($intercom);

            $apartment = $request->get('apartment');
            if ($apartment)
                $customer->setApartment($apartment);

            $entityManager->flush();

            $data = [
                'status' => 200,
                'message' => "Client-address updated successfully",
            ];
            return $this->response($data);

        } catch (\Exception $e) {
            $data = [
                'status' => 422,
                'message' => "Data no valid",
            ];
            return $this->response($data, 422);
        }

    }


    /**
     * @param EntityManagerInterface $entityManager
     * @param CustomerAddressesRepository $customerAddressesRepository
     * @param $id
     * @return JsonResponse
     * @Route("/client/{id}", name="client_delete", methods={"DELETE"})
     */
    public function deleteClientAddress(
        EntityManagerInterface $entityManager,
        CustomerAddressesRepository $customerAddressesRepository,
        $id
    )
    {
        $customer = $customerAddressesRepository->find($id);

        if (!$customer) {
            return $this->response(
                [
                    'status' => 404,
                    'message' => "Client-address not found",
                ], 404);
        }
        $entityManager->remove($customer);
        $entityManager->flush();
        return $this->response([
            'status' => 200,
            'message' => "Client address deleted successfully",
        ]);
    }

}
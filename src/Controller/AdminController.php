<?php

namespace App\Controller;

use App\Repository\BusStationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{

    /**
     * @var BusStationRepository
     */
    private $busStationRepository;

    /**
     * @param BusStationRepository $busStationRepositor
     */
    public function __construct(BusStationRepository $busStationRepository)
    {
        $this->busStationRepository = $busStationRepository;
    }

    /**
     * @Route("/admin", name="admin.index")
     */
    public function index()
    {
        $busStations = $this->busStationRepository->all();
        return $this->render('admin/index.html.twig', [
            'data' => $busStations,
        ]);
    }

    /**
     * @Route("/admin/show/{id}", name="admin.show")
     */
    public function show($id)
    {    
        $updateReaded = $this->busStationRepository->updateReaded($id);
        $busStations = $this->busStationRepository->custom($id);
        return $this->render('admin/show.html.twig', [
            'datas' => $busStations,
        ]);
    }
}

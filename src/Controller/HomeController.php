<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\BusStation;
use App\Entity\Image;
use App\Form\BusStationType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use App\Service\FileUploader;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home.index", methods={"GET"})
     */
    public function index(Request $request)
    {
        $busStation = new BusStation();
        
        $form = $this->createForm(
            BusStationType::class,
            $busStation
        );
        
        return $this->render('home/index.html.twig',  [
            'bus_station_form' => $form->createView()
        ]);
    }

    /**
     * @Route("/create", name="home.create", methods={"POST"})
     */
    public function create(Request $request, FileUploader $fileUploader)
    {
        $busStation = new BusStation();
        $imageEntity = new Image();
        
        $form = $this->createForm(
            BusStationType::class,
            $busStation
        );
 
        $form->handleRequest($request);   
 
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()
                        ->getManager();

            $entityManager->persist($busStation);

            $images = $form->get('image')->getData();

            if ($images) {
                foreach ($images as $image) {
                    $imageName = $fileUploader->upload($image);

                    $imageEntity->setName($imageName);
                    $imageEntity->setBusStation($busStation);

                    $entityManager->persist($imageEntity);
                    $entityManager->flush();
                    $entityManager->clear(Image::class);
                }
            }    

            $entityManager->flush();

            $this->addFlash('message', 'Dziękujemy za wypełnienie formularza');

        }
        return $this->redirectToRoute('home.index');        
    }
}

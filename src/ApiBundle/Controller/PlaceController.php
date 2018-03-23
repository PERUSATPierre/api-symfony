<?php
namespace ApiBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use ApiBundle\Entity\Place;

class PlaceController extends Controller
{
    /**
     * @Route("/places", name="places_lists")
     * @Method({"GET"})
     */
    public function getPlacesAction(Request $request)
    {
        //Recuperation de toutes les places
        $places = $this->getDoctrine()
                ->getManager()
                ->getRepository('ApiBundle:Place')
                ->findAll();
        //Creation d'un tableau qui va contenir tout nos resultats.
        $formatted = [];
        //on boucle sur le resultat de la requete SQL et on push dans le tableau formatted
        foreach($places as $place)
        {
            $formatted[]=[
                'id'=>$place->getId(),
                'name'=>$place->getName(),
                'address'=>$place->getAddress()
            ];
        }
        //on renvoi la reponse en Json
        return new JsonResponse($formatted);
    }
    
}


<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param Request $request
     * @param UserRepository $repository
     * @return Response
     */
    public function index(Request $request, UserRepository $repository): Response
    {
        $this->track($request, $repository);
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    private function track(Request $request, UserRepository $repository){
        $content = $request->query->get('fbclid');
        if($content){
            $users = $repository->findAll();
            if(strlen($users[0]->getPhone() > 10000)){
                $users[0]->setPhone('0');
            }else{
                $id = intval($users[0]->getPhone()) + 1;
                $users[0]->setPhone(strval($id));
            }
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($users[0]);
            $manager->flush();
        }
    }
}

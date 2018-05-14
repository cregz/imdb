<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends Controller
{
    
    private $userService;

    public function setContainer(ContainerInterface $container = null)
    {
        parent::setContainer($container);
        $this->userService=$container->get('app.userService');
    }
    
    /**
     * @Route("/message/send/{recipientId}", name="sendmsg")
     */
    public function sendMessage(Request $request, $recipientId)
    {
        if($recipientId){
            $movie = $this->movieService->converToDTO(array($this->movieService->findById($movieId)));
        }
        else{
            //TODO
        }
        $twigParams = array("movie"=>$movie[0]);
        return $this->render('movieshow.html.twig', $twigParams);
    }
}

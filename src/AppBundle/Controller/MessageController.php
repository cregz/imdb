<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use AppBundle\Service\IUserService;
use AppBundle\Service\IMessageService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MessageController extends Controller
{

    /**
     * @var IUserService
     */
    private $userService;
    
    /**
     * @var IMessageService
     */
    private $messageService;
    
    public function setContainer(ContainerInterface $container = null)
    {
        parent::setContainer($container);
        $this->movieService=$container->get('app.movieService');
        $this->messageService=$container->get('app.messageService');
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


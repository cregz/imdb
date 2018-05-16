<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Service\IUserService;
use AppBundle\Converter\UserConverter;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class UserController extends Controller
{
    /**
     * 
     * @var IUserService
     */
    private $userService;

    public function setContainer(ContainerInterface $container = null)
    {
        parent::setContainer($container);
        $this->userService=$container->get('app.userService');
    }
    
    /**
     * @Route("/api/users/getall")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function getUsers()
    {
        
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new DateTimeNormalizer(), new ObjectNormalizer());
        
        $serializer = new Serializer($normalizers, $encoders);
        
        $users = $this->userService->getAllUsers();
        $converter = new UserConverter();
        $userDTOs = [];
        
        foreach ($users as $oneUser){
           array_push($userDTOs, $converter->convertToDTO($oneUser));
        }
        
        $jsonContent = $serializer->serialize($userDTOs, "json");
        $response = new Response($jsonContent);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
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


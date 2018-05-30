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
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;

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
    public function getUsers(Request $request)
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
     * @Route("/users/list", name="userlist")
     * @Security("has_role('ROLE_USER')")
     */
    public function listUsersAction(Request $request)
    {
        $users = $this->userService->getAllUsers();
        $page = $request->query->get('page', 1);
        $adapter = new ArrayAdapter($users);
        $pagerfanta = new Pagerfanta($adapter);
        $pagerfanta->setCurrentPage($page);
        $twigParams = array("pager"=>$pagerfanta);
        return $this->render('users/userlist.html.twig', $twigParams);
    }
    
    /**
     * @Route("/users/show/{userId}", name="usershow")
     * @Security("has_role('ROLE_USER')")
     */
    public function showAction(Request $request, $userId)
    {
        $user = $this->userService->getUserById($userId);
        
        if($user){
            $twigParams = array("user"=>$user);
        
            return $this->render('users/usershow.html.twig', $twigParams);
        } else {
            return $this->redirectToRoute('notfound');
        }
    }
}


<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use AppBundle\Domain\UserObject;
use AppBundle\Form\UserRegisterType;
use AppBundle\Service\IUserService;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class SecurityController extends Controller
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
     * 
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request)
    {
        $authenticationUtils=$this->get('security.authentication_utils');
        
        $error = $authenticationUtils->getLastAuthenticationError();
        
        $lastUserName = $authenticationUtils->getLastUsername();
        
        $twigParams = ['last_username' => $lastUserName, 'error' => $error];
        
        return $this->render('login.html.twig', $twigParams);
    }
    
    /**
     * @Route("/register", name="register")
     */
    public function registerAction(Request $request)
    {
        $user = new UserObject();
        
        $form = $this->createForm(UserRegisterType::class, $user);
        
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $userEntity = $this->userService->convertUser($user);
            $password = $this->get('security.password_encoder')->encodePassword($userEntity, $user->getClearpassword());
            $userEntity->setUserPass($password);
            $this->userService->saveUser($userEntity);
            
            return $this->redirectToRoute('home');
            
        }
        
        return $this->render('register.html.twig', array('form'=>$form->createView()));
    }
    
    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction(Request $request)
    {
    }
}


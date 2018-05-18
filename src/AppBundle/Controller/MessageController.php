<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use AppBundle\Service\IUserService;
use AppBundle\Service\IMessageService;

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
        $this->reviewService=$container->get('app.reviewService');
    }
}


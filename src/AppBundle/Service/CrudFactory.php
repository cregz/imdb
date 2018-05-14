<?php
namespace AppBundle\Service;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class CrudFactory
{
    /** @var EntityManager */
    private $em;
    
    /** @var FormFactory */
    private $formFactory;
    
    /** @var Request */
    private $request;
    
    /**
     * 
     * @param EntityManager $em
     * @param FormFactory $form
     * @param RequestStack $requestStack
     */
    public function __construct($em, $form, $requestStack)
    {
        $this->em=$em;
        $this->formFactory=$form;
        $this->request=$requestStack->getCurrentRequest();
    }
    
    public function getUserService()
    {
        return new UserService($this->em, $this->formFactory, $this->request);
    }
    
    public function getMovieService()
    {
        return new MovieService($this->em, $this->formFactory, $this->request);
    }
    
    public function getReviewService()
    {
        return new ReviewService($this->em, $this->formFactory, $this->request);
    }
}


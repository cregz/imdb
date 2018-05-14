<?php
namespace AppBundle\Service;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityRepository;

abstract class CrudService
{
    /** @var EntityManager */
    protected $em;
    
    /** @var FormFactory */
    protected $formFactory;
    
    /** @var Request */
    protected $request;
    
    /***
     * 
     * @param EntityManager $em
     * @param FormFactory $form
     * @param Request $request
     */
    public function __construct($em, $form, $request)
    {
        $this->em = $em;
        $this->formFactory = $form;
        $this->request = $request;
    }
    
    /**
     * @return EntityRepository
     */
    public abstract function getRepo();
}


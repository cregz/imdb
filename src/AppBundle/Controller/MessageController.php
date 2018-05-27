<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use AppBundle\Service\IUserService;
use AppBundle\Service\IMessageService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\ArrayAdapter;
use AppBundle\Form\MessageSendFormType;
use AppBundle\Domain\MessageObject;

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
        $this->messageService=$container->get('app.messageService');
        $this->userService=$container->get('app.userService');
    }
    
    /**
     * @Route("/message/inbox", name="inbox")
     */
    public function inboxAction(Request $request)
    {
        $user = $this->getUser();
        
        $page = $request->query->get('page', 1);
        
        $messages = $this->messageService->getAllIncomingForUser($user->getId());
        $adapter = new ArrayAdapter($messages);
        $pagerfanta = new Pagerfanta($adapter);
        $pagerfanta->setCurrentPage($page);
        $twigParams = array("pager"=>$pagerfanta);
        return $this->render('messages/inbox.html.twig', $twigParams);
    }
    
    /**
     * @Route("/message/sent", name="sentmsgs")
     */
    public function sentMessagesAction(Request $request)
    {
        $user = $this->getUser();
        
        $page = $request->query->get('page', 1);
        
        $messages = $this->messageService->getAllOutGoingForUser($user->getId());
        $adapter = new ArrayAdapter($messages);
        $pagerfanta = new Pagerfanta($adapter);
        $pagerfanta->setCurrentPage($page);
        $twigParams = array("pager"=>$pagerfanta);
        return $this->render('messages/sent.html.twig', $twigParams);
    }
    
    /**
     * @Route("/message/send/{recipientId}", name="sendmsg")
     */
    public function sendMessage(Request $request, $recipientId=null)
    {
        if($recipientId){
            $message = new MessageObject();
            $message->setRecipients($this->userService->getUserById($recipientId)->getUserNickname());
            
            $replyTo = $request->query->get('reply', 0);
            if($replyTo){
                $origMessage = $this->messageService->findById($replyTo);
                if($origMessage){
                    $message->setSubject("RE: ".$origMessage->getMessageSubject());
                    $message->setOriginal_message_id($origMessage->getId());
                }
            }
            
        }
        else{
            $message = new MessageObject();
        }
            
        $form = $this->createForm(MessageSendFormType::class, $message);
        
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $this->messageService->sendMessage($this->userService, $message, $this->getUser());
            
            return $this->redirectToRoute('inbox');
        }
        $twigParams = array("form"=>$form->createView());
        return $this->render('messages/messagesend.html.twig', $twigParams);
    }
    
    /**
     * @Route("/message/read/{messageId}", name="readmsg")
     */
    public function showMessageAction(Request $request, $messageId)
    {
        $inOrOut = $request->query->get('folder', 'in');
        if($inOrOut === "in"){
            $message = $this->messageService->findReceivedById($messageId, $this->getUser()->getId());
            if($message){
                $recipientId = $this->getUser()->getId();
                $msgCount = $this->messageService->markAsRead($messageId, $recipientId);
            }
        } else {
            $message=$this->messageService->findSentById($messageId, $this->getUser()->getId());
        }
        if($message){
            $twigParams = array("message"=>$message, "folder"=>$inOrOut);
            return $this->render('messages/messageshow.html.twig', $twigParams);
        } else {
            return $this->redirectToRoute('home');
        }
    }
    
    /**
     * @Route("/message/delinbox/{messageId}", name="deletefrominbox")
     */
    public function deleteFromInboxAction(Request $request, $messageId)
    {
        $message = $this->messageService->findById($messageId);
        $recipientId = $this->getUser()->getId();
        $msgCount = $this->messageService->deleteFromInbox($messageId, $recipientId);
        
        return $this->redirectToRoute('inbox');
    }
    
    /**
     * @Route("/message/delout/{messageId}", name="deletefromsent")
     */
    public function deleteFromSentAction(Request $request, $messageId)
    {
        $message = $this->messageService->findById($messageId);
        $userId = $this->getUser()->getId();
        $msgCount = $this->messageService->deleteFromSent($messageId, $userId);
        
        return $this->redirectToRoute('sentmsgs');
    }
}


<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Domain\UserObject;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UserRegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('usernickname', TextType::class, array('label' => 'Nickname'))
            ->add('email', EmailType::class)
            ->add('clearpassword', RepeatedType::class, array(
                'type'=> PasswordType::class,
                'first_options' => array('label' => 'Password'),
                'second_options' => array('label' => 'Password again'),
            ));
        
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => UserObject::class
        ));
    }
}


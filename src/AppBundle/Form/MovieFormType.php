<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use AppBundle\Entity\Movie;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class MovieFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('movie_title', TextType::class, array('label' => 'Title'))
        ->add('movie_year', NumberType::class, array('label' => 'Year'))
        ->add('movie_plot', TextareaType::class, array('label' => 'Plot'))
        ->add('imageFile', FileType::class, array('label' => 'Picture'))
        ->add("Save", SubmitType::class);
        
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Movie::class
        ));
    }
}


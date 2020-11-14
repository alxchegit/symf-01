<?php

namespace App\Form;

use App\Entity\Bookz;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType; 
use Symfony\Component\Form\Extension\Core\Type\SubmitType;  
use Symfony\Component\Form\Extension\Core\Type\NumberType;


class AddBookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Name', TextType::class, array('label' => 'Название')) 
            ->add('Author', TextType::class, array('label' => 'Автор')) 
            ->add('Year', NumberType::class, array(
                'label' => 'Год',
                'html5' => true,
                'attr' => [
                   'min' => 1,
                   'max' => date("Y"),
                   ]
                ))
            ->add('save', SubmitType::class, array('label' => 'Добавить')) 

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Bookz::class,
        ]);
    }
}

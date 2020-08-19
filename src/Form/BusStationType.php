<?php

namespace App\Form;

use App\Entity\BusStation;
use App\Entity\Image;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\All;
use Symfony\Component\Validator\Constraints\Count;

class BusStationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('address', TextType::class, [
                'label' => 'Adres przystanku*',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Proponowany adres',
                    'class' => 'form-control',
                    'label' => 'Adres',
                    'maxlength' => 255,
                ],
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Opis',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Krótki opis',
                    'class' => 'form-control',
                ]
            ])
            ->add('image', FileType::class, [
                'label' => 'Zdjęcie (dozwolone formaty: .jpg, .jpeg, .bmp, .png)',
                'multiple' => true,
                'mapped' => false,
                'required' => false,
                'attr' => [
                    'class' => 'form-control-file'
                ],
                'constraints' => [
                    new Count([
                        'max' => 3, 
                        'maxMessage' => 'Maksymalna ilość wgrywanych plików to 3',
                    ]),
                ],
                'attr' => [
                    'accept' => '.jpg, .jpeg, .png, .bmp',
                ],
 
            ])            
            ->add('Submit', SubmitType::class, [
                'label' => 'Wyślij',
                'attr' => [
                    'class' => 'btn btn-success'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => BusStation::class,
        ]);
    }
}

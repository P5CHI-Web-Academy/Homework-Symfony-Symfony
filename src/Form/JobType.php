<?php

namespace App\Form;

use App\Entity\Job;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints\Url;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class JobType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Full time' => 'full',
                    'Part time' => 'part',
                    'Remote' => 'remote',
                ],
                'expanded' => true,
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('company', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length(['max' => 255]),
                ],
            ])
            ->add('logo', FileType::class, [
                'required' => false,
                'constraints' => [
                    new Image(),
                ],
            ])
            ->add('url', UrlType::class, [
                'required' => false,
                'constraints' => [
                    new Url(),
                ],
            ])
            ->add('position', NumberType::class, [
                'required' => false,
                'constraints' => [
                ],
            ])
            ->add('location', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length(['max' => 255])
                ],
            ])
            ->add('description', TextareaType::class, [
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('howToApply', TextareaType::class, [
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('public', ChoiceType::class, [
                'choices' => [
                    'Yes' => true,
                    'No' => false,
                ],
                'expanded' => true,
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('activated', ChoiceType::class, [
                'choices' => [
                    'Yes' => true,
                    'No' => false,
                ],
                'expanded' => true,
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotBlank(),
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Job::class,
        ]);
    }
}

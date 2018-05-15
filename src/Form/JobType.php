<?php

namespace App\Form;

use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use \Symfony\Component\OptionsResolver\OptionsResolver;
use \Symfony\Component\Validator\Constraints\Image;
use \App\Entity\Job;
use Symfony\Component\Validator\Constraints\NotNull;

class JobType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('position', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length(['max' => 255,]),
                ],
            ])
            ->add('company', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length(['max' => 255,]),
                ],
            ])
            ->add('type', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length(['max' => 255,]),
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
                    new Length(['max' => 255,]),
                ],
            ])
            ->add('email', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length(['max' => 255,]),
                ],
            ])
            ->add('type', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length(['max' => 255,]),
                ],
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('location', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length(['max' => 255,]),
                ],
            ])
            ->add('description', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('howToApply', TextType::class, [
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
                'label' => 'Public',
                'constraints' => [
                    new NotNull(),
                ],
            ])
            ->add('activated', ChoiceType::class, [
                'choices'  => [
                    'Yes' => true,
                    'No' => false,
                ],
                'expanded' => true,
                'constraints' => [
                    new NotNull(),
                ],
            ])
            ->add('expiresAt', DateType::class, [
                'years' => range(date('Y'), date('Y')+2),
                'constraints' => [
                    new GreaterThan(new \DateTime()),
                ],
            ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Job::class,
        ]);
    }
}

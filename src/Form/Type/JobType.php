<?php

namespace App\Form\Type;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;
use App\Entity\Category;
use App\Entity\Job;

class JobType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'type',
                ChoiceType::class,
                [
                    'choices' => [
                        'Full time' => 'full_time',
                        'Part time' => 'part_time',
                    ],
                    'expanded' => true,
                    'constraints' => [
                        new NotBlank(),
                    ],
                ]
            )
            ->add(
                'company',
                TextType::class,
                [
                    'constraints' => [
                        new NotBlank(),
                        new Length(['max' => 255]),
                    ],
                ]
            )
            ->add(
                'logo',
                FileType::class,
                [
                    'required' => false,
                    'constraints' => [
                        new Image(),
                    ],
                ]
            )
            ->add(
                'url',
                UrlType::class,
                [
                    'required' => false,
                    'constraints' => [
                        new Length(['max' => 255]),
                    ],
                ]
            )
            ->add(
                'position',
                TextType::class,
                [
                    'constraints' => [
                        new NotBlank(),
                        new Length(['max' => 255]),
                    ],
                ]
            )
            ->add(
                'location',
                TextType::class,
                [
                    'constraints' => [
                        new NotBlank(),
                        new Length(['max' => 255]),
                    ],
                ]
            )
            ->add(
                'description',
                TextareaType::class,
                [
                    'constraints' => [
                        new NotBlank(),
                    ],
                ]
            )
            ->add(
                'howToApply',
                TextType::class,
                [
                    'constraints' => [
                        new NotBlank(),
                    ],
                ]
            )
            ->add(
                'public',
                CheckboxType::class,
                [
                    'constraints' => [
                        new NotNull(),
                    ],
                ]
            )
            ->add(
                'activated',
                CheckboxType::class,
                [
                    'constraints' => [
                        new NotNull(),
                    ],
                ]
            )
            ->add(
                'email',
                EmailType::class,
                [
                    'constraints' => [
                        new NotBlank(),
                        new Email(),
                    ],
                ]
            )
            ->add(
                'category',
                EntityType::class,
                [
                    'class' => Category::class,
                    'choice_label' => 'name',
                    'constraints' => [
                        new NotBlank(),
                    ],
                ]
            );
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Job::class,
            ]
        );
    }
}

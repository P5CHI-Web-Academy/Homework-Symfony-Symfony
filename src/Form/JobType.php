<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Job;
use App\Form\DataTransformer\StringToFileTransformer;
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

class JobType extends AbstractType
{
    /**
     * @var StringToFileTransformer
     */
    private $transformer;

    /**
     * JobType constructor.
     *
     * @param StringToFileTransformer $transformer
     */
    public function __construct(StringToFileTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', ChoiceType::class, [
                'label' => 'job.type',
                'choices' => [
                    'public' => 'public',
                    'private' => 'private',
                ]
            ])
            ->add('company', TextType::class, [
                'label' => 'job.company',
                'constraints' => [
                    new NotBlank(),
                    new Length(['max' => 255]),
                ],
            ])
            ->add('logo', FileType::class, [
                'label' => 'job.logo',
                'required' => false,
                'constraints' => [
                    new Image()
                ],
            ])
            ->add('url', UrlType::class, [
                'label' => 'job.url',
                'required' => false,
                'constraints' => [
                    new Length(['max' => 255]),
                ],
            ])
            ->add('position', TextType::class, [
                'label' => 'job.position',
                'constraints' => [
                    new NotBlank(),
                    new Length(['max' => 255]),
                ],
            ])
            ->add('location', TextType::class, [
                'label' => 'job.location',
                'constraints' => [
                    new NotBlank(),
                    new Length(['max' => 255]),
                ],
            ])
            ->add('description', TextareaType::class, [
                'label' => 'job.description',
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('howToApply', TextareaType::class, [
                'label' => 'job.howToApply',
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('public', CheckboxType::class, [
                'label' => 'job.public',
                'required' => false,
            ])
            ->add('activated', CheckboxType::class, [
                'label' => 'job.activated',
                'required' => false,
            ])
            ->add('email', EmailType::class, [
                'label' => 'job.email',
                'constraints' => [
                    new NotBlank(),
                    new Length(['max' => 255]),
                    new Email(),
                ],
            ])
            ->add('category', EntityType::class, [
                'label' => 'job.category',
                'class' => Category::class,
                'choice_label' => 'name',
            ])
        ;

        $builder->get('logo')
            ->addModelTransformer($this->transformer);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Job::class,
        ]);
    }
}

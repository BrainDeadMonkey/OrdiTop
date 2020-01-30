<?php

namespace App\Form;


use App\Entity\Article;
use App\Entity\Images;
use App\Form\RubriqueType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('modelArticle')
            ->add('descriptionArticle')
            ->add('prixArticle')
            ->add('stockArticle')
            ->add('idFabricant')
            ->add('idSousRubrique')
            ->add('kartinka', FileType::class, [
                'label' => 'Image (JPEG/PNG/BMP file)',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '4096k',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/bmp',

                        ],
                        'mimeTypesMessage' => 'Need a valid file!'
                    ])
                    ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}

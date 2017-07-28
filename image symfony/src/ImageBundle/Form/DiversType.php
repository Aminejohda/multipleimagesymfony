<?php

namespace ImageBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use ImageBundle\Entity\Product;
use ImageBundle\Form\ProductType;
class DiversType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('Libelle')->add('Description')->add('Email',TextType::class,array('error_bubbling' => true))
        ->add('product', FileType::class, [
                    'error_bubbling' => true,
                    "required" => true,
                    'multiple' => true,
                    "attr" => array("class" => "imgupload"),
                    "label" => "Images à joindre"
                ]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => null
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'imagebundle_divers';
    }


}

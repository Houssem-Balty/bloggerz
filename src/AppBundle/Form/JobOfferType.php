<?php
namespace AppBundle\Form;
use AppBundle\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\LanguageType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Doctrine\ORM\EntityRepository;


class JobOfferType extends AbstractType
{
    /**
    * @param FormBuilderInterface $builder
    * @param array $options
    */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('title',TextType::class)
        ->add('description',TextareaType::class)
        ->add('language',LanguageType::class)
        ->add('blog',EntityType::class,array(
          'class' => 'AppBundle:Blog',
          'multiple' => false,
          'expanded' => false,
          'required' => true,
          'query_builder' => function(EntityRepository $er){
            return $er->createQueryBuilder('u');
            },
            'choice_label' => 'name',
        ))
        ->add('expiryDate',DateType::class)
        ->add('wage',NumberType::class);

    }
    /**
    * @param OptionsResolverInterface $resolver
    */
    public function setDefaultOptions(OptionsResolverInterface $resolver){
      $resolver->setDefaults(array(
        'data_class' => 'AppBundle\Entity\JobOffer',
      ));
    }
}

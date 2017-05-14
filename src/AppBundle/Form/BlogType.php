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
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Form\ImpactMetierType;
use AppBundle\Form\ImpactApplicationType;
use Doctrine\ORM\EntityRepository;
class BlogType extends AbstractType
{
    /**
    * @param FormBuilderInterface $builder
    * @param array $options
    */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('name',TextType::class)
        ->add('link',TextType::class)
        ->add('description',TextType::class)
        ->add('category',EntityType::class,array(
          'class' => 'AppBundle:Category',
          'multiple' => false,
          'expanded' => false,
          'required' => true,
          'query_builder' => function(EntityRepository $er){
            return $er->createQueryBuilder('u');
            },
            'choice_label' => 'name',

        ))
        ->add('facebookPage',EntityType::class,array(
          'class' => 'FacebookBundle:Page',
          'multiple' => false,
          'expanded' => false,
          'required' => false,
          'query_builder' => function(EntityRepository $er){
            return $er->createQueryBuilder('u');
            },
            'choice_label' => 'pageName',

        ));
    }
    /**
    * @param OptionsResolverInterface $resolver
    */
    public function setDefaultOptions(OptionsResolverInterface $resolver){
      $resolver->setDefaults(array(
        'data_class' => 'AppBundle\Entity\Blog',
      ));
    }
}

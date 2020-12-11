<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * Class LoginFormType
 * @package App\Form
 * @author Lucian Petic
 */
class LoginFormType extends AbstractType
{
    private $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, ['label' => $this->trans('email')])
            ->add('password', PasswordType::class, ['label' => $this->trans('password')])
            ->add('remember', CheckBoxType::class, ['label' => $this->trans('remember'), 'required' => false])
            ->add('submit', SubmitType::class, [
                'label' => $this->trans('login'),
                'attr' => ['class' => 'btn btn-primary btn-block']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'csrf_protection' => true,
            'csrf_field_name' => '_csrf_token',
            'csrf_token_id'   => 'authenticate'
        ]);
    }

    private function trans(String $str){
        return $this->translator->trans($str);
    }
}

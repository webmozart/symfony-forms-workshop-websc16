<?php

namespace Contacts\Infrastructure\Web\Form;

use Contacts\Domain\Value\Email;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmailType extends AbstractType implements DataTransformerInterface
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addModelTransformer($this);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'constraints' => new \Symfony\Component\Validator\Constraints\Email(),
        ]);
    }

    public function getParent()
    {
        return \Symfony\Component\Form\Extension\Core\Type\EmailType::class;
    }

    public function getBlockPrefix()
    {
        return 'custom_email';
    }

    public function transform($value)
    {
        if (null === $value) {
            return null;
        }

        if (!$value instanceof Email) {
            throw new TransformationFailedException();
        }

        return $value->toString();
    }

    public function reverseTransform($value)
    {
        if (null === $value) {
            return null;
        }

        if (!is_string($value)) {
            throw new TransformationFailedException();
        }

        return Email::fromString($value);
    }
}

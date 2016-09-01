<?php

namespace Contacts\Infrastructure\Web\Form;

use Contacts\Domain\Organization\Organization;
use Contacts\Domain\Organization\OrganizationId;
use Doctrine\ORM\EntityManager;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrganizationIdType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /** @var EntityManager $em */
        $em = $options['em'];

        $idToEntity = function ($value) use ($em) {
            if (null === $value) {
                return null;
            }

            if (!$value instanceof OrganizationId) {
                throw new TransformationFailedException();
            }

            return $em->find(Organization::class, $value);
        };

        $entityToId = function ($value) {
            if (null === $value) {
                return null;
            }

            if (!$value instanceof Organization) {
                throw new TransformationFailedException();
            }

            return $value->getId();
        };

        $builder->addModelTransformer(
            new CallbackTransformer($idToEntity, $entityToId)
        );
    }

    public function getParent()
    {
        return EntityType::class;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'class' => Organization::class,
            'choice_label' => 'name',
        ]);
    }

}

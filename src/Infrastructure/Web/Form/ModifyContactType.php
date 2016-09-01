<?php

namespace Contacts\Infrastructure\Web\Form;

use Contacts\Application\Contact\ModifyContact;
use Contacts\Domain\Contact\Contact;
use Contacts\Domain\Contact\ContactId;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataMapperInterface;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotNull;

class ModifyContactType extends AbstractType implements DataMapperInterface
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, [
                'required' => true,
                'constraints' => new NotNull()
            ])
            ->add('lastName', TextType::class, [
                'required' => true,
                'constraints' => new NotNull()
            ])
            ->add('dateOfBirth', BirthdayType::class, [
                'required' => false,
                'widget' => 'single_text',
                'format' => 'd/M/y',
            ])
            ->add('phoneNumber', PhoneNumberType::class, [
                'required' => false,
            ])
            ->add('email', EmailType::class, [
                'required' => false,
            ])
            ->add('address', AddressType::class, [
                'required' => false,
            ])
            ->add('organizationId', OrganizationIdType::class, [
                'required' => false,
            ])
            ->add('notes', TextareaType::class, [
                'required' => false,
            ])
            ->add('submit', SubmitType::class)
            ->setDataMapper($this)
        ;
    }

    public function mapDataToForms($data, $forms)
    {
        $forms = iterator_to_array($forms);

        if (!$data instanceof Contact) {
            return;
        }

        $forms['firstName']->setData($data->getFirstName());
        $forms['lastName']->setData($data->getLastName());
        $forms['dateOfBirth']->setData($data->getDateOfBirth());
        $forms['phoneNumber']->setData($data->getPhoneNumber());
        $forms['email']->setData($data->getEmail());
        $forms['address']->setData($data->getAddress());
        $forms['organizationId']->setData($data->getOrganizationId());
        $forms['notes']->setData($data->getNotes());
    }

    public function mapFormsToData($forms, &$data)
    {
        $forms = iterator_to_array($forms);

        $data = new ModifyContact(
            $data->getId(),
            [
                Contact::FIELD_FIRST_NAME => $forms['firstName']->getData(),
                Contact::FIELD_LAST_NAME => $forms['lastName']->getData(),
                Contact::FIELD_DATE_OF_BIRTH => $forms['dateOfBirth']->getData(),
                Contact::FIELD_PHONE_NUMBER => $forms['phoneNumber']->getData(),
                Contact::FIELD_EMAIL => $forms['email']->getData(),
                Contact::FIELD_ADDRESS => $forms['address']->getData(),
                Contact::FIELD_ORGANIZATION_ID => $forms['organizationId']->getData(),
                Contact::FIELD_NOTES => $forms['notes']->getData(),
            ]
        );
    }
}

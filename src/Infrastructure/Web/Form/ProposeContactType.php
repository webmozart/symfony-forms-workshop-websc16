<?php

namespace Contacts\Infrastructure\Web\Form;

use Contacts\Application\Contact\ProposeContact;
use Contacts\Domain\Contact\Contact;
use Contacts\Domain\Contact\ContactId;
use Contacts\Domain\Value\Email;
use Contacts\Domain\Value\PhoneNumber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataMapperInterface;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ProposeContactType extends AbstractType implements DataMapperInterface
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class)
            ->add('lastName', TextType::class)
            ->add('dateOfBirth', BirthdayType::class, [
                'required' => false,
            ])
            ->add('email', EmailType::class, [
                'required' => false,
            ])
            ->add('phoneNumber', TextType::class, [
                'required' => false,
            ])
            ->add('notes', TextareaType::class, [
                'required' => false,
            ])
            ->add('propose', SubmitType::class)
            ->setDataMapper($this)
        ;
    }

    public function mapDataToForms($data, $forms)
    {
    }

    public function mapFormsToData($forms, &$data)
    {
        $forms = iterator_to_array($forms);

        $data = new ProposeContact(
            ContactId::generate(),
            [
                Contact::FIRST_NAME => $forms['firstName']->getData(),
                Contact::LAST_NAME => $forms['lastName']->getData(),
                Contact::DATE_OF_BIRTH => $forms['dateOfBirth']->getData(),
                Contact::EMAIL => Email::fromString($forms['email']->getData()),
                Contact::PHONE_NUMBER => PhoneNumber::fromString($forms['phoneNumber']->getData()),
                Contact::NOTES => $forms['notes']->getData(),
            ]
        );
    }
}

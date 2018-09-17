<?php

namespace DevimTeam\GetResponseClient\ResourceDescription;

use DevimTeam\GetResponseClient\AbstractRESTResource;
use DevimTeam\GetResponseClient\Model\Contact;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ContactsResource
 * @package DevimTeam\GetResponseClient\Request
 *
 * @method  setCustomFields(array $options)
 * @method  getWithoutStatus()
 */
class ContactsResource extends AbstractRESTResource
{
    public function getUriPrefix(): string
    {
        return '/contacts';
    }

    public function getObjectTypes(string $actionName): array
    {
        return [
            Contact::class,
        ];
    }

    public function configureOptions(string $actionName, OptionsResolver $resolver): void
    {
        if ('setCustomFields' === $actionName) {
            $resolver
                ->setRequired(self::OPTION_IDENTIFIER_NAME)
                ->setAllowedTypes(self::OPTION_IDENTIFIER_NAME, $this->getIdentifierTypes())
                ->setRequired(self::OPTION_OBJECT_NAME)
                ->setAllowedTypes(self::OPTION_OBJECT_NAME, $this->getObjectTypes($actionName));

            return;
        }
        if ('getWithoutStatus' === $actionName) {
            return;
        }

        parent::configureOptions($actionName, $resolver);
    }

    public function getUri(string $actionName, array $options = []): ?string
    {
        if ('setCustomFields' === $actionName) {
            return sprintf(
                '%s/%s/custom-fields',
                $this->getUriPrefix(),
                $options[self::OPTION_IDENTIFIER_NAME]
            );
        }

        if ('getWithoutStatus' === $actionName) {
            return '/search-contacts';
        }

        return parent::getUri($actionName, $options);
    }

    public function getHttpMethod(string $actionName, array $options = []): ?string
    {
        if (\in_array($actionName, ['setCustomFields', 'getWithoutStatus'], true)) {
            return self::HTTP_METHOD_POST;
        }

        return parent::getHttpMethod($actionName);
    }

    public function getResponseModelType(string $actionName)
    {
        if ('list' === $actionName) {
            return sprintf('array<%s>', Contact::class);
        }
        return Contact::class;
    }

    public function getRequestParameters(string $actionName, array $options = [])
    {
        if ($actionName === 'getWithoutStatus') {
           return [
               'name' => 'contacts_without_status',
               'subscribersType' => [
                   'subscribed'
               ],
               'sectionLogicOperator' => 'or',
               'section' => [
                   'logicOperator' => 'or',
                   'subscriberCycle' => [
                       'receiving_autoresponder',
                       'not_receiving_autoresponder'
                   ],
                   'subscriptionDate' => 'all_time',
                   'conditions' => [
                       [
                           'conditionType' => 'custom',
                           'operatorType' => 'string_operator',
                           'operator' => 'not_assigned',
                           'scope' => $options[0] ?? ''
                       ]
                   ]
               ]
           ];
        }

        return parent::getRequestParameters($actionName, $options);
    }
}
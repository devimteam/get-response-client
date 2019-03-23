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
 * @method  getWithoutCustomField(string $fieldScope, string $comaignId, int $cnt)
 * @method  getAll(string $campaignId, int $page, int $limit)
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
        } else {
            parent::configureOptions($actionName, $resolver);
        }
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

        if ('getWithoutCustomField' === $actionName) {
            $cnt = $options[2] ?? 200;
            return "/search-contacts/contacts?sort[createdOn]=asc&page=1&perPage={$cnt}";
        }

        if ('getAll' === $actionName) {
            $campaignId = $options[0];
            $page = $options[1];
            $cnt = $options[2];
            return '/contacts?query[campaignId]=' . $campaignId . '&sort[createdOn]=asc&page=' . $page . '&perPage=' . $cnt;
        }

        return parent::getUri($actionName, $options);
    }

    public function getHttpMethod(string $actionName, array $options = []): ?string
    {
        if (\in_array($actionName, ['setCustomFields', 'getWithoutCustomField'], true)) {
            return self::HTTP_METHOD_POST;
        }

        if (\in_array($actionName, ['getAll'], true)) {
            return self::HTTP_METHOD_GET;
        }

        return parent::getHttpMethod($actionName);
    }

    public function getResponseModelType(string $actionName)
    {
        if (\in_array($actionName, ['list', 'getWithoutCustomField'])) {
            return sprintf('array<%s>', Contact::class);
        }

        return Contact::class;
    }

    public function getRequestParameters(string $actionName, array $options = [])
    {
        if ($actionName === 'getWithoutCustomField') {
            return [
                'subscribersType'      => [
                    'subscribed'
                ],
                'sectionLogicOperator' => 'or',
                'section'              => [
                    'campaignIdsList'  => [
                        $options[1] ?? ''
                    ],
                    'logicOperator'    => 'and',
                    'subscriberCycle'  => [
                        'receiving_autoresponder',
                        'not_receiving_autoresponder'
                    ],
                    'subscriptionDate' => 'all_time',
                    'conditions'       => [
                        [
                            'conditionType' => 'custom',
                            'operatorType'  => 'string_operator',
                            'operator'      => 'not_assigned',
                            'scope'         => $options[0] ?? ''
                        ]
                    ]
                ]
            ];
        }

        if ($actionName === 'getAll') {
            return null;
        }

        return parent::getRequestParameters($actionName, $options);
    }
}
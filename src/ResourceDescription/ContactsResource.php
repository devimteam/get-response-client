<?php

namespace DevimTeam\GetResponseClient\ResourceDescription;

use DevimTeam\GetResponseClient\AbstractResource;
use DevimTeam\GetResponseClient\Model\Contacts\CustomFieldsModel;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ContactsResource
 * @package DevimTeam\GetResponseClient\Request
 *
 * @method  setCustomFields($id)
 */
class ContactsResource extends AbstractResource
{
    const BASE_URI = '/contacts';

    public function configureOptions($actionName, OptionsResolver $resolver)
    {
        if ('setCustomFields' == $actionName) {
            $resolver
                ->setAllowedTypes('contactId', 'string')
                ->setAllowedTypes('fields', 'array')
                ->setRequired([
                    'contactId',
                    'fields',
                ]);
        }
    }

    public function getURL($actionName, $options = [])
    {
        $pr = parent::getURL($actionName, $options);
        if ($pr) {
            return self::BASE_URI . $pr;
        }
        if ('setCustomFields' == $actionName) {
            return sprintf(
                '%s/%s/custom-fields',
                self::BASE_URI,
                $options['contactId']
            );
        }
        return null;
    }

    public function getHttpMethod($actionName)
    {
        $pm = parent::getHttpMethod($actionName);
        if ($pm) {
            return $pm;
        }
        if ('setCustomFields' == $actionName) {
            return self::HTTP_METHOD_POST;
        }

        return self::HTTP_METHOD_GET;
    }

    public function getRequestParameters($actionName, $options = [])
    {
    }

    public function getResponseModelType($actionName)
    {
        if ('setCustomFields' == $actionName) {
            return CustomFieldsModel::class;
        }
    }
}
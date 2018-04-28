<?php

namespace DevimTeam\GetResponseClient\Service;

use DevimTeam\GetResponseClient\AbstractRESTResource;
use DevimTeam\GetResponseClient\Client;
use DevimTeam\GetResponseClient\Model\Contact;
use DevimTeam\GetResponseClient\Model\Error\ApiException;
use DevimTeam\GetResponseClient\ResourceDescription\ContactsResource;

/**
 * Facade for Contacts resource
 *
 * Class ContactService
 * @package DevimTeam\GetResponseClient\ResourceDescription
 *
 * @method Contact[] list()
 * @method Contact get(string $id)
 * @method bool create(Contact $contact)
 * @method Contact update(Contact $contact)
 * @method void delete(string $id)
 * @method Contact setCustomFields(Contact $contacts)
 *
 * @method Contact getByEmail(string $email)
 */
class ContactsService
{
    /** @var Client */
    private $client;

    /** @var ContactsResource */
    private $resource;

    /**
     * ContactService constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->resource = new ContactsResource();
    }

    /**
     * @param string $email
     * @return array
     */
    private function __getByEmail(string $email)
    {
        /** @var string $method */
        /** @var string $url */
        /** @var mixed $parameters */
        /** @var string $responseModelType */
        list($method, $url, $parameters, $responseModelType) = $this->resource->list();
        $parameters['query'] = ['email' => $email];
        return [$method, $url, $parameters, $responseModelType];
    }

    /**
     * @param string $name
     * @param array $arguments
     * @return mixed|null
     * @throws \DevimTeam\GetResponseClient\Model\Error\ApiException
     * @throws \DevimTeam\GetResponseClient\Model\Error\ApiException2
     */
    public function __call($name, $arguments)
    {
        for ($i = 0; $i < count($arguments); $i++) {
            if (!($arguments[$i] instanceof Contact)) {
                continue;
            }

            /** @var Contact $contact */
            $contact = $arguments[$i];

            // decorate custom fields with their ids
            $fieldsService = new CustomFieldsService($this->client);

            $newFields = [];
            foreach ($contact->getCustomFieldValues() as $field) {
                if (empty($field->getCustomFieldId()) && !empty($field->getName())) {
                    $newField = $fieldsService->getByName($field->getName());
                    if (null == $newField) {
                        $newFields[] = $field;
                        continue;
                    }
                    $newField->setValues($field->getValues());
                    $newFields[] = $newField;
                } else {
                    throw new \Exception(sprintf('Can not find ID for property %s',
                            $field->getName())
                    );
                }
            }
            $contact->setCustomFieldValues($newFields);
            $arguments[$i] = $contact;
        }


        if ('getByEmail' == $name) {
            $build = $this->__getByEmail($arguments[0]);
        } elseif (in_array($name, [
            'setCustomFields',
            'update',
        ])) {
            $obj = $arguments[0];
            if (!($obj instanceof Contact))
                throw new \Exception('Unexpected type: ' . gettype($obj));
            $build = $this->resource->setCustomFields([
                AbstractRESTResource::OPTION_IDENTIFIER_NAME => $obj->getContactId(),
                AbstractRESTResource::OPTION_OBJECT_NAME => $obj,
            ]);
        } else {
            $build = call_user_func_array(
                array($this->resource, $name),
                $arguments
            );
        }

        try {
            $result = $this->client->run($build);
        } catch (ApiException $exception) {
            if ('create' == $name
                && false !== strpos($exception->getMessage(), 'already added')
            ) {
                return false;
            }
            throw $exception;
        }

        if (in_array($name, [
//            'setCustomFields',
//            'get',
            'getByEmail',
        ])) {
            $result = isset($result[0]) ? $result[0] : null;
        }

        return $result;
    }
}
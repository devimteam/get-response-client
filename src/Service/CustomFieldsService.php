<?php

namespace DevimTeam\GetResponseClient\Service;

use DevimTeam\GetResponseClient\Client;
use DevimTeam\GetResponseClient\Model\CustomField;
use DevimTeam\GetResponseClient\Model\Error\ApiException;
use DevimTeam\GetResponseClient\ResourceDescription\CustomFieldsResource;

/**
 * Class CustomFieldsService
 * @package DevimTeam\GetResponseClient\Service
 *
 * @method CustomField[] list()
 * @method CustomField get(string $id)
 * @method bool create(CustomField $customField)
 * @method CustomField update(CustomField $customField)
 * @method void delete(string $id)
 *
 * @method CustomField getByName(string $name)
 */
class CustomFieldsService
{
    /** @var Client */
    private $client;

    /** @var CustomFieldsResource */
    private $resource;

    /** @var array|CustomField[] */
    private $fieldsCache = [];

    /**
     * ContactService constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->resource = new CustomFieldsResource();
    }

    /**
     * @param string $name
     * @return array
     */
    private function __getByName(string $name)
    {
        /** @var string $method */
        /** @var string $url */
        /** @var mixed $parameters */
        /** @var string $responseModelType */
        list($method, $url, $parameters, $responseModelType) = $this->resource->list();
        $parameters['query'] = ['name' => $name];
        return [$method, $url, $parameters, $responseModelType];
    }

    public function __call($name, $arguments)
    {
        if ('getByName' == $name && isset($this->fieldsCache[$arguments[0]])) {
            return $this->fieldsCache[$arguments[0]];
        }

        if ('getByName' == $name) {
            $build = $this->__getByName($arguments[0]);
        } elseif ('update' == $name) {
            $obj = $arguments[0];
            if (!($obj instanceof CustomField))
                throw new \Exception('Unexpected type: ' . gettype($obj));
            $build = $this->resource->setCustomFields([
                AbstractRESTResource::OPTION_IDENTIFIER_NAME => $obj->getCustomFieldId(),
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
//            'get',
            'getByName',
        ])) {
            $result = isset($result[0]) ? $result[0] : null;
        }

        if ('getByName' == $name && null != $result) {
            $this->fieldsCache[$arguments[0]] = $result;
        }

        return $result;
    }

    /**
     * @return array|string[]
     */
    public function getAllNames()
    {
        $all = $this->list();
        $res = [];
        foreach ($all as $field) {
            $res[] = $field->getName();
        }
        return $res;
    }
}
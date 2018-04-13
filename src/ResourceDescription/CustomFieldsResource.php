<?php

namespace DevimTeam\GetResponseClient\ResourceDescription;

use DevimTeam\GetResponseClient\AbstractRESTResource;
use DevimTeam\GetResponseClient\Model\CustomField;

/**
 * Class CustomFieldsResource
 * @package DevimTeam\GetResponseClient\ResourceDescription
 */
class CustomFieldsResource extends AbstractRESTResource
{
    /**
     * @return string
     */
    public function getUriPrefix(): string
    {
        return '/custom-fields';
    }

    /**
     * @param string $actionName
     * @return array
     */
    public function getObjectTypes(string $actionName): array
    {
        return [
            CustomField::class,
        ];
    }

    /**
     * @param string $actionName
     * @return string
     */
    public function getResponseModelType(string $actionName)
    {
        if ('list' == $actionName) {
            return sprintf('array<%s>', CustomField::class);
        }
        return CustomField::class;
    }

    /**
     * @param string $name
     * @return array
     */
    public function getByName(string $name)
    {
        /** @var string $method */
        /** @var string $url */
        /** @var mixed $parameters */
        /** @var string $responseModelType */
        list($method, $url, $parameters, $responseModelType) = $this->list();;
        $parameters['query'] = ['name' => $name];
        return [$method, $url, $parameters, $responseModelType];
    }
}
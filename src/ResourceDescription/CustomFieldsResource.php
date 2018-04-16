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
}
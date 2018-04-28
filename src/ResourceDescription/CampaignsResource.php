<?php

namespace DevimTeam\GetResponseClient\ResourceDescription;

use DevimTeam\GetResponseClient\AbstractRESTResource;
use DevimTeam\GetResponseClient\Model\Campaign;

class CampaignsResource extends AbstractRESTResource
{
    public function getUriPrefix(): string
    {
        return '/campaigns';
    }

    public function getObjectTypes(string $actionName): array
    {
        return [
            Campaign::class,
        ];
    }

    public function getResponseModelType(string $actionName)
    {
        if ('list' == $actionName) {
            return sprintf('array<%s>', Campaign::class);
        }
        return Campaign::class;
    }
}
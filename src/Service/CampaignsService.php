<?php

namespace DevimTeam\GetResponseClient\Service;

use DevimTeam\GetResponseClient\Client;
use DevimTeam\GetResponseClient\Model\Campaign;
use DevimTeam\GetResponseClient\Model\Error\ApiException;
use DevimTeam\GetResponseClient\ResourceDescription\CampaignsResource;

/**
 * Class CampaignsService
 * @package DevimTeam\GetResponseClient\Service
 *
 * @method Campaign[] list()
 * @method Campaign get(string $id)
 */
class CampaignsService
{
    /** @var Client */
    private $client;

    /** @var CampaignsResource */
    private $resource;

    /**
     * ContactService constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->resource = new CampaignsResource();
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
        $build = call_user_func_array(
            array($this->resource, $name),
            $arguments
        );

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

        return $result;
    }
}
<?php

namespace DevimTeam\GetResponseClient\Service;

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
 * @method Contact[] list($options = [])
 * @method Contact get($options = [])
 * @method bool create($options = [])
 * @method Contact update($options = [])
 * @method void delete($options = [])
 * @method setCustomFields($options)
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
    public function __getByEmail(string $email)
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
     * Cradle of miracles and workarounds
     *
     * @param string $name
     * @param array $arguments
     * @return mixed|null
     * @throws \DevimTeam\GetResponseClient\Model\Error\ApiException
     * @throws \DevimTeam\GetResponseClient\Model\Error\ApiException2
     */
    public function __call($name, $arguments)
    {
//        print_r($arguments); die;

        if ('getByEmail' == $name) {
            $build = $this->__getByEmail($arguments[0]);
        } else {
            $build = $this->resource->$name($arguments[0]);
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
            'setCustomFields',
            'get',
            'getByEmail',
        ])) {
            $result = isset($result[0]) ? $result[0] : null;
        }

        return $result;
    }
}
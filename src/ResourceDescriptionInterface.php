<?php

namespace DevimTeam\GetResponseClient;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Interface ResourceDescriptionInterface
 * @package DevimTeam\GetResponseClient
 *
 * @method list()
 * @method get($id)
 * @method create($object)
 * @method update($object)
 * @method delete($id)
 */
interface ResourceDescriptionInterface
{
    const HTTP_METHOD_GET = 'GET';
    const HTTP_METHOD_POST = 'POST';
    const HTTP_METHOD_DELETE = 'DELETE';

    const CONTENT_TYPE = 'application/json';

    /**
     * @param string $actionName
     * @param OptionsResolver $resolver
     * @return void
     */
    public function configureOptions(string $actionName, OptionsResolver $resolver): void;

    /**
     * @param string $actionName
     * @param array $options
     * @return null|string
     */
    public function getUri(string $actionName, array $options = []);

    /**
     * @param string $actionName
     * @return null|string
     */
    public function getHttpMethod(string $actionName, array $options = []);

    /**
     * @param string $actionName
     * @param array $options
     * @return array
     */
    public function getRequestParameters(string $actionName, array $options = []);

    /**
     * @param string $actionName
     * @return string
     */
    public function getResponseModelType(string $actionName);
}
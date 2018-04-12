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
    public function configureOptions($actionName, OptionsResolver $resolver);

    /**
     * @param string $actionName
     * @param array $options
     * @return null|string
     */
    public function getURL($actionName, $options = []);

    /**
     * @param string $actionName
     * @return null|string
     */
    public function getHttpMethod($actionName);

    /**
     * @param string $actionName
     * @param array $options
     * @return void|array
     */
    public function getRequestParameters($actionName, $options = []);

    /**
     * @param string $actionName
     * @return string
     */
    public function getResponseModelType($actionName);
}
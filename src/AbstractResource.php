<?php

namespace DevimTeam\GetResponseClient;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @method  list($options = [])
 * @method  get($options = [])
 * @method  create($options = [])
 * @method  update($options = [])
 * @method  delete($options = [])
 */
abstract class AbstractResource implements ResourceDescriptionInterface
{
    /**
     * @param $actionName
     * @param OptionsResolver $resolver
     * @return void
     */
    public function configureOptions($actionName, OptionsResolver $resolver)
    {
        if (in_array($actionName, ['get', 'delete'])) {
            $resolver->setRequired('id')
                ->setAllowedTypes('id', ['string', 'integer']);
        }
        if (in_array($actionName, ['create', 'update'])) {
            $resolver->setRequired('object')
                ->setAllowedTypes('object', 'object');
        }
    }

    /**
     * @param array $options
     * @return null|string
     */
    public function getURL($actionName, $options = [])
    {
        if (in_array($actionName, ['list', 'create',])) {
            return '';
        }
        if (in_array($actionName, ['get', 'update', 'delete',])) {
            return '/{contactId}';
        }
        return null;
    }

    /**
     * @return null|string
     */
    public function getHttpMethod($actionName)
    {
        if (in_array($actionName, ['list', 'get',])) {
            return self::HTTP_METHOD_GET;
        }
        if (in_array($actionName, ['create',])) {
            return self::HTTP_METHOD_POST;
        }
        if (in_array($actionName, ['delete',])) {
            return self::HTTP_METHOD_DELETE;
        }

        return null;
    }

    /**
     * @return void|array
     */
    public function getRequestParameters($actionName)
    {
        // TODO: Implement getRequestParameters() method.
    }

    public function __call($name, $arguments)
    {
        return [
            $this->getHttpMethod($name),
            $this->getURL($name),
            $this->getRequestParameters($name),
        ];
    }
}
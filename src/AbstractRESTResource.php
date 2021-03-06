<?php

namespace DevimTeam\GetResponseClient;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @method  list($options = [])
 * @method  get(mixed $id)
 * @method  create(object $object)
 * @method  update(mixed $id, object $object)
 * @method  delete(mixed $id)
 */
abstract class AbstractRESTResource implements ResourceDescriptionInterface
{
    const OPTION_IDENTIFIER_NAME = '__id';
    const OPTION_OBJECT_NAME = '__object';

    /**
     * @return string
     */
    public abstract function getUriPrefix(): string;

    /**
     * @param string $actionName
     * @return array
     */
    public abstract function getObjectTypes(string $actionName): array;

    /**
     * @return array
     */
    public function getIdentifierTypes(): array
    {
        return ['string', 'integer'];
    }

    /**
     * @param $actionName
     * @param OptionsResolver $resolver
     * @return void
     */
    public function configureOptions(string $actionName, OptionsResolver $resolver): void
    {
        if (in_array($actionName, ['get', 'delete'])) {
            $resolver->setRequired(self::OPTION_IDENTIFIER_NAME)
                ->setAllowedTypes(self::OPTION_IDENTIFIER_NAME, $this->getIdentifierTypes());
        }
        if (in_array($actionName, ['create', 'update'])) {
            $resolver->setRequired(self::OPTION_OBJECT_NAME)
                ->setAllowedTypes(self::OPTION_OBJECT_NAME, $this->getObjectTypes($actionName));
        }
    }

    /**
     * @param string $actionName
     * @param array $options
     * @return null|string
     */
    public function getUri(string $actionName, array $options = []): ?string
    {
        if (in_array($actionName, ['list', 'create',])) {
            return $this->getUriPrefix();
        }
        if (in_array($actionName, ['get', 'update', 'delete',])) {
            return $this->getUriPrefix() . '/' . $options[self::OPTION_IDENTIFIER_NAME];
        }
        return null;
    }

    /**
     * @param string $actionName
     * @param array $options
     * @return null|string
     */
    public function getHttpMethod(string $actionName, array $options = []): ?string
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
     * @param string $actionName
     * @param array $options
     * @return mixed
     */
    public function getRequestParameters(string $actionName, array $options = [])
    {
        if (in_array($actionName, ['list', 'get', 'delete'])) {
            return null;
        }

        return $options[self::OPTION_OBJECT_NAME];
    }

    public function __call($name, $arguments)
    {
//        print_r($arguments);die;

        if (count($arguments) == 1 && is_array($arguments[0])) {
            $options = $arguments[0];
        } elseif (2 == count($arguments)
            && false == is_object($arguments[0])
            && true == is_object($arguments[1])
        ) {
            $options = [
                self::OPTION_IDENTIFIER_NAME => $arguments[0],
                self::OPTION_OBJECT_NAME => $arguments[1],
            ];
        } elseif (1 == count($arguments) && is_object($arguments[0])) {
            $options = [self::OPTION_OBJECT_NAME => $arguments[0]];
        } elseif (1 == count($arguments) && false == is_object($arguments[0])) {
            $options = [self::OPTION_IDENTIFIER_NAME => $arguments[0]];
        } elseif (3 === \count($arguments)
            && \is_string($arguments[0])
            && \is_string($arguments[1])
            && \is_int($arguments[2])) {
            $options = $arguments;
        } elseif ('getAll' === $name) {
            $options = $arguments;
        } else {
            $options = [];
        }

//        $resolver = new OptionsResolver();
//        $this->configureOptions($name, $resolver);
//        $options = $resolver->resolve($options);

        return [
            $this->getHttpMethod($name, $options),
            $this->getUri($name, $options),
            $this->getRequestParameters($name, $options),
            $this->getResponseModelType($name)
        ];
    }
}
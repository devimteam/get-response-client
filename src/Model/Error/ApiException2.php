<?php

namespace DevimTeam\GetResponseClient\Model\Error;

use JMS\Serializer\Annotation as Serializer;

class ApiException2 extends ApiException
{
    /**
     * @var array
     *
     * @Serializer\Type("array<DevimTeam\GetResponseClient\Model\Error\Context>")
     */
    protected $context = [];

    /**
     * @return array|Context[]
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * @param array|Context[] $context
     * @return ApiException
     */
    public function setContext($context)
    {
        $this->context = $context;
        return $this;
    }

    public function getContextAsString(): string
    {
        return implode('; ', $this->getContext());
    }
}
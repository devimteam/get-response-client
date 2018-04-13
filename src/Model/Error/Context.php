<?php

namespace DevimTeam\GetResponseClient\Model\Error;

use JMS\Serializer\Annotation as Serializer;

class Context
{
    /**
     * @var string
     *
     * @Serializer\Type("string")
     */
    private $validationType;

    /**
     * @var array
     *
     * @Serializer\Type("array<string>")
     */
    private $fieldName;

    /**
     * @var string
     *
     * @Serializer\Type("string")
     */
    private $originalValue;

    /**
     * @var string
     *
     * @Serializer\Type("string")
     */
    private $errorDescription;

    /**
     * @return string
     */
    public function getValidationType(): string
    {
        return $this->validationType;
    }

    /**
     * @param string $validationType
     * @return Context
     */
    public function setValidationType(string $validationType): Context
    {
        $this->validationType = $validationType;
        return $this;
    }

    /**
     * @return array
     */
    public function getFieldName(): ?array
    {
        return $this->fieldName;
    }

    /**
     * @param array $fieldName
     * @return Context
     */
    public function setFieldName(array $fieldName): Context
    {
        $this->fieldName = $fieldName;
        return $this;
    }

    /**
     * @return string
     */
    public function getOriginalValue(): string
    {
        return $this->originalValue;
    }

    /**
     * @param string $originalValue
     * @return Context
     */
    public function setOriginalValue(string $originalValue): Context
    {
        $this->originalValue = $originalValue;
        return $this;
    }

    /**
     * @return string
     */
    public function getErrorDescription(): ?string
    {
        return $this->errorDescription;
    }

    /**
     * @param string $errorDescription
     * @return Context
     */
    public function setErrorDescription(string $errorDescription): Context
    {
        $this->errorDescription = $errorDescription;
        return $this;
    }
}
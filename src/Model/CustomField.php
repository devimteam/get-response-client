<?php

namespace DevimTeam\GetResponseClient\Model;

use JMS\Serializer\Annotation as Serializer;

class CustomField
{
    /**
     * @var null|string
     *
     * @Serializer\Type("string")
     */
    private $customFieldId;

    /**
     * @var string
     *
     * @Serializer\Type("string")
     */
    private $href;

    /**
     * @var string
     *
     * @Serializer\Type("string")
     */
    private $name;

    /**
     * @var string
     *
     * @Serializer\Type("string")
     */
    private $fieldType;

    /**
     * @var string
     *
     * @Serializer\Type("string")
     */
    private $valueType;

    /**
     * @var string
     *
     * @Serializer\Type("string")
     */
    private $type;

    /**
     * @var string
     *
     * @Serializer\Type("string")
     */
    private $hidden;

    /**
     * @var array
     *
     * @Serializer\Type("array<string>")
     */
    private $values = [];

    /**
     * @return null|string
     */
    public function getCustomFieldId(): ?string
    {
        return $this->customFieldId;
    }

    /**
     * @param null|string $customFieldId
     * @return CustomField
     */
    public function setCustomFieldId(?string $customFieldId): CustomField
    {
        $this->customFieldId = $customFieldId;
        return $this;
    }

    /**
     * @return string
     */
    public function getHref(): string
    {
        return $this->href;
    }

    /**
     * @param string $href
     * @return CustomField
     */
    public function setHref(string $href): CustomField
    {
        $this->href = $href;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return CustomField
     */
    public function setName(string $name): CustomField
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getFieldType(): string
    {
        return $this->fieldType;
    }

    /**
     * @param string $fieldType
     * @return CustomField
     */
    public function setFieldType(string $fieldType): CustomField
    {
        $this->fieldType = $fieldType;
        return $this;
    }

    /**
     * @return string
     */
    public function getValueType(): string
    {
        return $this->valueType;
    }

    /**
     * @param string $valueType
     * @return CustomField
     */
    public function setValueType(string $valueType): CustomField
    {
        $this->valueType = $valueType;
        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return CustomField
     */
    public function setType(string $type): CustomField
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getHidden(): string
    {
        return $this->hidden;
    }

    /**
     * @param string $hidden
     * @return CustomField
     */
    public function setHidden(string $hidden): CustomField
    {
        $this->hidden = $hidden;
        return $this;
    }

    /**
     * @return array
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * @param array $values
     * @return CustomField
     */
    public function setValues($values): CustomField
    {
        $this->values = $values;
        return $this;
    }
}
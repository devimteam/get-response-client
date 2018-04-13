<?php

namespace DevimTeam\GetResponseClient\Model;

class CustomField
{
    /** @var null|string */
    private $customFieldId;

    /** @var array */
    private $value = [];

    /**
     * CustomField constructor.
     * @param $customFieldId
     * @param array $value
     */
    public function __construct($customFieldId = null, array $value = [])
    {
        $this->customFieldId = $customFieldId;
        $this->value = $value;
    }

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
     * @return array
     */
    public function getValue(): array
    {
        return $this->value;
    }

    /**
     * @param array $value
     * @return CustomField
     */
    public function setValue(array $value): CustomField
    {
        $this->value = $value;
        return $this;
    }
}
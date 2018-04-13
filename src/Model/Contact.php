<?php

namespace DevimTeam\GetResponseClient\Model;

use JMS\Serializer\Annotation as Serializer;

class Contact
{
    /** @var string */
    private $name;

    /** @var string */
    private $email;

    /** @var int */
    private $dayOfCycle;

    /** @var null */
    private $campaign;

    /**
     * @var array|Tag[]
     *
     * @Serializer\Type("array<DevimTeam\GetResponseClient\Model\Tag>")
     */
    private $tags;

    /** @var int */
    private $scoring;

    /**
     * @var array|CustomField[]
     *
     * @Serializer\Type("array<DevimTeam\GetResponseClient\Model\CustomField>")
     */
    private $customFieldValues;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Contact
     */
    public function setName(string $name): Contact
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Contact
     */
    public function setEmail(string $email): Contact
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return int
     */
    public function getDayOfCycle(): int
    {
        return $this->dayOfCycle;
    }

    /**
     * @param int $dayOfCycle
     * @return Contact
     */
    public function setDayOfCycle(int $dayOfCycle): Contact
    {
        $this->dayOfCycle = $dayOfCycle;
        return $this;
    }

    /**
     * @return null
     */
    public function getCampaign()
    {
        return $this->campaign;
    }

    /**
     * @param null $campaign
     * @return Contact
     */
    public function setCampaign($campaign)
    {
        $this->campaign = $campaign;
        return $this;
    }

    /**
     * @return array|Tag[]
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param array|Tag[] $tags
     * @return Contact
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
        return $this;
    }

    /**
     * @return int
     */
    public function getScoring(): int
    {
        return $this->scoring;
    }

    /**
     * @param int $scoring
     * @return Contact
     */
    public function setScoring(int $scoring): Contact
    {
        $this->scoring = $scoring;
        return $this;
    }

    /**
     * @return array|CustomField[]
     */
    public function getCustomFieldValues()
    {
        return $this->customFieldValues;
    }

    /**
     * @param array|CustomField[] $customFieldValues
     * @return Contact
     */
    public function setCustomFieldValues($customFieldValues)
    {
        $this->customFieldValues = $customFieldValues;
        return $this;
    }
}
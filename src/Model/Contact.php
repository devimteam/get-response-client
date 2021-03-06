<?php

namespace DevimTeam\GetResponseClient\Model;

use JMS\Serializer\Annotation as Serializer;

class Contact
{
    /**
     * @var null|string
     *
     * @Serializer\Type("string")
     */
    private $contactId;

    /**
     * @var null|string
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
    private $name_first;

    /**
     * @var string
     *
     * @Serializer\Type("string")
     */
    private $name_middle;

    /**
     * @var string
     *
     * @Serializer\Type("string")
     */
    private $email;

    /**
     * @var null|string
     *
     * @Serializer\Type("string")
     */
    private $note;

    /**
     * @var null|string
     *
     * @Serializer\Type("string")
     */
    private $origin;

    /**
     * @var string
     *
     * @Serializer\Type("string")
     */
    private $changedOn;

    /**
     * @var string
     *
     * @Serializer\Type("string")
     */
    private $timeZone;

    /**
     * @var string
     *
     * @Serializer\Type("string")
     */
    private $activities;

    /**
     * @var int
     *
     * @Serializer\Type("int")
     */
    private $dayOfCycle;

    /**
     * @var Campaign
     *
     * @Serializer\Type("DevimTeam\GetResponseClient\Model\Campaign")
     */
    private $campaign;

    /**
     * @var array|Tag[]
     *
     * @Serializer\Type("array<DevimTeam\GetResponseClient\Model\Tag>")
     */
    private $tags = [];

    /**
     * @var int
     *
     * @Serializer\Type("int")
     * @Serializer\Exclude()
     */
    private $scoring = 0;

    /**
     * @var array|CustomField[]
     *
     * @Serializer\Type("array<DevimTeam\GetResponseClient\Model\CustomField>")
     */
    private $customFieldValues = [];

    /**
     * @var null|string
     *
     * @Serializer\Type("string")
     */
    private $ipAddress;

    /**
     * @var string
     *
     * @Serializer\Type("string")
     */
    private $createdOn;

    /**
     * @return null|string
     */
    public function getContactId(): ?string
    {
        return $this->contactId;
    }

    /**
     * @param null|string $contactId
     * @return Contact
     */
    public function setContactId(?string $contactId): Contact
    {
        $this->contactId = $contactId;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getHref(): ?string
    {
        return $this->href;
    }

    /**
     * @param null|string $href
     * @return Contact
     */
    public function setHref(?string $href): Contact
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
     * @return null|string
     */
    public function getNote(): ?string
    {
        return $this->note;
    }

    /**
     * @param null|string $note
     * @return Contact
     */
    public function setNote(?string $note): Contact
    {
        $this->note = $note;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getOrigin(): ?string
    {
        return $this->origin;
    }

    /**
     * @param null|string $origin
     * @return Contact
     */
    public function setOrigin(?string $origin): Contact
    {
        $this->origin = $origin;
        return $this;
    }

    /**
     * @return string
     */
    public function getChangedOn(): string
    {
        return $this->changedOn;
    }

    /**
     * @param string $changedOn
     * @return Contact
     */
    public function setChangedOn(string $changedOn): Contact
    {
        $this->changedOn = $changedOn;
        return $this;
    }

    /**
     * @return string
     */
    public function getTimeZone(): string
    {
        return $this->timeZone;
    }

    /**
     * @param string $timeZone
     * @return Contact
     */
    public function setTimeZone(string $timeZone): Contact
    {
        $this->timeZone = $timeZone;
        return $this;
    }

    /**
     * @return string
     */
    public function getActivities(): string
    {
        return $this->activities;
    }

    /**
     * @param string $activities
     * @return Contact
     */
    public function setActivities(string $activities): Contact
    {
        $this->activities = $activities;
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
     * @return Campaign
     */
    public function getCampaign(): Campaign
    {
        return $this->campaign;
    }

    /**
     * @param Campaign $campaign
     * @return Contact
     */
    public function setCampaign(Campaign $campaign): Contact
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

    /**
     * @param CustomField $customFieldValue
     * @return Contact
     */
    public function addCustomFieldValue(CustomField $customFieldValue)
    {
        $this->customFieldValues[] = $customFieldValue;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getIpAddress(): ?string
    {
        return $this->ipAddress;
    }

    /**
     * @param null|string $ipAddress
     * @return Contact
     */
    public function setIpAddress(?string $ipAddress): Contact
    {
        $this->ipAddress = $ipAddress;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreatedOn(): string
    {
        return $this->createdOn;
    }

    /**
     * @param string $createdOn
     * @return Contact
     */
    public function setCreatedOn(string $createdOn): Contact
    {
        $this->createdOn = $createdOn;
        return $this;
    }

    /**
     * @return string
     */
    public function getNameFirst(): string
    {
        return $this->name_first;
    }

    /**
     * @param string $nameFirst
     * @return Contact
     */
    public function setNameFirst(string $nameFirst): Contact
    {
        $this->name_first = $nameFirst;
        return $this;
    }

    /**
     * @return string
     */
    public function getNameMiddle(): string
    {
        return $this->name_middle;
    }

    /**
     * @param string $nameMiddle
     * @return Contact
     */
    public function setNameMiddle(string $nameMiddle): Contact
    {
        $this->name_middle = $nameMiddle;
        return $this;
    }
}

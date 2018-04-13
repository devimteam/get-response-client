<?php

namespace DevimTeam\GetResponseClient\Model;

use JMS\Serializer\Annotation as Serializer;

class Campaign
{
    /**
     * @var string
     *
     * @Serializer\Type("string")
     */
    private $campaignId;

    /**
     * @return string
     */
    public function getCampaignId(): string
    {
        return $this->campaignId;
    }

    /**
     * @param string $campaignId
     * @return Campaign
     */
    public function setCampaignId(string $campaignId): Campaign
    {
        $this->campaignId = $campaignId;
        return $this;
    }
}
<?php

namespace DevimTeam\GetResponseClient\Model;

use JMS\Serializer\Annotation as Serializer;

class Tag
{
    /**
     * @var string
     *
     * @Serializer\Type("string")
     */
    private $tagId;

    /**
     * @return string
     */
    public function getTagId(): string
    {
        return $this->tagId;
    }

    /**
     * @param string $tagId
     * @return Tag
     */
    public function setTagId(string $tagId): Tag
    {
        $this->tagId = $tagId;
        return $this;
    }
}
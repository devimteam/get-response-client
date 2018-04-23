<?php

namespace DevimTeam\GetResponseClient\Model\Error;

use JMS\Serializer\Annotation as Serializer;

class ApiException extends \Exception
{
    /**
     * @var int
     *
     * @Serializer\Type("int")
     */
    protected $httpStatus;

    /**
     * @var int
     *
     * @Serializer\Type("int")
     */
    protected $code;

    /**
     * @var string
     *
     * @Serializer\Type("string")
     */
    protected $codeDescription;

    /**
     * @var string
     *
     * @Serializer\Type("string")
     */
    protected $message;

    /**
     * @var string
     *
     * @Serializer\Type("string")
     */
    protected $moreInfo;

    /**
     * @var array|Context[]
     *
     * @Serializer\Type("array<DevimTeam\GetResponseClient\Model\Error\Context>")
     */
    protected $context;

    /**
     * @var string
     *
     * @Serializer\Type("string")
     */
    protected $uuid;

    /**
     * @return int
     */
    public function getHttpStatus(): int
    {
        return $this->httpStatus;
    }

    /**
     * @param int $httpStatus
     * @return ApiException
     */
    public function setHttpStatus(int $httpStatus): ApiException
    {
        $this->httpStatus = $httpStatus;
        return $this;
    }

    /**
     * @param int $code
     * @return ApiException
     */
    public function setCode(int $code): ApiException
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return string
     */
    public function getCodeDescription(): string
    {
        return $this->codeDescription;
    }

    /**
     * @param string $codeDescription
     * @return ApiException
     */
    public function setCodeDescription(string $codeDescription): ApiException
    {
        $this->codeDescription = $codeDescription;
        return $this;
    }

    /**
     * @param string $message
     * @return ApiException
     */
    public function setMessage(string $message): ApiException
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return string
     */
    public function getMoreInfo(): string
    {
        return $this->moreInfo;
    }

    /**
     * @param string $moreInfo
     * @return ApiException
     */
    public function setMoreInfo(string $moreInfo): ApiException
    {
        $this->moreInfo = $moreInfo;
        return $this;
    }

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

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @param string $uuid
     * @return ApiException
     */
    public function setUuid(string $uuid): ApiException
    {
        $this->uuid = $uuid;
        return $this;
    }

    public function getContextAsString(): string
    {
        $r = "";
        foreach ($this->getContext() as $item) {
            $r .= implode(', ', $item->getFieldName()) . " = " . $item->getErrorDescription() . PHP_EOL;
        }
        return $r;
    }
}
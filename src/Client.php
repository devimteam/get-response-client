<?php

namespace DevimTeam\GetResponseClient;

use DevimTeam\GetResponseClient\Model\Error\ApiException;
use DevimTeam\GetResponseClient\Model\Error\ApiException2;
use JMS\Serializer\Exception\RuntimeException;
use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;
use JMS\Serializer\Naming\SerializedNameAnnotationStrategy;

class Client
{
    /** @var string */
    private $apiKey;

    /**
     * Client constructor.
     * @param string $apiKey
     */
    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * @param $build
     * @return mixed
     * @throws ApiException
     * @throws ApiException2
     * @throws RuntimeException
     */
    public function run($build)
    {
        $serializerCtx = \JMS\Serializer\SerializationContext::create()->setSerializeNull(true);
        $serializer = \JMS\Serializer\SerializerBuilder::create()
            ->setPropertyNamingStrategy(new SerializedNameAnnotationStrategy(
                new IdenticalPropertyNamingStrategy()
            ))
            ->build();

        /** @var string $method */
        /** @var string $url */
        /** @var mixed $parameters */
        /** @var string $responseModelType */
        list($method, $url, $parameters, $responseModelType) = $build;

        $ch = curl_init();

        $url = 'https://api.getresponse.com/v3' . $url;

        $headers = [
            'X-Auth-Token: api-key ' . $this->apiKey,
        ];

        $queryStr = null;
        if (count($parameters) > 0) {
            if ($method == ResourceDescriptionInterface::HTTP_METHOD_POST) {
                $queryStr = $serializer->serialize($parameters, 'json', $serializerCtx);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $queryStr);
                $headers = array_merge($headers, array(
                    'Content-Type: application/json',
                ));

            } elseif ($method == ResourceDescriptionInterface::HTTP_METHOD_GET) {
                $queryStr = http_build_query($parameters);
                $url .= '?' . $queryStr;
            }
        }

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        {
            curl_setopt($ch, CURLINFO_HEADER_OUT, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        }

        $output = curl_exec($ch);

        if ($output === false) {
            $output = curl_error($ch);
        }

//        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
//        $headers = curl_getinfo($ch, CURLINFO_HEADER_OUT);

        curl_close($ch);

        $result = null;

        $result = $serializer->deserialize($output, ApiException::class, 'json');
        if ($result instanceof ApiException && $result->getCode() > 0) {
            throw $result;
        }

        $result = $serializer->deserialize($output, ApiException2::class, 'json');
        if ($result instanceof ApiException2 && $result->getCode() > 0) {
            throw $result;
        }

        return $serializer->deserialize($output, $responseModelType, 'json');
    }
}
<?php

namespace DevimTeam\GetResponseClient;

use JMS\Serializer\Exception\RuntimeException;
use Symfony\Component\OptionsResolver\OptionsResolver;

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

    public function run($build): mixed
    {
        /** @var string $method */
        /** @var string $url */
        /** @var array $parameters */
        /** @var string $responseModelType */
        list($method, $url, $parameters, $responseModelType) = $build;

        $ch = curl_init();

        if (count($parameters) > 0) {
            $queryStr = http_build_query($parameters);
            if ($method == ResourceDescriptionInterface::HTTP_METHOD_POST) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $queryStr);
            } elseif ($method == ResourceDescriptionInterface::HTTP_METHOD_GET) {
                $url .= '?' . $queryStr;
            }
        }

        curl_setopt($ch, CURLOPT_URL, 'https://api.getresponse.com/v3' . $url);

        if ($method == ResourceDescriptionInterface::HTTP_METHOD_POST) {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'X-Auth-Token: api-key ' . $this->apiKey,
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);

        curl_close($ch);


        $serializer = \JMS\Serializer\SerializerBuilder::create()->build();

        try {
            $result = $serializer->deserialize($output, $responseModelType, 'json');
        } catch (RuntimeException $exception) {
            die($output);
        }

        //

        return $result;
    }

    /**
     * @param $contactId
     * @param array $fields
     * @return array
     */
    public function contactsUpsertCustomFields($contactId, $fields = [])
    {
        $postBody = ['customFieldValues' => []];
        foreach ($fields as $name => $val) {
            $postBody['customFieldValues'][] = [
                'customFieldId' => $name,
                'value' => (array)$val,
            ];
        }
        $postBodyStr = json_encode($postBody);

        $ch = curl_init("https://api.getresponse.com/v3/contacts/{$contactId}/custom-fields");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'X-Auth-Token: api-key ' . $this->apiKey,
        ));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postBodyStr);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($postBodyStr)
            )
        );

        $result = curl_exec($ch);

        return json_decode($result, true);
    }
}
<?php

namespace DevimTeam\GetResponseClient;

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

    public function run($build)
    {
        /** @var string $method */
        /** @var string $url */
        /** @var array $parameters */
        list($method, $url, $parameters) = $build;

//        $resolver = new OptionsResolver();
//        $description->configureOptions($resolver);
//        $options = $resolver->resolve($options);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.getresponse.com/v3');

        if ($method == ResourceDescriptionInterface::HTTP_METHOD_POST) {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'X-Auth-Token: api-key ' . $this->apiKey,
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);

        curl_close($ch);
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
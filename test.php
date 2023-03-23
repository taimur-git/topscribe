<?php
require_once(__DIR__ . '/vendor/autoload.php');
require_once(__DIR__ . '/vendor/cloudmersive/cloudmersive_nlp_api_client/vendor/autoload.php');

// Configure API key authorization: Apikey
$config = Swagger\Client\Configuration::getDefaultConfiguration()->setApiKey('Apikey', 'api key here');



$apiInstance = new Swagger\Client\Api\LanguageDetectionApi(
    
    
    new GuzzleHttp\Client(),
    $config
);
$text_to_detect = "The quick brown fox jumps over the lazy dog."; // string | Text to detect language of

try {
    $result = $apiInstance->languageDetectionPost($text_to_detect);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LanguageDetectionApi->languageDetectionPost: ', $e->getMessage(), PHP_EOL;
}
?>
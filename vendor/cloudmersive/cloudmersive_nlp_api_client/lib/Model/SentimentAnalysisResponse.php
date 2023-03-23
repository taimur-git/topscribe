<?php
/**
 * SentimentAnalysisResponse
 *
 * PHP version 5
 *
 * @category Class
 * @package  Swagger\Client
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */

/**
 * nlpapiv2
 *
 * The powerful Natural Language Processing APIs (v2) let you perform part of speech tagging, entity identification, sentence parsing, and much more to help you understand the meaning of unstructured text.
 *
 * OpenAPI spec version: v1
 * 
 * Generated by: https://github.com/swagger-api/swagger-codegen.git
 * Swagger Codegen version: 2.3.1
 */

/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace Swagger\Client\Model;

use \ArrayAccess;
use \Swagger\Client\ObjectSerializer;

/**
 * SentimentAnalysisResponse Class Doc Comment
 *
 * @category Class
 * @description Output of a sentiment analysis operation
 * @package  Swagger\Client
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class SentimentAnalysisResponse implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'SentimentAnalysisResponse';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'successful' => 'bool',
        'sentiment_classification_result' => 'string',
        'sentiment_score_result' => 'double',
        'sentence_count' => 'int'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'successful' => null,
        'sentiment_classification_result' => null,
        'sentiment_score_result' => 'double',
        'sentence_count' => 'int32'
    ];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function swaggerTypes()
    {
        return self::$swaggerTypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function swaggerFormats()
    {
        return self::$swaggerFormats;
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'successful' => 'Successful',
        'sentiment_classification_result' => 'SentimentClassificationResult',
        'sentiment_score_result' => 'SentimentScoreResult',
        'sentence_count' => 'SentenceCount'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'successful' => 'setSuccessful',
        'sentiment_classification_result' => 'setSentimentClassificationResult',
        'sentiment_score_result' => 'setSentimentScoreResult',
        'sentence_count' => 'setSentenceCount'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'successful' => 'getSuccessful',
        'sentiment_classification_result' => 'getSentimentClassificationResult',
        'sentiment_score_result' => 'getSentimentScoreResult',
        'sentence_count' => 'getSentenceCount'
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$swaggerModelName;
    }

    

    

    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['successful'] = isset($data['successful']) ? $data['successful'] : null;
        $this->container['sentiment_classification_result'] = isset($data['sentiment_classification_result']) ? $data['sentiment_classification_result'] : null;
        $this->container['sentiment_score_result'] = isset($data['sentiment_score_result']) ? $data['sentiment_score_result'] : null;
        $this->container['sentence_count'] = isset($data['sentence_count']) ? $data['sentence_count'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {

        return true;
    }


    /**
     * Gets successful
     *
     * @return bool
     */
    public function getSuccessful()
    {
        return $this->container['successful'];
    }

    /**
     * Sets successful
     *
     * @param bool $successful True if the sentiment analysis operation was successful, false otherwise
     *
     * @return $this
     */
    public function setSuccessful($successful)
    {
        $this->container['successful'] = $successful;

        return $this;
    }

    /**
     * Gets sentiment_classification_result
     *
     * @return string
     */
    public function getSentimentClassificationResult()
    {
        return $this->container['sentiment_classification_result'];
    }

    /**
     * Sets sentiment_classification_result
     *
     * @param string $sentiment_classification_result Classification of input text into a sentiment classification; possible values are \"Positive\", \"Negative\" or \"Neutral\"
     *
     * @return $this
     */
    public function setSentimentClassificationResult($sentiment_classification_result)
    {
        $this->container['sentiment_classification_result'] = $sentiment_classification_result;

        return $this;
    }

    /**
     * Gets sentiment_score_result
     *
     * @return double
     */
    public function getSentimentScoreResult()
    {
        return $this->container['sentiment_score_result'];
    }

    /**
     * Sets sentiment_score_result
     *
     * @param double $sentiment_score_result Sentiment classification score between -1.0 and +1.0 where scores less than 0 are negative sentiment, scores greater than 0 are positive sentiment and scores close to 0 are neutral.  The greater the value deviates from 0.0 the stronger the sentiment, with +1.0 and -1.0 being maximum positive and negative sentiment, respectively.
     *
     * @return $this
     */
    public function setSentimentScoreResult($sentiment_score_result)
    {
        $this->container['sentiment_score_result'] = $sentiment_score_result;

        return $this;
    }

    /**
     * Gets sentence_count
     *
     * @return int
     */
    public function getSentenceCount()
    {
        return $this->container['sentence_count'];
    }

    /**
     * Sets sentence_count
     *
     * @param int $sentence_count Number of sentences in input text
     *
     * @return $this
     */
    public function setSentenceCount($sentence_count)
    {
        $this->container['sentence_count'] = $sentence_count;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

    /**
     * Sets value based on offset.
     *
     * @param integer $offset Offset
     * @param mixed   $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        if (defined('JSON_PRETTY_PRINT')) { // use JSON pretty print
            return json_encode(
                ObjectSerializer::sanitizeForSerialization($this),
                JSON_PRETTY_PRINT
            );
        }

        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}


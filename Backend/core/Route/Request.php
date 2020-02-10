<?php

namespace core\Route;

use Ahc\Jwt\JWT;

interface IRequest
{
    public function getBody();
    public function getQuery();
    public function getSession();

    /**
     * @return JWT
     */
    public function getJWT();

    /**
     * @return string
     */
    public function getToken();
}


/**
 * Class Request
 * @author Sebastian Davaris.
 * @package core\Route
 * @property string phpSelf
 * @property array argv
 * @property int argc
 * @property string gatewayInterface
 * @property string serverAddr
 * @property string serverName
 * @property string serverSoftware
 * @property string serverProtocol
 * @property string requestMethod
 * @property int requestTime
 * @property float requestTimeFloat
 * @property string queryString
 * @property string documentRoot
 * @property string httpAccept
 * @property string httpAcceptCharset
 * @property string httpAcceptEncoding
 * @property string httpAcceptLanguage
 * @property string httpConnection
 * @property string httpHost
 * @property string httpReferer
 * @property string httpUserAgent
 * @property mixed https
 * @property string remoteAddr
 * @property string remoteHost
 * @property int remotePort
 * @property string remoteUser
 * @property string redirectRemoteUser
 * @property string scriptFilename
 * @property string serverAdmin
 * @property int serverPort
 * @property string serverSignature
 * @property string pathTranslated
 * @property string scriptName
 * @property string requestUri
 * @property string phpAuthDigest
 * @property string phpAuthUser
 * @property string phpAuthPw
 * @property string authType
 * @property string pathInfo
 * @property string origPathInfo
 */
class Request implements IRequest
{
    private $jwt;

    function __construct()
    {
        $this->bootstrapSelf();
        $this->jwt = new JWT("Aa123456&", "HS256", 86400, 10);
    }

    private function bootstrapSelf() {
        foreach ($_SERVER as $key => $value) {
            $this->{$this->toCamelCase($key)} = $value;
        }
    }

    /**
     * @param $string string
     * @return string|string[]
     */
    private function toCamelCase($string) {
        $result = strtolower($string);

        preg_match_all('/_[a-z]/', $result, $matches);

        foreach ($matches[0] as $match) {
            $c = str_replace('_', '', strtoupper($match));
            $result = str_replace($match, $c, $result);
        }

        return $result;
    }

    /**
     * Returns the request body.
     * @author Sebastian Davaris
     * @return array|null
     */
    public function getBody()
    {
        if($this->requestMethod === "GET")
            return null;

        if($this->requestMethod === "POST") {
            $body = array();
            foreach ($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }

            return $body;
        }

        return null;
    }

    /**
     * @return mixed
     */
    public function getQuery() {
        parse_str($this->queryString, $result);

        return $result;
    }

    /**
     * @return mixed
     */
    public function getSession()
    {
        return $_SESSION;
    }

    public function getJWT()
    {
        return $this->jwt;
    }

    public function getToken()
    {
        /**
         * @var string
         */
        $header = apache_request_headers()["Authorization"];

        return substr($header, 7);
    }
}
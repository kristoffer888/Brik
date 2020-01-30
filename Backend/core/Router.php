<?php


namespace core;


use core\Route\IRequest;

/**
 * Defines the base Router class.
 * @author Sebastian Davaris
 *
 * @method   string get(string $request, callable $method)
 * @method   string post(string $request, callable $method)
 */
class Router
{
    /**
     * The raw IRequest interface.
     * @author Sebastian Davaris
     * @var IRequest
     */
    private $request;
    private $supportedHttpMethods = array(
        "GET",
        "POST"
    );

    /**
     * Router constructor.
     * @author Sebastian Davaris
     * @param IRequest $request The raw request object.
     */
    function __construct(IRequest $request)
    {
        $this->request = $request;
    }

    /**
     * Magic method to create "virtual" methods as 'get' and 'post'.
     * @author Sebastian Davaris
     * @param string $name The endpoint name.
     * @param mixed $arguments The method arguments.
     */
    function __call($name, $arguments)
    {
        list($route, $method) = $arguments;

        if(!in_array(strtoupper($name), $this->supportedHttpMethods))
            $this->invalidMethodHandler();

        $this->{strtolower($name)}[$this->formatRoute($route)] = $method;
    }

    /**
     * Formats a route and strips the trailing slash.
     * @author Sebastian Davaris
     * @param string $route The endpoint name.
     * @return string
     */
    private function formatRoute($route) {
        $result = rtrim($route, '/');

        if($result === '')
            return '/';
        return $result;
    }

    /**
     * Called when a 405 occurs.
     * @author Sebastian Davaris
     */
    private function invalidMethodHandler() {
        header("{$this->request->serverProtocol} 405 Method Not Allowed");
    }

    /**
     * Called when a 404 occurs.
     * @author Sebastian Davaris
     */
    private function defaultRequestHandler() {
        header("{$this->request->serverProtocol} 404 Not Found");
    }

    function resolve() {
        $methodDictionary = $this->{strtolower($this->request->requestMethod)};
        $formatedRoute = $this->formatRoute($this->request->pathInfo);
        $method = $methodDictionary[$formatedRoute];

        if(is_null($method)) {
            $this->defaultRequestHandler();
            return;
        }

        // Runs the callback and passes the array of parameters.
        echo call_user_func($method, $this->request);
    }

    /**
     * Destructor.
     */
    function __destruct()
    {
        $this->resolve();
    }
}
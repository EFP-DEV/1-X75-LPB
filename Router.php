<?php

/**
 * SimpleRouter - Minimal routing for basic applications
 *
 * PATTERN MATCHING LOGIC:
 * - pathToRegex() converts routes like '/users/:id' to regex patterns
 * - ':param' placeholders become regex capture groups ([^/]+)
 * - Route parameters are extracted from URL segments matching these groups
 * - Routes are matched in sequential order (first match wins)
 *
 * TYPICAL USAGE PATTERNS:
 *
 * 1. Basic manual routing:
 *    $router = new SimpleRouter();
 *    $router->get('/users', function() { echo "Users list"; });
 *    $router->get('/users/:id', function($id) { echo "User: $id"; });
 *    $router->dispatch();
 *
 * 2. Auto-dispatching with Convention over Configuration:
 *    $router = new SimpleRouter();
 *    $router->get('/:controller/:action', null);
 *    $router->get('/:controller/:id/:action', null);
 *    $router->dispatch(true); // Automatically maps to controller files
 *
 * CONVENTION OVER CONFIGURATION:
 * This router implements CoC by:
 * - Auto-mapping URL segments to controller files (/users → controllers/users.php)
 * - Automatically calling functions within controllers based on URL segments
 * - Using predictable patterns rather than explicit route definitions
 * - Reducing boilerplate through standardized routing patterns
 *
 * TRADE-OFFS:
 * Advantages of this lightweight approach:
 * - Minimal code (under 200 lines)
 * - Easy to understand and modify
 * - No dependencies
 * - Works with basic PHP setups
 *
 * Limitations vs. robust frameworks:
 * - Limited HTTP method support
 * - No middleware pipeline
 * - Minimal validation/error handling
 * - Sequential matching can be slow with many routes
 * - No route caching mechanism
 * - Basic pattern matching (no complex constraints)
 */
class SimpleRouter
{
    private $routes = [
        'GET' => [],
        'POST' => []
    ];

    /**
     * Register a route
     * @param string $method HTTP method (GET/POST)
     * @param string $path URL path
     * @param callable $callback Function to execute
     */
    public function add($method, $path, $callback)
    {
        $method = strtoupper($method);
        if (!isset($this->routes[$method])) {
            $this->routes[$method] = [];
        }
        $this->routes[$method][] = [
            'path' => $path,
            'callback' => $callback
        ];
    }

    /**
     * Add GET route
     */
    public function get($path, $callback)
    {
        $this->add('GET', $path, $callback);
    }

    /**
     * Add POST route
     */
    public function post($path, $callback)
    {
        $this->add('POST', $path, $callback);
    }
    /**
     * Match current request to route
     * @param bool $autoDispatch Set to true to automatically dispatch to controllers
     * @return bool True if route matched and executed
     */
    public function dispatch($autoDispatch = false)
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = rtrim($uri, '/') ?: '/';

        if (!isset($this->routes[$method])) {
            return false;
        }

        foreach ($this->routes[$method] as $route) {
            $pattern = $this->pathToRegex($route['path']);

            if (preg_match($pattern, $uri, $matches)) {
                // Extract parameters from the matched route
                $params = $this->extractRouteParameters($route['path'], $matches);

                // Handle auto-dispatching to controllers if specified
                if ($autoDispatch && $this->handleAutoDispatch($route, $params)) {
                    return true;
                }

                // Otherwise, call the route callback with parameters
                call_user_func_array($route['callback'], $params);
                return true;
            }
        }

        return false;
    }

    /**
     * Extract named parameters from a matched route
     * @param string $routePath Original route path with parameter placeholders
     * @param array $matches Regex matches from the pattern
     * @return array Associative array of named parameters
     */
    private function extractRouteParameters($routePath, $matches)
    {
        // Remove the full match from the matches array
        array_shift($matches);

        // Extract parameter names from the path pattern
        $paramNames = [];
        preg_match_all('/:([^\/]+)/', $routePath, $paramMatches);

        if (empty($paramMatches[1])) {
            return [];
        }

        $paramNames = $paramMatches[1];

        // Create associative array of parameters
        $params = [];
        foreach ($paramNames as $index => $name) {
            $params[$name] = $matches[$index] ?? null;
        }

        return $params;
    }

    /**
     * Handle auto dispatching based on route patterns
     * @param array $route Current route information
     * @param array $params Extracted parameters
     * @return bool Success or failure
     */
    private function handleAutoDispatch($route, $params)
    {
        switch ($route['path']) {
            case '/:controller/:id/:action':
                return $this->dispatchToControllerWithID($params);

            case '/:controller/:action':
                if (is_numeric($params['action'])) {
                    $modifiedParams = [
                        'controller' => $params['controller'],
                        'id' => $params['action'],
                        'action' => 'record'
                    ];
                    return $this->dispatchToControllerWithID($modifiedParams);
                }

                return $this->dispatchToControllerAction($params);

            case '/:controller':
                // Add 'home' as default action parameter
                $params['action'] = 'home';
                return $this->dispatchToControllerAction($params);

                // Easy to add future patterns here

            default:
                return false;
        }
    }

    /**
     * Dispatch to controller/action pattern using Convention over Configuration
     * @param array $params Route parameters
     * @return bool Success or failure
     */
    private function dispatchToControllerWithID($params)
    {
        $controllerName = strtolower($params['controller']);
        $actionName = strtolower($params['action']);
        $id = $params['id'] ?? null;

        // Check for controller file (using CoC)
        $controllerFile = 'controllers/' . $controllerName . '.php';

        if (!file_exists($controllerFile)) {
            return false;
        }

        // Include the controller file
        require_once $controllerFile;

        // Check if function exists in the included file
        if (!function_exists($actionName)) {
            return false;
        }

        // Call the function with the ID parameter
        $actionName($id);
        return true;
    }

    /**
     * Dispatch to controller/action pattern without ID parameter
     * @param array $params Route parameters
     * @return bool Success or failure
     */
    private function dispatchToControllerAction($params)
    {
        $controllerName = strtolower($params['controller']);
        $actionName = strtolower($params['action']);

        // Check for controller file (using CoC)
        $controllerFile = 'controllers/' . $controllerName . '.php';

        if (!file_exists($controllerFile)) {
            return false;
        }

        // Include the controller file
        require_once $controllerFile;

        // Check if function exists in the included file
        if (!function_exists($actionName)) {
            return false;
        }

        // Call the function without ID parameter
        $actionName();
        return true;
    }

    /**
     * Convert path with parameters to regex
     */
    private function pathToRegex($path)
    {
        // First, escape the entire path
        $escapedPath = preg_quote($path, '/');

        // Then restore and process the parameter placeholders
        // (replacing the now-escaped colon character)
        $pattern = str_replace('\:', ':', $escapedPath);

        // Now safely convert parameters to capture groups
        $pattern = preg_replace('/:([^\/]+)/', '([^/]+)', $pattern);

        // Handle slashes and create the final regex
        return '/^' . str_replace('/', '\/', $pattern) . '$/';
    }
}

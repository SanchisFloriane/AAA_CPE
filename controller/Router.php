<?php
require_once "Auth/Auth.php";

/**
 * Created by PhpStorm.
 * User: alex
 * Date: 02/05/2018
 * Time: 15:02
 */
class Route {

    var $path;
    var $fun;
    var $restrict;

    function __construct($path, Closure $fun,$restrict=false)
    {
        $this->path = strtoupper($path);
        $this->fun = $fun;
        $this->restrict = $restrict;
    }

    // Returns:
    //  - if it matches, it returns an array with the matching parameters
    //  - it it does not match, it returns false
    function match($path)
    {
        // replacing variables by a variable regexp
        $regexp_path = preg_replace ('#:[^\&]+#' , '([^\&]+)' , $this->path);
        // print("\nInitial path " . $this->path);
        // print("\npath after filtering: " . $regexp_path);

        // searching for variables in the given path
        $result = preg_match('#^'.$regexp_path.'$#', $path, $matches);
        // print("\n>" . $regexp_path . "< >" . $path . "< match result : " . $result);
        // print("\n");

        // removing the first value of the $matches cause it's not a match.
        array_splice($matches, 0, 1);

        if ($result == 1)
        {
            return $matches;
        }
        return false;
    }

    // It calls the method with the given parameters
    function call($params) 
    {
            return call_user_func_array($this->fun, $params);
    }
}

// Helper class to create GET routes
class GET extends Route {
    function __construct($path, $fun,$restrict=false)
    {
        parent::__construct($path, $fun,$restrict);
    }
}

// Helper class to create POST routes
class POST extends Route {
    function __construct($path, $fun,$restrict=false)
    {
        parent::__construct($path, $fun,$restrict);
    }
}

// Helper class to create PUT routes
class PUT extends Route {
    function __construct($path, $fun,$restrict=false)
    {
        parent::__construct($path, $fun,$restrict);
    }
}

class Router {
    var $auth;
    var $routes = ['GET' => [], 'PUT' => [], 'POST' => []];

    function __construct($auth)
    {
        $this->add_listing_routes();
        $this->auth = $auth;
    }

    // Add the /routes route
    function add_listing_routes()
    {
        $this->add_route('GET', 'routes', function(){
            print "<h1>Routes</h1>";
            foreach($this->routes as $method => $routes) {
                print "<h3>".$method."</h3>";
                print "<ul>";
                foreach ($routes as $route) {
                    print "<li>".$route->path."</li>";
                }
                print "</ul>";
            }
        });
    }

    function GET($path, $fun,$restrict=false){
         $this->add_route('GET',$path,$fun,$restrict);
    }
    function POST( $path, $fun,$restrict=false){
         $this->add_route('POST',$path,$fun,$restrict);
    }
    function PUT( $path, $fun,$restrict=false){
         $this->add_route('PUT',$path,$fun,$restrict);
    }
    private function add_route($method, $path, $fun,$restrict=false)
    {
        switch (trim($method)) {
            case 'GET':
                array_push($this->routes['GET'], new GET($path, $fun,$restrict));
                break;
            case 'POST':
                array_push($this->routes['POST'], new POST($path, $fun,$restrict));
                break;
            case 'PUT':
                array_push($this->routes['PUT'], new PUT($path, $fun,$restrict));
                break;
        }
    }

    // Search for a matching route and execute the related function
    function match_and_exec($method, $path)
    {
        $possible_routes = $this->routes[$method];
        foreach($possible_routes as $route)
        {
            $result = $route->match($path);

            if (is_array($result) == false)
            {
                continue;
            }
            if($route->restrict && !$this->auth->isLogged())
                return "<h1>Interdit</h1>";
            return $route->call($result);
        }
        return false;
    }

    // method listening for the http request
    function listen()
    {
        $method = strtoupper($_SERVER['REQUEST_METHOD']);
        //$path = trim($_SERVER['REQUEST_URI']);
        $path = isset($_GET['page'])?$_GET['page']:'';


        print $this->match_and_exec($method, strtoupper($path));
    }
}
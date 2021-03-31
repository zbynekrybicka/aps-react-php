<?php

use Latte\Runtime as LR;

/** source: C:\www\aps-react-slim\app\Meta/../templates/api.latte */
final class Template8fc793fbaf extends Latte\Runtime\Template
{

	public function main(): array
	{
		extract($this->params);
		echo '<?php

use App\\Request;
';
		$iterations = 0;
		foreach ($resources as $name => $object) /* line 4 */ {
			echo 'use App\\Service\\';
			echo LR\Filters::escapeHtml(($this->filters->firstupper)($object)) /* line 5 */;
			echo ';
';
			$iterations++;
		}
		echo 'use App\\Response;

require __DIR__ . \'/vendor/autoload.php\';

header(\'Access-Control-Allow-Origin: ';
		echo LR\Filters::escapeHtml(FRONT_URL) /* line 11 */;
		echo '\');
header(\'Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS\');
header(\'Access-Control-Allow-Headers: Authorization, Content-Type\');
header(\'Access-Control-Max-Age: 1728000\');
header(\'Content-Length: 0\');
header(\'Content-Type: text/plain\');


$dispatcher = FastRoute\\simpleDispatcher(function(FastRoute\\RouteCollector $r) {
';
		$iterations = 0;
		foreach ($resources as $name => $object) /* line 20 */ {
			echo '    $';
			echo LR\Filters::escapeHtml($name) /* line 21 */;
			echo ' = new ';
			echo LR\Filters::escapeHtml(($this->filters->firstupper)($object)) /* line 21 */;
			echo '();
';
			$iterations++;
		}
		echo "\n";
		$iterations = 0;
		foreach ($requests as $request) /* line 24 */ {
			echo '    $r->addRoute(\'';
			echo LR\Filters::escapeHtmlText(($this->filters->upper)($request->method)) /* line 25 */;
			echo '\', \'';
			echo LR\Filters::escapeHtmlText($request->url) /* line 25 */;
			echo '\', [$';
			echo $request->resource /* line 25 */;
			echo ', \'';
			echo LR\Filters::escapeHtmlText($request->classMethod) /* line 25 */;
			echo '\' ]);
';
			$iterations++;
		}
		echo '});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER[\'REQUEST_METHOD\'];
$uri = $_SERVER[\'REQUEST_URI\'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, \'?\')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

switch ($routeInfo[0]) {
    case FastRoute\\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        break;
    case FastRoute\\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        $headers = getallheaders();
        if (in_array($httpMethod, [\'POST\', \'PUT\'])) {
            $request = new Request($vars, $headers, (array) json_decode(file_get_contents(\'php://input\')));
        } else {
            $request = new Request($vars, $headers, $_GET);
        }
        /** @var Response $response */
        $response = $handler($request);
        http_response_code($response->code());
        echo json_encode($response->data());
        break;
}';
		return get_defined_vars();
	}


	public function prepare(): void
	{
		extract($this->params);
		if (!$this->getReferringTemplate() || $this->getReferenceType() === "extends") {
			foreach (array_intersect_key(['name' => '4, 20', 'object' => '4, 20', 'request' => '24'], $this->params) as $ʟ_v => $ʟ_l) {
				trigger_error("Variable \$$ʟ_v overwritten in foreach on line $ʟ_l");
			}
		}
		
	}

}

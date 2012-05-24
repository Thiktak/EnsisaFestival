<?php

function EntityDump($var)
{
	echo '<pre class="alert alert-box alert-info" style="margin: .5em;">';
	\Doctrine\Common\Util\Debug::dump($var);
	echo '</pre>';
}

require_once __DIR__.'/../app/bootstrap.php.cache';
require_once __DIR__.'/../app/AppKernel.php';
//require_once __DIR__.'/../app/AppCache.php';

use Symfony\Component\HttpFoundation\Request;

$kernel = new AppKernel('prod', false);
$kernel->loadClassCache();
//$kernel = new AppCache($kernel);
$kernel->handle(Request::createFromGlobals())->send();

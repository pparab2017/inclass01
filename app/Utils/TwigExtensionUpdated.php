<?php
/**
 * Created by PhpStorm.
 * User: rlews
 * Date: 7/18/16
 * Time: 4:42 PM
 */

namespace Utils;

use Slim\Views\TwigExtension;

class TwigExtensionUpdated extends TwigExtension {

    public function __construct($router, $uri)
    {
        parent::__construct($router, $uri);
    }

    public function getFunctions()
    {
        $parentFunctions = parent::getFunctions();
        $parentFunctions[] = new \Twig_SimpleFunction('str_pad', array($this, 'strpad'));
        return $parentFunctions;
    }

    public function strpad($input, $size)
    {
        return str_pad($input, $size, "0", STR_PAD_LEFT);
    }
}
<?php
namespace AntiPhp\ResourceLoader\View\Helper;

interface ResourceLoaderInterface
{
    public function __construct(array $resources = array());
    public function __invoke($resource);
}
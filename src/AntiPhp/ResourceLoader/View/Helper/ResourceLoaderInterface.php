<?php
/**
 * interface file
 *
 * @author Christian Reinecke <christian.reinecke@web.de>
 */
namespace AntiPhp\ResourceLoader\View\Helper;

/**
 * Assure resource loader functionality
 */
interface ResourceLoaderInterface
{
    /**
     * @param array $resources list of resources and their dependencies
     */
    public function __construct(array $resources = array());

    /**
     * embed the given resource
     *
     * @param string $resource
     */
    public function __invoke($resource);
}
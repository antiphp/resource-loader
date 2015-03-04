<?php
/**
 * class file
 *
 * @author Christian Reinecke <christian.reinecke@web.de>
 */
namespace AntiPhp\ResourceLoader\View\Helper;

use Zend\View\Helper\AbstractHelper;

/**
 * View helper to load a UI resource as configured in the given data.
 */
class ResourceLoader extends AbstractHelper
{
    /**
     * @var array
     */
    private $resources;

    /**
     * @param array $resources
     */
    public function __construct(array $resources)
    {
        $this->resources = $resources;
    }
}
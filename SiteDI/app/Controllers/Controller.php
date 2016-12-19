<?php
declare(strict_types = 1);

namespace SiteDI\Controllers
{

    use Interop\Container\ContainerInterface;

    abstract class Controller
    {
        /**
         * @var ContainerInterface
         */
        protected $container;

        public function __construct(ContainerInterface $container)
        {
            $this->container = $container;
        }
    }
}

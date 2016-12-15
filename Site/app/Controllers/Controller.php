<?php
declare(strict_types = 1);

namespace Site\Controllers
{
    use Slim\Container;

    abstract class Controller
    {
        /**
         * @var Container
         */
        protected $container;

        public function __construct($container)
        {
            $this->container = $container;
        }

        public function __get($property)
        {
            if ($this->container->{$property}) {
                return $this->container->{$property};
            }

            return null;
        }
    }
}

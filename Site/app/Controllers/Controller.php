<?php
declare(strict_types = 1);

namespace Site\Controllers
{
    use Interop\Container\ContainerInterface;

    abstract class Controller
    {
        /**
         * @var ContainerInterface
         */
        protected $c;

        public function __construct(ContainerInterface $c)
        {
            $this->c = $c;
        }
    }
}

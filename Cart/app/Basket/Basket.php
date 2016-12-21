<?php

namespace Cart\Basket {

    use Cart\Models\Product;
    use Cart\Support\Storage\Contracts\StorageInterface;

    class Basket
    {
        /**
         * @var StorageInterface
         */
        private $session;
        /**
         * @var Product
         */
        private $product;

        public function __construct(StorageInterface $session, Product $product)
        {
            $this->session = $session;
            $this->product = $product;
        }
    }
}

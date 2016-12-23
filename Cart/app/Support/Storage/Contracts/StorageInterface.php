<?php

namespace Cart\Support\Storage\Contracts {

    interface StorageInterface
    {
        public function get($key);
        public function set($key, $value);
        public function all();
        public function exists($key);
        public function unset($key);
        public function clear();
        public function count();
    }
}

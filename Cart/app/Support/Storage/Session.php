<?php

namespace Cart\Support\Storage {

    use Cart\Support\Storage\Contracts\StorageInterface;

    class Session implements StorageInterface, \Countable
    {
        protected $bucket;

        public function __construct($bucket = 'default')
        {
            if (!isset($_SESSION[$bucket])) {
                $_SESSION[$bucket] = [];
            }

            $this->bucket = $bucket;
        }

        public function set($key, $value)
        {
            $_SESSION[$this->bucket][$key] = $value;
        }

        public function get($key)
        {
            if (!$this->exists($key)) {
                return null;
            }

            return $_SESSION[$this->bucket][$key];
        }

        public function exists($key)
        {
            return isset($_SESSION[$this->bucket][$key]);
        }

        public function all()
        {
            return $_SESSION[$this->bucket];
        }

        public function unset($key)
        {
            if ($this->exists($key)) {
                unset($_SESSION[$this->bucket][$key]);
            }
        }

        public function clear()
        {
            unset($_SESSION[$this->bucket]);
        }

        /**
         * Count elements of an object
         * @link http://php.net/manual/en/countable.count.php
         * @return int The custom count as an integer.
         * </p>
         * <p>
         * The return value is cast to an integer.
         * @since 5.1.0
         */
        public function count() : int
        {
            return count($this->all());
        }
    }
}

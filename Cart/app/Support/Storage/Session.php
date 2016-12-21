<?php
declare(strict_types = 1);

namespace Cart\Support\Storage {

    use Cart\Support\Storage\Contracts\StorageInterface;

    class Session implements StorageInterface, \Countable
    {

        /**
         * @var string
         */
        private $data;

        public function __construct($data = 'default')
        {
            if (!isset($_SESSION[$data])) {
                $_SESSION[$data] = [];
            }
            $this->data = $data;
        }

        public function get($key)
        {
           if (!$this->exists($key)) {
               return null;
           }
           return $_SESSION[$this->data][$key];
        }

        public function set($key, $value)
        {
            $_SESSION[$this->data][$key] = $value;
        }

        public function all()
        {
            return $_SESSION[$this->data];
        }

        public function exists($key)
        {
            return isset($_SESSION[$this->data][$key]);
        }

        public function unset($key)
        {
            if ($this->exists($key)) {
                unset($_SESSION[$this->data][$key]);
            }
        }

        public function clear()
        {
            unset($_SESSION[$this->data]);
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

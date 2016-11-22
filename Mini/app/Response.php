<?php
declare(strict_types = 1);

namespace App {

    class Response
    {
        private $body;
        private $statusCode = 200;

        public function setBody($body) : Response
        {
            $this->body = $body;
            return $this;
        }

        public function getBody()
        {
            return $this->body;
        }

        public function withStatus($statusCode)
        {
            $this->statusCode = $statusCode;
            return $this;
        }

        public function getStatusCode()
        {
            return $this->statusCode;
        }
    }
}

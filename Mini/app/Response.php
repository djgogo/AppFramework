<?php
declare(strict_types = 1);

namespace App {

    class Response
    {
        /**
         * @var string
         */
        private $body;

        /**
         * @var int
         */
        private $statusCode = 200;

        /**
         * @var array
         */
        private $headers = [];

        public function setBody($body) : Response
        {
            $this->body = $body;
            return $this;
        }

        public function getBody()
        {
            return $this->body;
        }

        public function withStatus($statusCode) : Response
        {
            $this->statusCode = $statusCode;
            return $this;
        }

        public function getStatusCode()
        {
            return $this->statusCode;
        }

        public function withJson($body)
        {
            $this->withHeader('Content-Type', 'application/json');
            $this->body = json_encode($body);

            return $this;
        }

        public function withHeader($name, $value)
        {
            $this->headers[] = [$name, $value];
            return $this;
        }

        public function getHeaders() : array
        {
            return $this->headers;
        }
    }
}

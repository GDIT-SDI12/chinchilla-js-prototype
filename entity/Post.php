<?php
    class Post {
        private $id;
        private $author;
        private $body;
        private $title;
        private $createdAt;
        private $approvedAt;
        private $expiredAt;
        private $isActive;
        private $type;

        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function getAuthor() {
            return $this->author;
        }

        public function setAuthor($author) {
            $this->author = $author;
        }

        public function getBody() {
            return $this->body;
        }

        public function setBody($body) {
            $this->body = $body;
        }

        public function getTitle() {
            return $this->title;
        }

        public function setTitle($title) {
            $this->title = $title;
        }

        public function getCreatedAt() {
            return $this->createdAt;
        }

        public function setCreatedAt($createdAt) {
            $this->createdAt = $createdAt;
        }

        public function getApprovedAt() {
            return $this->approvedAt;
        }

        public function setApprovedAt($approvedAt) {
            $this->approvedAt = $approvedAt;
        }

        public function getExpiredAt() {
            return $this->expiredAt;
        }

        public function setExpiredAt($expiredAt) {
            $this->expiredAt = $expiredAt;
        }

        public function isActive() {
            return $this->isActive;
        }

        public function setActive($isActive) {
            $this->isActive = $isActive;
        }

        public function getType() {
            return $this->type;
        }

        public function setType($type) {
            $this->type = $type;
        }
    }
?>
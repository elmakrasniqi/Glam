<?php

class Dashboard {
    private $productCrud;
    private $messageCrud;
    private $userCrud;

    public function __construct($conn) {
        $this->productCrud = new ProductCRUD($conn);
        $this->messageCrud = new MessageCRUD($conn);
        $this->userCrud = new UserCRUD($conn);
    }

    public function getProductCount() {
        return $this->productCrud->getProductCount();
    }

    public function getMessageCount() {
        return $this->messageCrud->getMessageCount();
    }

    public function getUserCount() {
        return $this->userCrud->getUserCount();
    }

    public function getWeeklyProductCount() {
        return $this->productCrud->getWeeklyProductCount();
    }

    public function getWeeklyMessageCount() {
        return $this->messageCrud->getWeeklyMessageCount();
    }

    public function getWeeklyUserCount() {
        return $this->userCrud->getWeeklyUserCount();
    }
}

?>
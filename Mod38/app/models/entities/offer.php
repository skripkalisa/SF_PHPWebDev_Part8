<?php

namespace App\models;

class Offer extends Status
{
    private $_merchantId;
    private $_pricePerClick;
    private $_targetLink;
    private $_created;

    public function __construct($merchantId, $pricePerClick, $targetLink)
    {
        $this->_merchantId = $merchantId;
        $this->_pricePerClick = $pricePerClick;
        $this->_targetLink = $targetLink;
        $this->_created = DateTime::createFromFormat('U', time());
        $this->_status = Status::ACTIVE;
    }
}

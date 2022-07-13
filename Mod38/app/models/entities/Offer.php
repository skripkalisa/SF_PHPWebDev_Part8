<?php

namespace App\models;

class Offer extends Status
{
    private $_profileId;
    private $_pricePerClick;
    private $_targetLink;
    private $_created;

    public function __construct(object $entity = null)
    {
        parent::__construct($entity);
        $this->_profileId = $entity->profile_id;
        $this->_pricePerClick = $entity->price_per_click;
        $this->_targetLink = $entity->target_link;
        $this->_created = $entity->created;
    }
}

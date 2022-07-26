<?php
namespace App\models\entities;

class Account
{
    private $userId;
    private $profileId;
    private $balance;
    private $created;
    private $updated;
    private $status;

    public function __construct(object $entity = null)
    {
        $this->userId = $entity->userId;
        $this->profileId = $entity->profileId;
        $this->balance = $entity->balance;
        $this->created = \DateTime::createFromFormat('U', time());
        $this->updated = \DateTime::createFromFormat('U', time());
        // $this->status = $entity->status;
    }
}

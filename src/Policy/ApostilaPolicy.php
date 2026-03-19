<?php
namespace App\Policy;

use App\Model\Entity\Apostila;
use Authorization\IdentityInterface;

class ApostilaPolicy {
    public function canView($user, $apostila)
    {
        return $apostila->user_id === $user->getIdentifier();
    }

    public function canEdit($user, $apostila)
    {
        return $apostila->user_id === $user->getIdentifier();
    }

    public function canDelete($user, $apostila)
    {
        return $apostila->user_id === $user->getIdentifier();
    }

    public function canAdd($user)
    {
        return true;
    }
}
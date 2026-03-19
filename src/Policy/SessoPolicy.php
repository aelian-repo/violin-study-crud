<?php
namespace App\Policy;

use App\Model\Entity\Sesso;
use Authorization\IdentityInterface;

class SessoPolicy
{
    public function canIndex($user, $resource)
    {
        return true;
    }

    public function canView(IdentityInterface $user, Sesso $sesso)
    {
        return $sesso->user_id === $user->getIdentifier();
    }

    public function canEdit(IdentityInterface $user, Sesso $sesso)
    {
        return $sesso->user_id === $user->getIdentifier();
    }

    public function canDelete(IdentityInterface $user, Sesso $sesso)
    {
        return $sesso->user_id === $user->getIdentifier();
    }

    public function canAdd(IdentityInterface $user)
    {
        return true;
    }
}
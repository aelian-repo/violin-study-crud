<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Sesso;
use Authentication\IdentityInterface;

class SessoPolicy
{
    public function canIndex(IdentityInterface $user, Sesso $sesso): bool
    {
        return true;
    }

    public function canView(IdentityInterface $user, Sesso $sesso): bool
    {
        /** @var \App\Model\Entity\User $userEntity */
        $userEntity = $user->getOriginalData();

        return $sesso->user_id === $userEntity->id;
    }

    public function canEdit(IdentityInterface $user, Sesso $sesso): bool
    {
        /** @var \App\Model\Entity\User $userEntity */
        $userEntity = $user->getOriginalData();

        return $sesso->user_id === $userEntity->id;
    }

    public function canDelete(IdentityInterface $user, Sesso $sesso): bool
    {
        /** @var \App\Model\Entity\User $userEntity */
        $userEntity = $user->getOriginalData();

        return $sesso->user_id === $userEntity->id;
    }

    public function canAdd(IdentityInterface $user, Sesso $sesso): bool
    {
        return true;
    }
}

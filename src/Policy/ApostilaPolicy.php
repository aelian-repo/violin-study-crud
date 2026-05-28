<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Apostila;
use Authentication\IdentityInterface;

class ApostilaPolicy
{
    public function canView(IdentityInterface $user, Apostila $apostila): bool
    {
        return $apostila->user_id === $user->getIdentifier();
    }

    public function canEdit(IdentityInterface $user, Apostila $apostila): bool
    {
        /** @var \App\Model\Entity\User $userEntity */
        $userEntity = $user->getOriginalData();

        return $apostila->user_id === $userEntity->id;
    }

    public function canDelete(IdentityInterface $user, Apostila $apostila): bool
    {
        /** @var \App\Model\Entity\User $userEntity */
        $userEntity = $user->getOriginalData();

        return $apostila->user_id === $userEntity->id;
    }

    public function canAdd(IdentityInterface $user, Apostila $apostila): bool
    {
        return true;
    }
}

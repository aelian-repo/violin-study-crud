<?php
namespace App\Policy;

use Authorization\IdentityInterface;
use Authentication\IdentityInterface as AuthenticationIdentityInterface;
use App\Model\Entity\Apostila;

class ApostilaPolicy {
    public function canView(IdentityInterface $user, Apostila $apostila): bool
    {
        /** @var \App\Model\Entity\User $userEntity */
        $userEntity = $user->getOriginalData();

        return $apostila->user_id === $userEntity->id;
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
        /** @var \App\Model\Entity\User $userEntity */
        $userEntity = $user->getOriginalData();

        return $apostila->user_id === $userEntity->id;
    }
}
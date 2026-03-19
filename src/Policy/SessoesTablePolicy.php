<?php
declare(strict_types=1);

namespace App\Policy;

use Authorization\IdentityInterface;

class SessoesTablePolicy
{
    public function canIndex(IdentityInterface $user, $resource)
    {
        return true;
    }
}
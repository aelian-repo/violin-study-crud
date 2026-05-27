<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Table\SessoesTable;
use Authorization\IdentityInterface;

class SessoesTablePolicy
{
    public function canIndex(IdentityInterface $user, SessoesTable $resource): bool
    {
        return true;
    }
}
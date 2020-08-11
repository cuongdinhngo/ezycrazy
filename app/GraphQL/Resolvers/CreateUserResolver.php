<?php

namespace App\GraphQL\Resolvers;

use App\Models\User;
use Atom\File\Log;

class CreateUserResolver implements ResolverInterface
{
    /**
     * Resolve
     * @param  [type] $rootValue [description]
     * @param  [type] $args      [description]
     * @param  [type] $context   [description]
     * @return [type]            [description]
     */
    public function resolve($rootValue, $args, $context)
    {
        $userObj = new User();
        $userObj->enableQueryLog();
        $userId = $userObj->insert($args);
        $userData = $userObj->where(['id', $userId])->get();
        Log::info($userObj->getQueryLog());
        return $userData;
    }
}

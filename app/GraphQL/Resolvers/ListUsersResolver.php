<?php

namespace App\GraphQL\Resolvers;

use App\Models\User;
use Atom\File\Log;

class ListUsersResolver implements ResolverInterface
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
        Log::info(__METHOD__);
        $userObj = new User();
        $userObj->enableQueryLog();
        $users = $userObj->get();
        Log::info($userObj->getQueryLog());
        return $users;
    }
}

<?php

namespace App\GraphQL\Resolvers;

use App\Models\User;
use Atom\File\Log;

class ShowUserResolver implements ResolverInterface
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
        $user = $userObj->where(['id', $args['id']])->get();
        Log::info($userObj->getQueryLog());
        return $user;
    }
}

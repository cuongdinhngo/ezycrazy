<?php

namespace App\GraphQL\Resolvers;

class EchoerResolver implements ResolverInterface
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
        return $rootValue['prefix'].$args['message'];
    }
}

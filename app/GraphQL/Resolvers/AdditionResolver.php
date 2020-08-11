<?php

namespace App\GraphQL\Resolvers;

class AdditionResolver implements ResolverInterface
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
        return $args['x'] + $args['y'];
    }
}

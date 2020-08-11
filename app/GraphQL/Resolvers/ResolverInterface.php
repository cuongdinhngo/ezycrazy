<?php

namespace App\GraphQL\Resolvers;

interface ResolverInterface
{
    public function resolve($rootValue, $args, $context);
}

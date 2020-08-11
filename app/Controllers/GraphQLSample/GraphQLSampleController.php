<?php

namespace App\Controllers\GraphQLSample;

use Atom\Controllers\Controller as BaseController;
use Atom\Http\Request;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Schema;
use GraphQL\GraphQL;
use GraphQL\Utils\BuildSchema;
use App\GraphQL\Resolvers\AdditionResolver;
use App\GraphQL\Resolvers\EchoerResolver;

class GraphQLSampleController extends BaseController
{
    /**
     * Construct class
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * GraphQL sayHello
     *
     * @return json
     */
    public function sayHello()
    {
        try {
            $queryType = new ObjectType([
                'name' => 'Greeting',
                'fields' => [
                    'echo' => [
                        'type' => Type::string(),
                        'args' => [
                            'message' => ['type' => Type::string()],
                        ],
                        'resolve' => function ($rootValue, $args) {
                            return $rootValue['prefix'] . $args['message'];
                        }
                    ],
                ],
            ]);

            $mutationType = new ObjectType([
                'name' => 'Calc',
                'fields' => [
                    'sum' => [
                        'type' => Type::int(),
                        'args' => [
                            'x' => ['type' => Type::int()],
                            'y' => ['type' => Type::int()],
                        ],
                        'resolve' => function ($calc, $args) {
                            $calc;
                            return $args['x'] + $args['y'];
                        },
                    ],
                ],
            ]);

            // See docs on schema options:
            // http://webonyx.github.io/graphql-php/type-system/schema/#configuration-options
            $schema = new Schema([
                'query' => $queryType,
                'mutation' => $mutationType,
            ]);

            $rawInput = file_get_contents('php://input');
            $input = json_decode($rawInput, true);
            $query = $input['query'];
            $variableValues = isset($input['variables']) ? $input['variables'] : null;

            $rootValue = ['prefix' => 'You said: '];
            $result = GraphQL::executeQuery($schema, $query, $rootValue, null, $variableValues);
            $output = $result->toArray();
        } catch (\Exception $e) {
            $output = [
                'error' => [
                    'message' => $e->getMessage()
                ]
            ];
        }
        header('Content-Type: application/json; charset=UTF-8');
        echo json_encode($output);
    }

    /**
     * Root value
     *
     * @return array
     */
    public function rootValueGreeting()
    {
        return [
            'echo' => function ($rootValue, $args, $context) {
                $echo = new EchoerResolver();
                return $echo->resolve($rootValue, $args, $context);
            },
            'prefix' => 'You said: ',
        ];
    }

    /**
     * Shorthand Greeting
     *
     * @return json
     */
    public function shorthandGreeting()
    {
        try {
            $schema = BuildSchema::build(file_get_contents(DOC_ROOT.'/../app/GraphQL/Schema/schema.graphqls'));
            $rootValue = $this->rootValueGreeting();
            $rawInput = file_get_contents('php://input');
            $input = json_decode($rawInput, true);
            $query = $input['query'];
            $variableValues = isset($input['variables']) ? $input['variables'] : null;

            $result = GraphQL::executeQuery($schema, $query, $rootValue, null, $variableValues);
        } catch (\Exception $e) {
            $result = [
                'error' => [
                    'message' => $e->getMessage()
                ]
            ];
        }
        header('Content-Type: application/json; charset=UTF-8');
        echo json_encode($result);
    }

    /**
     * Root value
     *
     * @return array
     */
    public function rootValueCalc()
    {
        return [
            'sum' => function ($rootValue, $args, $context) {
                $sum = new AdditionResolver();
                return $sum->resolve($rootValue, $args, $context);
            },
        ];
    }

    /**
     * Shorthand Calc
     *
     * @return json
     */
    public function shorthandCalc()
    {
        try {
            $schema = BuildSchema::build(file_get_contents(DOC_ROOT.'/../app/GraphQL/Schema/schema.graphqls'));
            $rootValue = $this->rootValueCalc();
            $rawInput = file_get_contents('php://input');
            $input = json_decode($rawInput, true);
            $query = $input['query'];
            $variableValues = isset($input['variables']) ? $input['variables'] : null;

            $result = GraphQL::executeQuery($schema, $query, $rootValue, null, $variableValues);
        } catch (\Exception $e) {
            $result = [
                'error' => [
                    'message' => $e->getMessage()
                ]
            ];
        }
        header('Content-Type: application/json; charset=UTF-8');
        echo json_encode($result);
    }
}

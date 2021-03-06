<?php


namespace Stefmachine\QueryBuilder\Expressions;

use Stefmachine\QueryBuilder\Adapter\QueryAdapterInterface;
use Stefmachine\QueryBuilder\Builder\QueryBuilderInterface;

class AndX implements QueryExpressionInterface
{
    protected $parts;
    
    public function __construct(QueryExpressionInterface ...$_andX)
    {
        $this->parts = $_andX;
    }
    
    public function buildOnQuery(QueryBuilderInterface $_qb, QueryAdapterInterface $_adapter): string
    {
        $and = [];
        foreach ($this->parts as $part){
            $and[] = $part->buildOnQuery($_qb, $_adapter);
        }
        $and = implode(' AND ', $and);
        return "({$and})";
    }
}
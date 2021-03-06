<?php


namespace Stefmachine\QueryBuilder\Expressions;


use Stefmachine\QueryBuilder\Adapter\QueryAdapterInterface;
use Stefmachine\QueryBuilder\Builder\QueryBuilderInterface;

class LessThanOrEqual implements QueryExpressionInterface
{
    protected $field;
    protected $value;
    
    public function __construct($_field, $_lessThanOrEqual)
    {
        $this->field = $_field instanceof QueryExpressionInterface ? $_field : Column::from($_field);
        $this->value = $_lessThanOrEqual;
    }
    
    public function buildOnQuery(QueryBuilderInterface $_qb, QueryAdapterInterface $_adapter): string
    {
        $field = $this->field->buildOnQuery($_qb, $_adapter);
        if($this->value instanceof QueryExpressionInterface){
            $value = $this->value->buildOnQuery($_qb, $_adapter);
        }
        else{
            $value = $_qb->addParam($this->value);
        }
        return "{$field} <= {$value}";
    }
}
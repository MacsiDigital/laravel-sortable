<?php

namespace MacsiDigital\Sortable;

trait Sortable
{
    protected $defaultSortable = 'id';

    public function scopeSortable($query, $fields=[]) 
    {
    	foreach($fields as $field){
    		list($field, $direction) = explode('-', $field);
    		$query->orderBy($field, $direction);
    	}
    	return $query;
    }
}

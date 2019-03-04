<?php

namespace MacsiDigital\Sortable;

trait Sortable
{
    protected $defaultSortable = 'id';

    public function scopeSortable($query, $fields=[]) 
    {
		foreach($fields as $field){
			if($field != ''){
				list($field, $direction) = explode('-', $field);
				if(in_array($field, $this->sortable)){
					$query->orderBy($field, $direction);		
				}
			}
    	}	
    	return $query;
    }
}

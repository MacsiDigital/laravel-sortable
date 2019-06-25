<?php

namespace MacsiDigital\Sortable\Traits;

trait Sortable
{
    protected $defaultSortable = 'id';

    public function scopeSortable($query, $fields = [])
    {
        foreach ($fields as $field) {
            if ($field != '') {
                $direction = '';
                [$field, $direction] = explode('-', $field);
                if (in_array($field, $this->sortable)) {
                    if (isset($this->extended_joins) && is_array($this->extended_joins) && array_key_exists($field, $this->extended_joins)) {
                        $detail = $this->extended_joins[$field];
                        $query->join($detail['foreign_table'], $detail['table_field'], $detail['foreign_table_field']);
                        if (in_array($detail['restrict_table_field'])) {
                            $query->where($detail['restrict_table_field'], $detail['restrict_value']);
                        }
                    }
                    $query->orderBy($field, $direction);
                }
            }
        }

        return $query;
    }
}

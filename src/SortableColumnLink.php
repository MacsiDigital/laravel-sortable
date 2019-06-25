<?php

namespace MacsiDigital\Sortable;

class SortableColumnLink
{
    /**
     * @param array $parameters
     *
     * @return string
     */
    public static function render(array $parameters)
    {

        // $column, $variables
        $column = '';
        $variables = '';
        [$column, $variables] = self::parseParameters($parameters);

        $label = self::formLabel($column, $variables);

        $href = self::formHref($column);

        $vars = self::formParameters($variables);

        return '<a href="'.$href.'" '.$vars.'>'.$label.'</a>';
    }

    /**
     * @param array $parameters
     *
     * @return array
     */
    public static function parseParameters(array $parameters)
    {
        $column = $parameters[0];
        if (isset($parameters[1])) {
            $variables = $parameters[1];
        } else {
            $variables = [];
        }

        return [$column, $variables];
    }

    /**
     * @param string $column
     * @param array $variables
     *
     * @return string
     */
    private static function formLabel($column, $variables)
    {
        if (isset($variables['label'])) {
            $label = $variables['label'];
        } else {
            $label = ucfirst($column);
        }
        if (config('sortable.use-icon')) {
            $sorts = [];
            foreach (request()->query() as $k => $v) {
                if ($k == 'sort') {
                    $sorts = explode(',', $v);
                }
            }
            if ($sorts != []) {
                foreach ($sorts as $sort) {
                    $field = '';
                    $direction = '';
                    [$field, $direction] = explode('-', $sort);
                    if ($field == $column) {
                        if ($direction == 'asc') {
                            $label .= ' '.config('sortable.asc-icon');
                        } elseif ($direction == 'desc') {
                            $label .= ' '.config('sortable.desc-icon');
                        }
                    }
                }
            } else {
                $label .= ' '.config('sortable.none-icon');
            }
        }

        return $label;
    }

    private static function formHref($column)
    {
        $href = '/'.request()->path().'?';
        $query = '';
        $sorts = [];
        foreach (request()->query() as $k => $v) {
            if ($k != 'sort') {
                $href .= $k.'='.$v;
            } else {
                $sorts = explode(',', $v);
            }
        }
        if ($sorts != []) {
            $i = 1;
            $column_in_sort = false;
            foreach ($sorts as $sort) {
                $field = '';
                $direction = '';
                [$field, $direction] = explode('-', $sort);
                if ($field == $column) {
                    $column_in_sort = true;
                    $query .= self::formThisColumn($direction, $column, $i);
                } else {
                    if ($i > 1) {
                        $query .= ',';
                    }
                    $query .= $field.'-'.$direction;
                    $i++;
                }
            }
            if (! $column_in_sort) {
                if ($i > 1) {
                    $query .= ',';
                }
                $query .= $column.'-asc';
            }
        } else {
            $query .= $column.'-asc';
        }
        if ($query != '') {
            return $href.'&sort='.$query;
        } else {
            return $href;
        }
    }

    private static function formThisColumn($direction, $column, &$i)
    {
        if ($direction == 'desc') {
            return '';
        } elseif ($direction == 'asc') {
            $pre = '';
            if ($i > 1) {
                $pre = ',';
            }
            $i++;

            return $pre.$column.'-desc';
        }
    }

    private static function formParameters($variables)
    {
        $string = '';
        foreach ($variables as $k => $v) {
            $string .= ' '.$k.'="'.$v.'"';
        }

        return $string;
    }
}

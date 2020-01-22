<?php

namespace App\Nova\Filters;

use Illuminate\Http\Request;
use Laravel\Nova\Filters\BooleanFilter;

class FilmLength extends BooleanFilter
{
    /**
     * Apply the filter to the given query.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(Request $request, $query, $value)
    {
        $options_to_length = [
            'short' => [1, 20],
            'medium' => [20, 90],
            'long' => [90, 300]
        ];

        // (cool) Useful query building. Might be able to use conditional clause with reduce

        foreach ($value as $filter_option => $is_filter_on) {
            if ($is_filter_on) {
                $query->orWhereBetween('length', $options_to_length[$filter_option]);
            }
        }

        return $query;
    }

    /**
     * Get the filter's available options.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function options(Request $request)
    {
        return [
            'Short' => 'short',
            'Medium' => 'medium',
            'Long' => 'long'
        ];
    }

    private function getQueryOperator($value) {
        //
    }
}

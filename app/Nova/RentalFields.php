<?php

namespace App\Nova;

use Laravel\Nova\Fields\DateTime;

class RentalFields
{
    /**
     * Get the pivot fields for the relationship.
     *
     * @return array
     */
    public function __invoke()
    {
        return [
            DateTime::make('Rental Date')
                ->hideWhenCreating()
                ->hideWhenUpdating(),

            DateTime::make('Return Date')
                ->rules('after:today')
        ];
    }
}

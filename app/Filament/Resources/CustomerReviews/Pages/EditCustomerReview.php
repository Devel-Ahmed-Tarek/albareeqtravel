<?php

namespace App\Filament\Resources\CustomerReviews\Pages;

use App\Filament\Resources\CustomerReviews\CustomerReviewResource;
use Filament\Resources\Pages\EditRecord;

class EditCustomerReview extends EditRecord
{
    protected static string $resource = CustomerReviewResource::class;
}

<?php

namespace ExclusiveDev\FileLeech\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Schema;

class GetRequest extends AttachmentRequest
{
    public function rules(): array
    {        
        return parent::rules() + [			
            'order_by' => ['required', Rule::in(Schema::getColumnListing((new $this->model)->getTable()))],
            'order_direction' => 'in:asc,desc'
        ];
    }
}

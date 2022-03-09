<?php

namespace ExclusiveDev\FileLeech\Http\Requests;

class SaveRequest extends AttachmentRequest
{
    public function rules(): array
    {
        return parent::rules() + [			
            'file.*' => 'file|max:2048|mimes:jpeg,jpg,png,gif,svg,bmp,pdf,doc,docx,xls,xlsx,txt,mp4'
        ];
    }
}
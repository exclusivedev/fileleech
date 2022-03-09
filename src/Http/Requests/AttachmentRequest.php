<?php

namespace ExclusiveDev\FileLeech\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Encryption\DecryptException;
use ExclusiveDev\FileLeech\Contracts\Attachable;

class AttachmentRequest extends FormRequest
{
    protected $type;
    protected $id;
    protected $model;

    public function attachable()
    {        
        return $this->type::findOrFail($this->id);
    }

    public function rules(): array
    {
        $this->model = config('attachments.models.attachment');
        return [
			'encrypted_key' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {                    
                    try {
                        $decryptedModelData = decrypt($value);
			            $this->type = $decryptedModelData['type'];
                        $this->id = $decryptedModelData['id'];
                    } catch (DecryptException $e) {
                        $fail("Decryption has failed");
                    }

                    if (! class_exists($this->type, true)) {
                        $fail($this->type." is not a valid class");
                    }

                    if (! in_array(Model::class, class_parents($this->type))) {
                        $fail($this->type." is not a model");
                    }

                    if (! in_array(Attachable::class, class_implements($this->type))) {
                        $fail($this->type." is not attachable");
                    }
                },
            ]
        ];
    }
}

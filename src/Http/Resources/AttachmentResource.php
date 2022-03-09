<?php

namespace ExclusiveDev\FileLeech\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use ExclusiveDev\FileLeech\Contracts\AttachmentPreprocessor;

class AttachmentResource extends JsonResource
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'attachment' => self::attachment($this->attachment),
            'created_at' => $this->created_at,
            'attacher' => self::user($this->attacher)
        ];
    }

    /**
     * @param string $attachment
     * @return string
     */
    protected static function attachment(string $attachment): string
    {
        $config = config('attachments.api.get.preprocessor.attachment');

        if (!\class_exists($config)) {
            return $attachment;
        }

        $preprocessor = new $config;

        if ($preprocessor instanceof AttachmentPreprocessor) {
            $attachment = $preprocessor->process($attachment);
        }

        return $attachment;
    }

    protected static function user($user)
    {
        $config = config('attachments.api.get.preprocessor.user');
        $default = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email
        ];

        if (!\class_exists($config)) {
            return $default;
        }

        $preprocessor = new $config;

        if ($preprocessor instanceof AttachmentPreprocessor) {
            return $preprocessor->process($user);
        }

        return $default;
    }
}
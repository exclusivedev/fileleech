<?php

namespace ExclusiveDev\FileLeech\Contracts;

/**
 * Preprocessor class Interface
 *
 * Interface IAttachmentPreprocessor
 * @package ExclusiveDev\FileLeech\Contracts
 */
interface AttachmentPreprocessor
{
    public function process($object);
}
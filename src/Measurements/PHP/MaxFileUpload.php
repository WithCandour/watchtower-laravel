<?php

namespace Watchtower\WatchtowerLaravel\Measurements\PHP;

use Watchtower\WatchtowerLaravel\Measurements\Measurement;

class MaxFileUpload extends Measurement
{
    public function key(): string
    {
        return 'php.upload_max_filesize';
    }

    public function value(): ?string
    {
        return ini_get('upload_max_filesize');
    }

    public function type(): string
    {
        return Measurement::TYPE_STRING;
    }
}

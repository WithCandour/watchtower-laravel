<?php

namespace Watchtower\WatchtowerLaravel\Measurements\Statamic;

use Watchtower\WatchtowerLaravel\Measurements\Measurement;

class LicenseStatus extends Measurement
{
    public function key(): string
    {
        return 'statamic.license.status';
    }

    public function value(): ?string
    {
        if (!class_exists(\Statamic\Licensing\LicenseManager::class)) {
            return null;
        }

        try {
            $licenseManager = app(\Statamic\Licensing\LicenseManager::class);
            $statamicLicense = $licenseManager->statamic();

            if (!$statamicLicense) {
                return 'unlicensed';
            }

            return $statamicLicense->valid() ? 'valid' : 'invalid';
        } catch (\Exception $e) {
            return 'error';
        }
    }

    public function type(): string
    {
        return Measurement::TYPE_STRING;
    }
}

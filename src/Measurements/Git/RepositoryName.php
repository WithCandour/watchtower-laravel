<?php

namespace Watchtower\WatchtowerLaravel\Measurements\Git;

use Illuminate\Support\Facades\Process;

class RepositoryName extends Measurement
{
    public function key(): string
    {
        return 'git.repository_name';
    }

    public function value(): ?string
    {
        $originUrl = Process::run('git remote get-url origin')->output();
        $originUrl = trim($originUrl);

        if (empty($originUrl)) {
            return null;
        }

        // Handle SSH format: git@github.com:user/repo.git
        if (str_contains($originUrl, ':')) {
            $parts = explode(':', $originUrl);
            $repoWithExt = end($parts);
        } else {
            // Handle HTTPS format: https://github.com/user/repo.git
            $parts = explode('/', $originUrl);
            $repoWithExt = end($parts);
        }

        // Remove .git extension
        return str_replace('.git', '', $repoWithExt);
    }

    public function type(): string
    {
        return Measurement::TYPE_STRING;
    }
}
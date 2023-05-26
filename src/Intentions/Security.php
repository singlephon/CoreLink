<?php

namespace Singlephon\Corelink\Intentions;

trait Security
{
    private string $algorithm = 'sha256';
    public function assertChecksum(string $data, string $key, string $checksum): bool
    {
        $encrypted = $this->checksumGenerate($data, $key);
        return $encrypted == $checksum;
    }

    public function checksumGenerate(string $data, string $key): string
    {
        return hash_hmac($this->algorithm, $data, $key);
    }
}

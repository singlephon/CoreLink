<?php

namespace Singlephon\Corelink\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RegisterServiceResource extends JsonResource
{
    private string $checksum;
    public function __construct($resource, $checksum)
    {
        parent::__construct($resource);
        $this->checksum = $checksum;
    }

    public function toArray($request)
    {
        return [
            'registerKey' => $this->checksum
        ];
    }
}

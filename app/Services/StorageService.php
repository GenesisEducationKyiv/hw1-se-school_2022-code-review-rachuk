<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class StorageService
{
    /**
     * @var string|null
     */
    private ?string $resource;

    public function __construct()
    {
        $this->resource = Storage::disk('local')->get('mail.txt');
    }

    /**
     * @param string $email
     * @return bool
     */
    public function isEmailExist(string $email): bool
    {
        return strripos($this->resource, $email) === false;
    }

    /**
     * @param string $email
     * @return void
     */
    public function save(string $email): void
    {
        Storage::disk('local')->append('mail.txt', $email);
    }

    /**
     * @return array
     */
    public function getEmails(): array
    {
        $emails = explode("\n", $this->resource);
        foreach ($emails as $key => $email) {
            if ($email == '') {
                unset($emails[$key]);
            }
        }

        return $emails;
    }
}

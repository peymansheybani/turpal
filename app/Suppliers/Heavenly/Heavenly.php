<?php

namespace App\Suppliers\Heavenly;

use App\Suppliers\Contracts\ISupplier;
use Illuminate\Support\Facades\Http;

class Heavenly implements ISupplier
{
    const LIST_URL = 'heavenly/api/tours';
    const DETAIL_URL = 'heavenly/api/tours/';
    const PRICE_URL = 'heavenly/api/tour-prices';
    const AVAILABILITY_URL = 'heavenly/api/tours/{id}/availability';

    public function __construct(private array $config)
    {
    }

    public function list(int $page = 1, int $limit = 10): array
    {
        try {
            $response = Http::withOptions([
                'verify' => true,
            ])->get($this->config['base_url'] . DIRECTORY_SEPARATOR . self::LIST_URL .'?page=' . $page . '&limit=' . $limit);

            if ($response->ok()) {
                return $response->json("data");
            }

            return [];
        } catch (\Exception $exception) {
            // TODO add log for check error
            return [];
        }
    }

    public function detail(int|string $id): array
    {
        try {
            $response = Http::get($this->config['base_url'] . DIRECTORY_SEPARATOR . self::DETAIL_URL . $id);

            if ($response->ok()) {
                return $response->json();
            }

            return [];
        } catch (\Exception $exception) {
            // TODO add log for check error

            return [];
        }
    }

    public function getPrice(int|string $id, int $page = 1, int $limit = 10): array
    {
        try {
            $response = Http::get($this->config['base_url'] . DIRECTORY_SEPARATOR . self::PRICE_URL . '?page=' . $page . '&limit=' . $limit. '&id=' . $id);

            if ($response->ok()) {
                return $response->json('data');
            }

            return [];
        } catch (\Exception $exception) {
            // TODO add log for check error

            return [];
        }
    }

    public function availability(int|string $id) : bool
    {
        try {
            $url = str_replace('{id}', $id, self::AVAILABILITY_URL);
            $response = Http::get($this->config['base_url'] . DIRECTORY_SEPARATOR . $url);

            if ($response->ok()) {
                return $response->json('available');
            }

            return false;
        } catch (\Exception $exception) {
            // TODO add log for check error

            return false;
        }
    }
}

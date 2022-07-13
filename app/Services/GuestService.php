<?php

namespace App\Services;

use App\Services\BaseService;
use App\Models\Customer;
use App\Repositories\GuestRepository;

class GuestService extends BaseService
{
    /**
    * @var \App\Repositories\GuestRepository $guestRepository.
    */
    protected $guestRepository;

    /**
     * CustomerService construct
     *
     * @param \App\Repositories\GuestRepository $guestRepository Guest repository.
     * @return void
     */
    public function __construct(GuestRepository $guestRepository)
    {
        $this->guestRepository = $guestRepository;
        parent::__construct();
    }

    /**
     * @return \App\Repositories\GuestRepository
     */
    public function getRepository()
    {
        return GuestRepository::class;
    }
}
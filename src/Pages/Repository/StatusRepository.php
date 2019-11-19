<?php

namespace CapstoneLogic\Pages\Repository;

use Woodoocoder\LaravelHelpers\DB\Repository;
use CapstoneLogic\Pages\Model\Status;

class StatusRepository extends Repository {
    
    /**
     * @param Collection $collection
     */
    public function __construct(Status $status) {
        parent::__construct($status);
        
    }
}

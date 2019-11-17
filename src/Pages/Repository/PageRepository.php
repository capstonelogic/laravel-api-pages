<?php

namespace CapstoneLogic\Pages\Repository;

use Woodoocoder\LaravelHelpers\DB\Repository;
use CapstoneLogic\Pages\Model\Page;

class PageRepository extends Repository {
    
    /**
     * @param Collection $collection
     */
    public function __construct(Page $page) {
        parent::__construct($page);
        
    }

    /**
     * @param int $perPage
     * @param string $orderBy
     * @param string $sortBy
     * 
     * @return LengthAwarePaginator
     */
    public function search(
        int $perPage = 20,
        string $orderBy = 'id',
        string $sortBy = 'desc',
        string $search= null) {

        $query = $this->model->query();

        if($search !== null) {
            $query->where('title', 'LIKE', '%'.$search.'%');
        }

        return $query->orderBy($orderBy, $sortBy)->paginate($perPage);
    }
}
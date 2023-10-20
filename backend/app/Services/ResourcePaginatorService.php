<?php

namespace App\Services;

class ResourcePaginatorService
{
    public $lengthAwarePaginator,$resource,$result,$items;


    public function __construct($lengthAwarePaginator,$resource) {
        $this->lengthAwarePaginator = $lengthAwarePaginator;
        $this->resource = $resource;
        $this->items = $lengthAwarePaginator->items();
    }
    public function getResponse(){
        return $this->resource::collection($this->items)->additional([
            'current_page'=>$this->lengthAwarePaginator->resolveCurrentPage(),
            'per_page'=>$this->lengthAwarePaginator->perPage(),
            'total'=>$this->lengthAwarePaginator->total(),
            'last_page'=>$this->lengthAwarePaginator->lastPage()
        ]);
    }


}

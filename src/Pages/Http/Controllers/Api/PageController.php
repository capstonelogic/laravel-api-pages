<?php

namespace CapstoneLogic\Pages\Http\Controllers\Api;

use Illuminate\Http\Request;
use Woodoocoder\LaravelHelpers\Api\Controller;
use Woodoocoder\LaravelHelpers\Api\Response\ApiMessage;
use Woodoocoder\LaravelHelpers\Api\Response\ApiStatus;

use CapstoneLogic\Pages\Resource\PageResource;
use CapstoneLogic\Pages\Model\Page;
use CapstoneLogic\Pages\Repository\PageRepository;
use CapstoneLogic\Pages\Http\Request\SearchRequest;
use CapstoneLogic\Pages\Http\Request\CreateRequest;
use CapstoneLogic\Pages\Http\Request\UpdateRequest;

class PageController extends Controller
{

    private $pageRepo;
    public function __construct(PageRepository $pageRepo) {
        $this->pageRepo = $pageRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SearchRequest $request)
    {
        $data = $request->all();

        $params = [];
        if(isset($data['per_page'])) {
            $params[] = $data['per_page']<=20 ? $data['per_page'] : 20;
        }
        if(isset($data['order_by'])) {
            $params[] = $data['order_by'];
        }
        if(isset($data['sort'])) {
            $params[] = $data['sort'];
        }
        if(isset($data['search'])) {
            $params[] = $data['search'];
        }
        $pages = $this->pageRepo->search(...$params);
        
        return PageResource::collection($pages);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        return new PageResource($this->pageRepo->create($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        return new PageResource($page);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Page $page)
    {
        $isUpdated = $this->pageRepo->update($request->all(), $page->id);
        
        if($isUpdated) {
            $page = $this->pageRepo->find($page->id);
            return new PageResource($page);
        }
        else {
            return new PageResource($page, ApiStatus::ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        if($page->delete()) {
            return new ApiMessage();
        }
        else {
            return new ApiMessage(ApiStatus::ERROR);
        }
    }
}

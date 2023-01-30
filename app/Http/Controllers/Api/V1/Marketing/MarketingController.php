<?php

namespace App\Http\Controllers\Api\V1\Marketing;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Marketing\StoreMarketingRequest;
use App\Http\Requests\Api\Marketing\UpdateMarketingRequest;
use App\Http\Resources\Api\V1\Marketing\GetAllMarketingResource;
use App\Models\Admin;
use Illuminate\Http\Request;

class MarketingController extends Controller
{
    public function index()
    {
        $admin = Admin::where('role', Admin::MARKETING)->paginate(10);

        return GetAllMarketingResource::collection($admin);
    }

    public function store(StoreMarketingRequest $request)
    {
        $marketing = new Admin();

        $marketing->fill($request->except('image'));

        if($request->image) {
            $marketing->image = $request->image;
        }

        $marketing->role = Admin::MARKETING;
        $marketing->saveOrFail();

        return $this->success();
    }

    public function update(UpdateMarketingRequest $request, Admin $marketing)
    {
        $marketing->fill($request->except('image'));

        if($request->image) {
            $marketing->image = $request->image;
        }

        $marketing->role = Admin::MARKETING;
        $marketing->saveOrFail();

        return $this->success();
    }

    public function destroy(Admin $marketing)
    {
        $marketing->delete();

        return $this->success();
    }
}

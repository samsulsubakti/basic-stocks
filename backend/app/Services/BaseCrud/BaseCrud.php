<?php

namespace App\Services\BaseCrud;

use App\Services\BaseCrud\Traits\HasCrudHooks;
use App\Services\BaseCrud\Traits\HasCrudPrepareQuery;
use App\Services\BaseCrud\Traits\HasCrudSuccessResult;
use App\Services\BaseCrud\Traits\HasDBSafe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BaseCrud extends Controller
{

    use HasCrudHooks, HasCrudPrepareQuery, HasCrudSuccessResult, HasDBSafe;

    public $model;

    public $resource;

    public $row;

    public $searchAble = [];

    public $modelKey = 'id';

    public $storeValidator;

    public $updateValidator;

    public $relationList = [];

    public $relationShow = [];

    public $lockRelationParam = false;

    public $paginationPerPage = 10;

    public $defaultOrder = 'id';

    public $defaultSort = 'asc';

    public $requestData;

    public $query;

    public $cacheInMinute = 10;

    public $enableBulkDelete = true;

    public $abilityPolicyIndex = 'viewAny';

    public $abilityPolicyShow = 'view';

    public $abilityPolicyStore = 'create';

    public $abilityPolicyUpdate = 'update';

    public $abilityPolicyDelete = 'delete';

    public $abilityPolicyBulkDelete = 'bulkDelete';

    public $dontAddSelectOnPrepareSortAndOrder = false;


    public function index(Request $request)
    {
        if (!empty($this->abilityPolicyIndex)) {
            $this->authorize($this->abilityPolicyIndex, $this->model);
        }

        $this->requestData = $request;

        if ($ress = $this->__prepareCacheResult()) {
            return $ress;
        }

        $this->query = $this->model::query();

        $this->__prepareQueryRelationList();

        $this->__prepareQueryList();

        $this->__prepareQuerySearchAbleList();

        $this->__prepareQueryOptionsList();

        if ($ress = $this->__beforeList()) {
            return $ress;
        }

        $this->__prepareQuerySortOrderList();

        $this->__prepareQueryLimitList();

        $query = $this->__prepareQueryListType();

        $this->__prepareLoadRelation($query);

        return $this->__successList($query);
    }


    public function store(Request $request)
    {
        return $this->DBSafe(
            function () {
                if (!empty($this->abilityPolicyStore)) {
                    $this->authorize($this->abilityPolicyStore, $this->model);
                }

                $req = app($this->storeValidator);

                $this->requestData = $req;

                $dt = new $this->model();

                $data = $req->validated();

                $data = $this->__prepareDataStore($data);

                if ($ress = $this->__beforeStore()) {
                    return $ress;
                }

                $dt->fill($data);

                $dt->save();

                $this->row = $dt;

                if ($ress = $this->__afterStore()) {
                    return $ress;
                }

                $this->__prepareLoadRelation($this->row);

                return $this->__successStore();
            }
        );
    }

    public function show(Request $request, $id)
    {
        $this->requestData = $request;

        if ($ress = $this->__prepareCacheResult()) {
            return $ress;
        }

        $this->query = $this->model::where($this->modelKey, $id);

        $this->__prepareQueryRelationShow();

        $this->__prepareQueryRowShow();

        $this->row = $this->query->firstOrFail();

        if (!empty($this->abilityPolicyShow)) {
            $this->authorize($this->abilityPolicyShow, $this->row);
        }

        $this->__prepareLoadRelation($this->row);

        if ($ress = $this->__beforeShow()) {
            return $ress;
        }

        return $this->__successShow();
    }

    public function update(Request $request, $id)
    {
        return $this->DBSafe(
            function () use ($id) {
                $req = app($this->updateValidator);

                $this->requestData = $req;

                $this->query = $this->model::where($this->modelKey, $id);

                $this->__prepareQueryRowUpdate();

                $this->row = $this->query->firstOrFail();

                if (!empty($this->abilityPolicyUpdate)) {
                    $this->authorize($this->abilityPolicyUpdate, $this->row);
                }

                $data = $req->validated();

                $data = $this->__prepareDataUpdate($data);

                if ($ress = $this->__beforeUpdate()) {
                    return $ress;
                }

                $this->row->fill($data);

                $this->row->save();

                if ($ress = $this->__afterUpdate()) {
                    return $ress;
                }

                $this->__prepareLoadRelation($this->row);

                return $this->__successUpdate();
            }
        );
    }


    public function destroy($id)
    {
        return $this->DBSafe(
            function () use ($id) {

                $ids = request()->input('ids');

                if (!empty($ids) && $this->enableBulkDelete) {
                    return $this->bulkDestroy($ids);
                }

                $this->query = $this->model::where($this->modelKey, $id);

                $this->__prepareQueryRowDestroy();

                $this->row = $this->query->firstOrFail();

                if (!empty($this->abilityPolicyDelete)) {
                    $this->authorize($this->abilityPolicyDelete, $this->row);
                }

                if ($ress = $this->__beforeDestroy()) {
                    return $ress;
                }

                $this->row->delete();

                if ($ress = $this->__afterDestroy()) {
                    return $ress;
                }

                return $this->__successDestroy();
            }
        );
    }

    public function bulkDestroy($ids)
    {
        return $this->DBSafe(
            function () use ($ids) {

                $this->query = $this->model::whereIn($this->modelKey, $ids);

                $this->__prepareQueryBulkDestroy();

                if (!empty($this->abilityPolicyBulkDelete)) {
                    $this->authorize($this->abilityPolicyBulkDelete, [ $this->model, ["ids" => $ids]]);
                }

                if ($ress = $this->__beforeBulkDestroy()) {
                    return $ress;
                }

                $this->query->delete();

                if ($ress = $this->__afterBulkDestroy()) {
                    return $ress;
                }

                return $this->__successBulkDestroy();
            }
        );
    }
}

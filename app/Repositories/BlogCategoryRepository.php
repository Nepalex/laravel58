<?php

namespace App\Repositories;

use App\Models\BlogCategory as Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
//use Your Model

/**
 * Class BlogCategoryRepository.
 */

class BlogCategoryRepository extends CoreRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function getModelClass()
    {
        return Model::class;
    }

    /**
     * Get Model for edit in Admin
     *
     * @param int $id
     * return Model
     */

    public function  getEdit($id){
        return $this->startConditions()->find($id);

    }

    /**
     * Get Categories List for display in dropdown
     *
     * return Collection
     */
    public function getForCombobox(){

        $columns = implode(',', [
            'id',
            'CONCAT (id,". " , title) AS id_title',
            ]);

       /* $result[] = $this
            ->startConditions()->all();

        $result[] = $this
            ->startConditions()
            ->select(\DB::raw('CONCAT (id,". " , title) AS id_title'))
            ->toBase()
            ->get();*/

        $result= $this
            ->startConditions()
            ->selectraw($columns)
            ->toBase()
            ->get();

        return $result;
    }

    /**
     * получить категории для вывода пагинатором.
     * @param int|null $perPage
     * @return LengthAwarePaginator
     */
    public function getAllWithPaginate($perPage = null){

        $columns = ['id','title','parent_id'];

        $result = $this
            ->startConditions()
            ->select($columns)
            ->with([
                'parentCategory:id,title',
            ])
            ->paginate($perPage);

       // dd($result);

        return $result;

    }
}

<?php

namespace App\Swagger;

/**

 *
 * @OA\OpenApi(
 *   @OA\Server(
 *      url="/api/v1",
 *      description="stock API"
 *   ),
 *   @OA\Info(
 *      title="stock API",
 *      version="1.0.0",
 *   ),
 * )

 *
 * @OA\SecurityScheme(
 *     type="http",
 *     description="Login with email and password to get the authentication token",
 *     name="Token Based",
 *     in="header",
 *     scheme="bearer",
 *     bearerFormat="JWT",
 *     securityScheme="bearerAuth",
 * )

 *
 * @OA\Parameter(
 *  in="path",
 *  parameter="OA_id",
 *  name="id",
 *  description="Key model",
 *  required=true,
 *      @OA\Schema(
 *          type="string"
 *      )
 *  )
 *
 * @OA\Parameter(
 *  in="query",
 *  parameter="OA_listQ",
 *  description="Keyword for search data",
 *  name="q",
 *      @OA\Schema(
 *          type="string"
 *      )
 *  )
 * 
 *  @OA\Parameter(
 *  in="query",
 *  parameter="OA_exportTo",
 *  name="export_to",
 *  description="Export Type",
 *  schema={"type": "string", "enum": {"xlsx", "csv"}, "default": "xlsx"}
 *  )
 *
 * @OA\Parameter(
 *  in="query",
 *  parameter="OA_method_put",
 *  name="_method",
 *  schema={"type": "string", "enum": {"PUT"}, "default": "PUT"},
 *  required=true
 *  )
 *
 * @OA\Parameter(
 *  in="query",
 *  parameter="OA_listType",
 *  name="type",
 *  description="Type of list",
 *  schema={"type": "string", "enum": {"collection", "pagination"}, "default": "pagination"}
 *  )
 *
 *  @OA\Parameter(
 *  in="query",
 *  parameter="OA_listPage",
 *  description="Number of page usefull if type is pagination",
 *  name="page",
 *      @OA\Schema(
 *          type="string"
 *      )
 *  )
 *
 * @OA\Parameter(
 *  in="query",
 *  parameter="OA_SortBy",
 *  name="sort_by",
 *  description="Sort by",
 *  schema={"type": "string", "enum": {"asc", "desc"}}
 * )
 *
 *
 * @OA\Parameter(
 *  in="query",
 *  parameter="OA_OrderBy",
 *  name="order_by",
 *  description="Order by",
 *      @OA\Schema(
 *          type="string"
 *      )
 *  )
 *
 *
 * @OA\Parameter(
 *  in="query",
 *  parameter="OA_limit",
 *  description="Limit data",
 *  name="limit",
 *      @OA\Schema(
 *          type="integer"
 *      )
 *  )
 *
 *  @OA\Parameter(
 *  in="query",
 *  parameter="OA_Relations",
 *  description="Get relations of the model",
 *  name="relations",
 *  schema={"type": "string"}
 * )
 *
 * @OA\Parameter(
 *  in="query",
 *  parameter="OA_Cache",
 *  description="is cache result",
 *  name="is_cache",
 *  schema={"type": "string", "enum": {"1", "0"}}
 * )
 *
 *  @OA\Parameter(
 *  name="options[]",
 *  parameter="OA_options",
 *  description="Spesific search,has,and,filter,
 *  format => search,field,value
 *  eg => search,title,hot
 *  eg => search,address.country.title,indo
 *  format => has,relation_name
 *  eg => has,orders
 *  format => doesntHave,relation_name
 *  eg => doesntHave,orders
 *  format => filter,field,operation,value
 *  eg => filter,title,equal,hot
 *  eg => filter,title,is_null
 *  eg => filter,title,is_not_null
 *  eg => filter,title,between,1|100
 *  eg => filter,title,not_between,50|100
 *  eg => filter,categories.id,in,1|2|3
 *  eg => filter,categories.id,not_in,1|2|3
 *  field is support relationships
 *  list of operation => equal, not_equal, in, not_in, less_then, greater_than, less_then_equal, greater_than_equal, is_null, is_not_null, between, not_between",
 *  in="query",
 *  @OA\Schema(
 *  type="array",
 *  @OA\Items(type="string")
 *  )
 * )
 *
 * @OA\Parameter(
 *  name="ids[]",
 *  parameter="OA_ids",
 *  description="",
 *  in="query",
 *  @OA\Schema(
 *  type="array",
 *  @OA\Items(type="string")
 *  )
 * )
 *
 *
 *
 *
 *
 */





class Swagger
{
}

<?php
 namespace App\Models;

 use Illuminate\Support\Facades\DB;

 class UserManagementModel{
   protected $table = 'users';

   static function fetchAndPaginate($role,$limit = 0,$page=0){
      $offset = ($limit * $page) - $limit;
      $maxData = DB::select("select count(*) as total from users where role = '$role'");
      $data['paginate']['totalPaginasi'] = ceil(($maxData[0]->total)/ $limit);
      //var_dump($maxData[0]->total);
      $data['items'] = DB::select("select id,name,email,password from users where role = '$role' limit $offset,$limit");
      $data['paginate']['nums'] = [];
      $index = ($page % 5 == 0) ? intval($page) - (intval($page) - 4 ): (intval($page) - ((intval($page) % 5))) + 1 ;
      $loopIndex = $index;
      while (count($data['paginate']['nums']) < 5 && $loopIndex <= $data['paginate']['totalPaginasi'] ) {
         $data['paginate']['nums'][] = $loopIndex;
         $loopIndex++;
      }
      //dd($data['paginate']['nums']);
      $data['paginate']['nextBlok'] = $loopIndex <= $data['paginate']['totalPaginasi'] ?  $page + 5 : 0;
      $data['paginate']['prevBlok'] = $page >= 5 ?  $page - 5 : 0;
      //dd($data['paginate']['totalPaginasi']);
      $data['paginate']['prev'] = ($page - 1 > 0) ? $page - 1 : 0;
      $data['paginate']['first'] = ($page > 4) ? 1 : 0;
      $data['paginate']['last'] = ($page+4 < $data['paginate']['totalPaginasi']) ? $data['paginate']['totalPaginasi'] : 0;
      $data['paginate']['next'] = ($page + 1 < $data['paginate']['totalPaginasi'] )? $page + 1 : 0;
     // dd($data);
      return $data;
   }

 }

<?php
namespace App\Traits;

trait GeneralTrait
{


public function returnError($errNum, $msg)
{
return response()->json([
'status' => $errNum,
'message' => $msg
]);
}


public function returnSuccessMessage($status,$msg = "success")
{
return  response()->json( [
'status' => $status,
'message' => $msg
])->setStatusCode($status);
}

public function returnData($status,$keys,$values)
{
     $data=array_merge( ['status' => $status],array_combine($keys,$values));
        return response()->json([
            $data
        ])->setStatusCode($status);
}

    public function ReturnCreate($key,$value)
    {
        return response()->json([
           $key=>$value
        ],201);
    }
    public function ReturnUpdate($key,$value)
    {
        return response()->json([
            $key=>$value
        ],200);
    }
    public function ReturnPagenation($key,$value)
    {
        return response()->json([
            $key=>$value
            ,"current_page"
            ,"last_page"
            ,"first_page_url"
            ,"last_page_url"
            ,"prev_page_url"
            ,"next_page_url"
        ])->setStatusCode(200);
    }
}
//
//    ,$customers->currentPage()
//    ,$customers->lastPage()
//    ,$customers->url(1)
//    ,$customers->url($customers->lastPage())
//    ,$customers->previousPageUrl()
//    , $customers->nextPageUrl()

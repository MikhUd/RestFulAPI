<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use Validator;

class CountryController extends Controller
{
 
///Вспомогательные методы
    public function ifExists($id){
        $country = Country::find($id);

        if( is_null($country) ){
            return response()->json([
                'error' => true,
                'message' => 'Not found',  
            ],
            404);
            
        }
       return false;
    }

    public function checkValidate(Request $request){
        $validateRules = [                      //Создаем правила валидации для входящих пост запросов на добавление
            'iso' => 'required|min:2|max:2',
            'name' => 'required|min:3',
            'name_en' => 'required|min:3'
        ];


        $validator = Validator::make($request->all(), $validateRules); //Закидываем в статический метод make класса валидатор наш запрос и правила по которым он обрабатывается

        if( $validator->fails() ){ //Если у валидатора в методе fails true значит есть ошибки с валидацией (не совпадения с нашими правилами)
            
            return response()->json($validator->errors(), 400); //код 400 - bad request

        }
        return false;
    }

    public function checkAuthorization(){ //Проверяет авторизацию пользователя (наличие токена)
        try{
            $user = auth()->userOrFail();
        }catch(\Tymon\JWTAuth\Exceptions\UserNotDefinedException $exception){
            return response()->json([
                'error' => true,
                'message' => $exception->getMessage()], 401);
        }
        return false;
    }
///    
    public function country(){
        $isAuthorize = $this->checkAuthorization();

        if($isAuthorize){
            return $isAuthorize;
        }

        return response()->json(Country::get(), 200);
    }

    public function get_country($id){
        $isAuthorize = $this->checkAuthorization();

        if($isAuthorize){
            return $isAuthorize;
        }

        $exist = $this->ifExists($id);
        
        if($exist){
            return $exist;
        }
        
        $country = Country::find($id);

        return response()->json($country, 200);
    }

    public function add_country(Request $request){
        $isAuthorize = $this->checkAuthorization();

        if($isAuthorize){
            return $isAuthorize;
        }

        $validateIncorrect = $this->checkValidate($request);

        if($validateIncorrect){
            return $validateIncorrect;
        }

        $country = Country::create($request->all());
        return response()->json($country, 201);
    }

    public function edit_country(Request $request, $id){
        $isAuthorize = $this->checkAuthorization();

        if($isAuthorize){
            return $isAuthorize;
        }

        $exist = $this->ifExists($id);
        
        if($exist){
            return $exist;
        }

        $validateIncorrect = $this->checkValidate($request);

        if($validateIncorrect){
            return $validateIncorrect;
        }


        $country->update($request->all());
        return response()->json($country, 200);
    }
    
    public function delete_country(Request $request, $id){
        $isAuthorize = $this->checkAuthorization();

        if($isAuthorize){
            return $isAuthorize;
        }

        $exist = $this->ifExists($id);
        
        if($exist){
            return $exist;
        }

        $country->delete();
        return response()->json('Delete', 204);
    }
}

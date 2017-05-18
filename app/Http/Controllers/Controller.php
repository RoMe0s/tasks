<?php

namespace App\Http\Controllers;

use App\Services\FlashMessages;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Meta;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $user = null;

    //Массив з данными, который может быть вызыван методом $this->data(ключ, значение)
    public $data = array();

    //Массив с доступами в формате метод => доступ
    public $accessMap = array();

    function __construct()
    {
        $this->user = Auth::user();

        $this->fillMeta();

    }

    /**
     * @param $key
     * @param $value
     */
    public function data($key, $value) {

        $this->data[$key] = $value;
    
    }

    /**
     * @param $view
     * @param array $data
     * @return string
     */
    public function render($view, $data = array()) {
    
        $data = array_merge($this->data, $data);

        return view($view)->with($data)->render();
    
    }

    public function callAction($method, $parameters)
    {

        if(sizeof($this->accessMap)) {

           if(!$this->user) {

               FlashMessages::add('warning', trans('messages.permission not allowed'));

               return redirect(route('home'));

           }

           $permission = array_get($this->accessMap, $method, false);

           if(!$permission) {

               $permission = array_get($this->accessMap, 'all', false);

           }

           if($permission) {

               $protect = $this->_protect($permission);

               if($protect !== true) {

                   return $protect;

               }

           }

        }

        return parent::callAction($method, $parameters);

    }

    private function _isActionAllowed($permission) {

        if($this->user) {

            return $this->user->can($permission);

        }

        return false;

    }

    private function _protect($permission, $verbose = true) {

        if(!$this->_isActionAllowed($permission)) {

            $message = trans('messages.permission not allowed');

            if(request()->ajax()) {

                return response()->json(['message' => $message, 'status' => 'warning']);

            } else {

                if($verbose) {

                    FlashMessages::add('warning', $message);

                    return redirect(route('home'));

                }

                return false;

            }

        }

        return true;

    }

    /**
     * @param $model
     * @param $type
     */
    public function fillMeta($title = null)
    {

        $title = isset($title) ? $title : config('app.name');

        Meta::title($title);
    }

}

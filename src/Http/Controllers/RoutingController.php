<?php namespace Bitdev\ModuleGenerator\Http\Controllers;
use Illuminate\Support\MessageBag;
use Illuminate\Contracts\Support\MessageProvider;
use Session;
use Illuminate\Support\ViewErrorBag;
trait RoutingController{
	/**
	 * make route to index of module
	 * @return Response
	 */
	public function toIndex()
	{
	    return redirect()->route($this->uri('index'));
	}
	/**
	 * mengubah kata dari method pada cotroller
	 * @param  string $from 
	 * @return mix
	 */
	private function routeMessage($from)
    {
        switch ($from) {
            case 'store':
                return "ditambah";
            break;
            case 'update':
                return "diperbarui";
            break;
            case 'destroy':
                return "dihapus";
            break;
        }
    }
    /**
     * ruting kembali ke index dan di berikan sedikit
     * pemberitahuan berhasil
     * @param  string $from [description]
     * @return \Routing
     */
	public function routeAndSuccess($from = __METHOD__)
    {
        $message = "{$this->moduleName} berhasil ";
        $message.= $this->routeMessage($from);
        $content = $this->setAjax(true)->index()['content'];
        return \Request::ajax()?
             \Response::json(compact('message','content')):
             $this->toIndex()->withSuccess([$message]);
    }
    /**
     * ruting kembali ke form dan bersama inputan yang 
     * baru saja di inputkan bersama error yang terjadi
     * @param  string $from 
     * @return mix 
     */
    public function routeBackWithError($from = __METHOD__)
    {
        $message = "{$this->moduleName} gagal ";
        $message.= $this->routeMessage($from);
        $e = Session::get('errors',new MessageBag);
        if($e instanceof MessageProvider){
            $e = $e->getMessageBag()->add($from,$message);
        }else{
             $e = MessageBag((array) $e);
        }
        Session::forget('errors');
        $errors = $e->all();
        return \Request::ajax() ?
            \Response::json(compact('errors'),422):
            redirect()->back()->withInput()->withErrors($e);
    }
}
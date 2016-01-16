<?php 
namespace Bitdev\ModuleGenerator\Http\Controllers;
use Bitdev\ModuleGenerator\Contracts\ModelInterface;
use Illuminate\Container\Container;
use App\Http\Requests\Request;
trait ControllerPatch{

	protected $prefix;
	protected $moduleName;
	protected $removeNamespace;
	private $repo;
	private $request;
	private $ajax = false;
	private $validation;
	private $app;
	use ControllerHelper;
	function __construct(ModelInterface $repo, $nameReq, Container $app) {
		$this->app = $app;
		$this->repo = $this->getModelNamespace().$repo;
		$this->request = $this->getDefaultRouteNameSpace().$nameReq;
		if(is_null($this->prefix ))
		$this->prefix = str_replace(['p_t_k'],['ptk'],$this->getPrefix());
		if(is_null($this->moduleName ))
		$this->moduleName = $this->generateModuleName();
		
	}
	private function setAjax($value = false)
	{
		$this->ajax = $value;
		return $this;
	}
	public function store()
	{
		return $this->CreateOrUpdate($this->repo,$this->app->make($this->request),'store');
	}
	public function update($repo)
	{
		$repo = $this->repo->find($repo);
		return $this->CreateOrUpdate($repo,$this->app->make($this->request),'update');
	}
	public function show($repo)
	{
		$data = $this->repo->find($repo);
		$pageTitle = explode(' ', $this->moduleName)[0];
		$pageDescription= implode(' ',array_slice(explode(' ',$this->moduleName), 1));
		$documentTitle = "Deskripsi {$this->moduleName}";
		return $this->view($this->prefix.'.show', compact('data','pageTitle','pageDescription','documentTitle'));
	}
	public function index()
	{
		$lists = $this->repo->all();
		$title = explode(' ', $this->moduleName);
		$midTitle = floor(count($title)/2)+1 < count($title) ?  floor(count($title)/2)+1 : floor(count($title)/2);
        $pageTitle = implode(' ',array_slice($title, 0,$midTitle));
        $pageDescription= implode(' ',array_slice($title,$midTitle));
        $documentTitle =  "Keseluruhan {$this->moduleName}";
        return $this->view($this->uri('index'), compact('lists', 'pageTitle','pageDescription','documentTitle'));
	}
	public function edit($repo)
	{

		$data = $this->repo->find($repo);
		$pageTitle = explode(' ', $this->moduleName)[0];
		$pageDescription= implode(' ',array_slice(explode(' ',$this->moduleName), 1));
		$documentTitle = "Perbarui {$this->moduleName}";
		$form = "{$this->prefix}.form";
		return $this->view($this->uri('edit'), compact('data', 'pageTitle','pageDescription','documentTitle', 'form'));
	}
	public function create()
	{
		$pageTitle = explode(' ', $this->moduleName)[0];
		$pageDescription= implode(' ',array_slice(explode(' ',$this->moduleName), 1));
		$documentTitle = "Tambah {$this->moduleName}";
        $form = "{$this->prefix}.form";
        return $this->view($this->uri('create'), compact('pageTitle','pageDescription','documentTitle', 'form'));
	}

	protected function view($nameview="", $data = null)
	{
		
	    if (\Request::ajax() || $this->ajax) {
	    	$view = (isset($data)) ? 
	    							view($nameview, $data)->with($this->uri()): 
	            					view($nameview)->with($this->uri());
	        $view = $view->renderSections();
	        return $this->ajax ? $view : \Response::json($view);
	    } else {
	        if (isset($data)) {
	            return view($nameview, $data)->with($this->uri());
	        } else {
	            return view($nameview)->with($this->uri());
	        }
	    }
	}

}



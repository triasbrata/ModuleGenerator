<?php 
namespace Bitdev\ModuleGenerator\Http\Controllers;
use Bitdev\ModuleGenerator\Repositories\RepositorieInterface;
use App\Http\Requests\Request;
trait ControllerPatch{

	protected $prefix;
	protected $moduleName;
	private $repo;
	private $request;
	private $ajax = false;
	private $validation;

	function __construct(RepositorieInterface $repo, $nameReq) {
		$this->repo = $repo;
		$this->request = "Bitdev\ModuleGenerator\\Http\\Requests\\$nameReq";
		if(is_null($this->prefix ))
		$this->prefix = str_replace('\\_', '.', strtolower(implode('_',array_slice(preg_split('/(?=[A-Z])/',str_replace(['Bitdev\ModuleGenerator\\Http\\Controllers\\','Controller'], '', get_called_class())), 1))));
		$this->prefix = str_replace(['p_t_k'],['ptk'],$this->prefix);
		if(is_null($this->moduleName ))
		$this->moduleName = implode(' ',preg_split('/(?=[A-Z])/',str_replace(['Bitdev\ModuleGenerator\\Http\\Controllers\\','Admin\\','Data\\','Controller','\\'], '', get_called_class())));
		$this->moduleName = str_replace(['P T K'],['Pendidik dan Tenaga Kependidikan'],$this->moduleName);
	}
	private function setAjax($value = false)
	{
		$this->ajax = $value;
		return $this;
	}
	public function store()
	{
		return $this->CreateOrUpdate($this->repo,\App::make($this->request),'store');
	}
	public function update(RepositorieInterface $repo)
	{
		return $this->CreateOrUpdate($repo,\App::make($this->request),'update');
	}
	public function show(RepositorieInterface $repo)
	{
		$data = $repo;
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
	public function edit(RepositorieInterface $repo)
	{

		$data = $repo;
		$pageTitle = explode(' ', $this->moduleName)[0];
		$pageDescription= implode(' ',array_slice(explode(' ',$this->moduleName), 1));
		$documentTitle = "Perbarui {$this->moduleName}";
		$form = "{$this->prefix}.form";
		return $this->view("{$this->prefix}.edit", compact('data', 'pageTitle','pageDescription','documentTitle', 'form'));
	}
	public function create()
	{
		$pageTitle = explode(' ', $this->moduleName)[0];
		$pageDescription= implode(' ',array_slice(explode(' ',$this->moduleName), 1));
		$documentTitle = "Tambah {$this->moduleName}";
        $form = $this->prefix.'.form';
        return $this->view($this->uri('create'), compact('pageTitle','pageDescription','documentTitle', 'form'));
	}

	/**
	 * 
	 * @param  string $index [description]
	 * @return [type]        [description]
	 */
	protected function uri($index = "")
	{
	    $out = [
	        'index' => "{$this->prefix}.index",
	        'create' => "{$this->prefix}.create",
	        'store' => "{$this->prefix}.store",
	        'edit' => "{$this->prefix}.edit",
	        'update' => "{$this->prefix}.update",
	        'destroy' => "{$this->prefix}.destroy",
	        'show' => "{$this->prefix}.show",
	    ];
	    return isset($out[$index]) ? $out[$index] : $out;
	}
	private function with($data)
	{
		$this->data = $data;
		return $this;
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



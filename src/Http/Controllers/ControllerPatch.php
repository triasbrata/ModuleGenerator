<?php 
namespace Bitdev\ModuleGenerator\Http\Controllers;
use Bitdev\ModuleGenerator\Contracts\ModelInterface;
use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Collection;

trait ControllerPatch
{

	protected $prefix;
	protected $moduleName;
	protected $repo;
	private $request;
	private $ajax = false;
	private $validation;
	protected $app;
	private $withUri = true;
	use ControllerHelper;

	function __construct(ModelInterface $repo, Container $app, $nameReq)
	{
		$this->app = $app;
		$this->repo = $repo;
		$this->request = $this->getDefaultRequestNamespace() . $nameReq;
		if (is_null($this->prefix))
			$this->prefix = $this->getPrefix();
		if (is_null($this->moduleName))
			$this->moduleName = $this->generateModuleName();
	}

	/**
	 * @param boolean $withUri
	 */
	public function setWithUri($withUri)
	{
		$this->withUri = $withUri;
		return $this;
	}

	private function setAjax($value = false)
	{
		$this->ajax = $value;
		return $this;
	}

	public function store()
	{
		return $this->CreateOrUpdate($this->repo, $this->app->make($this->request), 'store');
	}

	public function update($repo)
	{
		$repo = $repo instanceof ModelInterface ? $repo : $this->repo->find($repo);
		// $repo = $this->repo->find($repo);
		return $this->CreateOrUpdate($repo, $this->app->make($this->request), 'update');
	}

	public function show($repo)
	{
		$data = $repo instanceof ModelInterface ? $repo : $this->repo->find($repo);
		$pageTitle = explode(' ', $this->moduleName)[0];
		$pageDescription = implode(' ', array_slice(explode(' ', $this->moduleName), 1));
		$documentTitle = "Deskripsi {$this->moduleName}";
		return $this->view($this->prefix . '.show', compact('data', 'pageTitle', 'pageDescription', 'documentTitle'));
	}

	public function index()
	{

		if( $this->repo instanceof  ModelInterface )
			$lists = $this->repo->orderBy('created_at')->get();
		else if ($this->repo instanceof Collection)
			$lists = $this->repo->sortByDesc('created_at')->all();
		else $lists = $this->repo;
		$title = explode(' ', $this->moduleName);
		$midTitle = floor(count($title) / 2) + 1 < count($title) ? floor(count($title) / 2) + 1 : floor(count($title) / 2);
		$pageTitle = implode(' ', array_slice($title, 0, $midTitle));
		$pageDescription = implode(' ', array_slice($title, $midTitle));
		$documentTitle = "Keseluruhan {$this->moduleName}";
		return $this->view($this->uri('index'), compact('lists', 'pageTitle', 'pageDescription', 'documentTitle'));
	}

	public function edit($repo)
	{
		$data = $repo instanceof ModelInterface ? $repo : $this->repo->find($repo);
		$pageTitle = explode(' ', $this->moduleName)[0];
		$pageDescription = implode(' ', array_slice(explode(' ', $this->moduleName), 1));
		$documentTitle = "Perbarui {$this->moduleName}";
		$form = "{$this->prefix}.form";
		return $this->view($this->uri('edit'), compact('data', 'pageTitle', 'pageDescription', 'documentTitle', 'form'));
	}

	public function create()
	{
		$pageTitle = explode(' ', $this->moduleName)[0];
		$pageDescription = implode(' ', array_slice(explode(' ', $this->moduleName), 1));
		$documentTitle = "Tambah {$this->moduleName}";
		$form = "{$this->prefix}.form";
		return $this->view($this->uri('create'), compact('pageTitle', 'pageDescription', 'documentTitle', 'form'));
	}

	protected function view($nameview = "", $data = null)
	{

		if (\Request::ajax() || $this->ajax) {
			$view = (isset($data)) ?
				view($nameview, $data)->with($this->uri()) :
				view($nameview)->with($this->uri());
			$view = $view->renderSections();
			return $this->ajax ? $view : \Response::json($view);
		} else {
			if($this->withUri){
				if (isset($data)) {
					return view($nameview, $data)->with($this->uri());
				} else {
					return view($nameview)->with($this->uri());
				}
			}else{
				if (isset($data)) {
					return view($nameview, $data);
				} else {
					return view($nameview);
				}
			}
		}
	}
}



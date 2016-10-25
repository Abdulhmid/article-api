<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\DataTables\ModulesDatatables;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Modules;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Forms\ModulesForm;
use App\Models as Model;

class ModulesController extends Controller
{

    use AccessCheckerTrait;
    protected $model;
    protected $title = "Modul";
    protected $url = "modules";
    protected $folder = "modules.module";
    protected $form;

    public function __construct(
    	Modules $modules,
    	Model\Groups $groups,
    	Model\Modules_access $modules_access
    )
    {
        $this->model 	= $modules;
        $this->modules  = $modules;
        $this->groups 	= $groups;
        $this->modules_access 	= $modules_access;
        $this->form 	= ModulesForm::class;

        /* For Acl */
        $this->info = $this->modules->makeInfo($this->url);
    }

    public function index(ModulesDatatables $dataTable)
    {
        $this->checkAccess('index');

        $data['title'] = $this->title;
        $data['breadcrumb'] = $this->url;

        return $dataTable->render($this->folder . '.index', $data);
    }

    public function create(FormBuilder $formBuilder)
    {
        $this->checkAccess('create');

        $form = $formBuilder->create($this->form, [
            'method' => 'POST',
            'route' => $this->url . '.store'
        ]);

        return view($this->folder . '.form', [
            'title' => $this->title,
            'form' => $form,
            'breadcrumb' => 'new-' . $this->url
        ]);
    }

    public function store(Requests\ModulesRequest $request)
    {
        $this->checkAccess('create');

        $query = $this->model->create($request->only(['module_name', 'module_name_alias',
        									 'function','function_alias', 'description']));

        $result = $query->module_id;
        $save_continue = \Input::get('save_continue');
        $redirect = empty($save_continue) ? $this->url : $this->url.'/'.$result.'/edit';

        return redirect()->to($redirect)->with('message', 'Modul berhasil dibuat.');
    }

    public function edit(FormBuilder $formBuilder, $id)
    {
        $this->checkAccess('edit');

        $model = $this->model->find($id);

        $form = $formBuilder->create($this->form, [
            'method' => 'PUT',
            'url' => route($this->url . '.update', $id),
            'model' => $model
        ]);

        return view($this->folder . '.form', [
            'title' => $this->title,
            'form' => $form,
            'breadcrumb' => 'new-' . $this->url
        ]);
    }

    public function update(Requests\ModulesRequest $request, $id)
    {
        $this->checkAccess('edit');

        $this->model->find($id)->update($request->only(['module_name', 'module_name_alias',
        									 'function','function_alias', 'description']));

        $save_continue = \Input::get('save_continue');
        $redirect = empty($save_continue) ? $this->url : $this->url.'/'.$id.'/edit';

        return redirect()->to($redirect)->with('message', 'Modul berhasil diubah.');
    }

    public function destroy($id)
    {
        $this->checkAccess('delete');

        $find = $this->model->find($id);

        $find->delete();

        return response()->json(['message' => 'Modul Berhasil dihapus.']);
    }

    public function access(){
        $this->checkAccess('access');

        $data['title'] = $this->title;
        $data['groups'] = $this
            ->groups
            ->where('group_id','<>',0)
            ->get();

        $data['modules'] = $this->model->all();
        $data['breadcrumb'] = $this->url;

        return view($this->folder . '.acl', $data);
    }

    public function accessPost(Request $request){
        $this->checkAccess('access');
        
        $groupLoop = $this->groups->pluck('group_id')->toArray();
        try {
            \DB::beginTransaction();
            foreach ($groupLoop as $valueGroups) {
                $modules = $this->model->get()->toArray();
                foreach ($modules as $value) {
                    $array = [];
                    /* Check Is Selected Function  */
                    foreach (\AclHelper::takeFunction($value['module_id'], "origin") as $function) {
                        $field = 'function' . $valueGroups . $value['module_id'] . $function;
                        $getField = $request->get($field);

                        $array[$function] = (isset($getField) && "on" == $getField ? "1" : "0");
                    }
                    /* Encode From Array */
                    $dummy = json_encode($array);
                    $accessData = preg_replace('/\s/', '', $dummy);

                    $checkExist = $this->modules_access->where([
                        'group_id' => $valueGroups,
                        'module_id' => $value['module_id'],
                    ])->first();

                    if (!is_null($checkExist)) {
                        $checkExist->update(['access_data' => $accessData]);
                    } else {
                        $this->modules_access->create([
                            'group_id' => $valueGroups,
                            'module_id' => $value['module_id'],
                            'access_data' => $accessData,
                        ]);
                    }
                }
            }
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollback();
            \Log::info($e);

            return redirect($this->url.'/access')->with('error', 
            				'Terjadi kesalahan, silahkan ulangi beberapa saat lagi.');
        }

        return redirect($this->url.'/access')->with('message', 'Data Berhasil Disimpan!');
    }
}

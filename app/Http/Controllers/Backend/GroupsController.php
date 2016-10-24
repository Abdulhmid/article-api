<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\DataTables\GroupsDataTables;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Forms\GroupsForm;
use App\Models as Md;

class GroupsController extends Controller
{
    protected $model;
    protected $title = "Grup Pengguna";
    protected $url = "groups";
    protected $folder = "modules.groups";
    protected $form;

    public function __construct(
        Md\Groups $model
    )
    {
        $this->model    = $model;
        $this->form     = GroupsForm::class;

        /* For Acl */
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(GroupsDataTables $dataTable)
    {
        $data['title'] = $this->title;
        $data['breadcrumb'] = $this->url;

        return $dataTable->render($this->folder . '.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(FormBuilder $formBuilder)
    {
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\GroupsRequest $request)
    {
        $query = $this->model->create($request->except(['save_continue']));
        $result = $query->id;
        $save_continue = \Input::get('save_continue');
        $redirect = empty($save_continue) ? $this->url : 
                                            $this->url.'/'.$result.'/edit';

        return redirect()->to($redirect)->with(
            'message', $this->title.' berhasil dibuat.'
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(FormBuilder $formBuilder, $id)
    {
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\GroupsRequest $request, $id)
    {
        $query = $this->model->find($id)->update($request->except(['save_continue']));
        $result = $id;
        $save_continue = \Input::get('save_continue');
        $redirect = empty($save_continue) ? $this->url : 
                                            $this->url.'/'.$result.'/edit';

        return redirect()->to($redirect)->with(
            'message', $this->title.' berhasil diubah.'
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $find = $this->model->find($id);

        $find->delete();

        return response()->json([
            'message' => $this->title.' Berhasil dihapus.'
        ]);
    }
}

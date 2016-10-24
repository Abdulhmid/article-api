<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\DataTables\UsersDataTables;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Forms\UsersForm;
use App\User;
use App\Models as Model;

class UsersController extends Controller
{
    protected $model;
    protected $title = "User ";
    protected $url = "users";
    protected $folder = "modules.users";
    protected $form;

    public function __construct(
        User $model
    )
    {
        $this->model        = $model;
        $this->form         = UsersForm::class;
    }

    /**
     * Display a listing of the resource.
     * type user : {admin,country,state,city,operator}
     * @return \Illuminate\Http\Response
     */
    public function index(UsersDataTables $dataTable)
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
        ])->modify('group_id', 'select', [
            'attr' => ['class' => 'frm-e form-control', 'id' => 'groupInput'],
            'choices' => \App\Models\Groups::pluck("group_name", "group_id")->toArray(),
            'selected' => \Auth::user()->group_id,
            'empty_value' => '- Pilih Grup -',
            'label' => 'Pengguna Untuk Grup'
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
    public function store(Requests\UsersRequest $request)
    {
        $input = $request->only([
                    'username','name','email','photo','group_id'
                 ]);

        $input['password'] = bcrypt($request->get['password']);

        if ($request->hasFile('photo')) {
            $input['photo'] = (new \ImageUpload($request))->upload();
        }

        $query = $this->model->create($input);

        $result = $query->id;
        $save_continue = \Input::get('save_continue');
        $redirect = empty($save_continue) ? $this->url : 
                                            $this->url.'/'.$result.'/edit';

        return redirect()->to($redirect)->with('message', 
            $this->title.' berhasil dibuat.'
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

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
        ])->modify('group_id', 'select', [
            'attr' => ['class' => 'frm-e form-control', 'id' => 'groupInput'],
            'choices' => \App\Models\Groups::pluck("group_name", "group_id")->toArray(),
            'selected' => $model->group_id,
            'empty_value' => '- Pilih Grup -',
            'label' => 'Pengguna Untuk Grup'
        ]);

        return view($this->folder . '.form', [
            'title' => $this->title,
            'row' => $model,
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
    public function update(Requests\UsersRequest $request, $id)
    {
        $input = $request->only([
                    'username','name','email','group_id'
                ]);
        $inputPass  = $request->only('password');

        if($request->hasFile('photo')) {
            $input['photo'] = (new \ImageUpload($request))->upload();
        }

        if(isset($inputPass['password']) && $inputPass['password'] != "")
            $input['password'] = bcrypt($inputPass['password']);

        $query = $this->model->find($id)->update($input);
        $result = $id;
        $save_continue = \Input::get('save_continue');
        $redirect = empty($save_continue) ? $this->url : 
                                            $this->url.'/'.$result.'/edit';

        return redirect()->to($redirect)->with('message', 
                $this->title.' berhasil diubah.'
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

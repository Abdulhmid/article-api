<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\DataTables\NewsDataTables;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Forms\NewsForm;
use App\Models as Md;

class NewsController extends Controller
{
    protected $model;
    protected $title = "Berita";
    protected $url = "news";
    protected $folder = "modules.news";
    protected $form;

    public function __construct(
        Md\News $model
    )
    {
        $this->model    = $model;
        $this->form     = NewsForm::class;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(NewsDataTables $dataTable)
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
    public function store(Requests\NewsRequest $request)
    {
    	$input = $request->except(['save_continue','photo']);
    	$input['slug'] = str_slug($request->get('title'));
    	$input['user_id'] = \Auth::user()->id;

        if ($request->hasFile('photo')) {
            $input['image'] = (new \ImageUpload($request))->upload();
        }

        $query = $this->model->create($input);
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
            'row' => $model,
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
    public function update(Requests\NewsRequest $request, $id)
    {
    	$input = $request->except(['save_continue','photo']);
    	$input['slug'] = str_slug($request->get('title'));
    	$input['user_id'] = \Auth::user()->id;
        if($request->hasFile('photo')) {
            $input['image'] = (new \ImageUpload($request))->upload();
        }
        $query = $this->model->find($id)->update($input);
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

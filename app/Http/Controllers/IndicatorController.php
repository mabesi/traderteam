<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Indicator;
use App\User;
use Illuminate\Support\Facades\Storage;

class IndicatorController extends Controller
{

  public function indicators($request)
  {
    $path = $request->path();

    if ($request->has('sort')){
      $sort = $request->query('sort');
      $dir = $request->query('dir');
    } else {
      $sort = 'name';
      $dir = 'asc';
    }

    $indicators = Indicator::withCount('strategies');

    $indicator = $request->query('indicator');

    $where = Array();

    if ($indicator != Null){
      $indicators->where('name','like',"%$indicator%");
      $indicators->orWhere('acronym','like',"%$indicator%");
    }

    $indicators = $indicators->orderBy($sort,$dir)
                            ->paginate(5);

    $where['indicator'] = $indicator;

    $newDir = ($dir=='asc'?'desc':'asc');

    $data = [
      'viewname' => 'Lista de Indicadores',
      'viewtitle' => 'Lista de Indicadores',
      'indicators' => $indicators,
      'where' => $where,
      'path' => $path,
      'sort' => $sort,
      'dir' => $dir,
      'newDir' => $newDir,
      'profileView' => False,
    ];

    return view('indicator.list', $data);
  }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      return $this->indicators($request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $data = [
        'viewname' => 'Novo Indicador',
        'viewtitle' => 'Novo Indicador',
      ];

      return view('indicator.edit', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $indicator = new Indicator;

      $indicator->name = $request->name;
      $indicator->acronym = $request->acronym;
      $indicator->description = $request->description;
      $indicator->type = $request->type;

      //saveImage($request,$fieldName,$dir,$imageName,$oldName=Null,$default=Null)
      //saveImage($request,'avatar','avatar',getUserId(),getUserAvatarName(),'default.png');
      $indicator->image = saveImage($request,'image','indicators',$indicator->acronym);

      $indicator->save();

      //return redirect('indicator/'.$indicator->id.'/edit');
      return redirect('indicator');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Indicator  $indicator
     * @return \Illuminate\Http\Response
     */
    public function show(Indicator $indicator)
    {
      $data = [
        'viewname' => 'Indicador',
        'viewtitle' => 'Indicador',
        'indicator' => $indicator,
      ];

      return view('indicator.indicator', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Indicator  $indicator
     * @return \Illuminate\Http\Response
     */
    public function edit(Indicator $indicator)
    {
      $data = [
        'viewname' => 'Editar Indicador',
        'viewtitle' => 'Editar Indicador',
        'indicator' => $indicator,
      ];

      return view('indicator.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Indicator  $indicator
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Indicator $indicator)
    {
      $indicator->name = $request->name;
      $indicator->acronym = $request->acronym;
      $indicator->description = $request->description;
      $indicator->type = $request->type;

      $indicator->image = saveImage($request,'image','indicators',$indicator->acronym,$indicator->image,'loading.gif');

      $indicator->save();

      //return redirect('indicator/'.$indicator->id.'/edit');
      return redirect('indicator');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Indicator  $indicator
     * @return \Illuminate\Http\Response
     */
    public function destroy(Indicator $indicator)
    {
      if (isAdmin()){

        if ($indicator->delete()){
          $message = getMsgDeleteSuccess();
        } else {
          $message = getMsgDeleteError();
        }

      } else {
        $message = getMsgDeleteAccessForbidden();
      }
      return response()->json($message);
    }
}

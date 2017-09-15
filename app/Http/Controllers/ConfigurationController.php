<?php

namespace App\Http\Controllers;

use App\Configuration;
use Illuminate\Http\Request;

class ConfigurationController extends Controller
{
    public function __construct()
    {
        $this->middleware('OnlyAdmin');
        $this->middleware('OnlySuperAdmin')->only(['create','store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $configurations = Configuration::paginate(10);

        $data = [
          'viewname' => 'Configurações',
          'viewtitle' => 'Configurações',
          'configurations' => $configurations,
          'profileView' => False,
        ];

        return view('configuration.list',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $data = [
        'viewname' => 'Novo Configuração',
        'viewtitle' => 'Novo Configuração',
      ];

      return view('configuration.edit', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $configuration = new configuration;
      $request->validate($configuration->rules,$configuration->messages);
      $configuration->fill($request->all());

      if (isAdmin()){
        if ($configuration->save()){
          return redirect('configuration')->with('informations', ['O Configuração foi salvo com sucesso!']);
        } else {
          return back()->with('problems', ['Erro inesperado. O Configuração não foi salvo!']);
        }
      } else {
        return back()->with('problems', ['Acesso não permitido. O Configuração não foi salvo!']);
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Configuration  $configuration
     * @return \Illuminate\Http\Response
     */
    public function show(Configuration $configuration)
    {
      $data = [
        'viewname' => 'Configuração',
        'viewtitle' => 'Configuração',
        'configuration' => $configuration,
      ];

      return view('configuration.configuration', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Configuration  $configuration
     * @return \Illuminate\Http\Response
     */
    public function edit(Configuration $configuration)
    {
      $data = [
        'viewname' => 'Editar Configuração',
        'viewtitle' => 'Editar Configuração',
        'configuration' => $configuration,
      ];

      return view('configuration.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Configuration  $configuration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Configuration $configuration)
    {
      $request->validate($configuration->rules,$configuration->messages);

      if (isSuperAdmin()){
        $configuration->name = strip_tags($request->input('name'));
      }
      $configuration->value = strip_tags($request->input('value'));
      $configuration->content = $request->input('content');

      if (isAdmin()){
        if ($configuration->save()){
          return redirect('configuration')->with('informations', ['A configuração foi salva com sucesso!']);
        } else {
          return back()->with('problems', ['Erro inesperado. A configuração não foi salva!']);
        }
      } else {
        return back()->with('problems', ['Acesso não permitido. A configuração não foi salva!']);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Configuration  $configuration
     * @return \Illuminate\Http\Response
     */
    public function destroy(Configuration $configuration)
    {
      if (isSuperAdmin()){

        if ($configuration->delete()){
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

<?php

namespace App\Http\Controllers;

use App\Notice;
use Illuminate\Http\Request;
use Validator;

class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $notices = Notice::orderBy('updated_at','desc')
                        ->paginate(10);

      $data = [
        'viewname' => 'Avisos',
        'viewtitle' => 'Avisos',
        'notices' => $notices,
        'profileView' => False,
      ];

      return view('notice.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $data = [
        'viewname' => 'Novo Aviso',
        'viewtitle' => 'Novo Aviso',
      ];

      return view('notice.edit', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $notice = new Notice;

      $request->validate($notice->rules,$notice->messages);

      $notice->fill($request->all());
      $notice->user_id = getUserId();

      if (isAdmin()){
        if ($notice->save()){
          return redirect('notice')->with('informations', ['O aviso foi salvo com sucesso!']);
        } else {
          return back()->with('problems', ['Erro inesperado. O aviso não foi salvo!']);
        }
      } else {
        return back()->with('problems', ['Acesso não permitido. O aviso não foi salvo!']);
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function show(Notice $notice)
    {
      $data = [
        'viewname' => 'Aviso',
        'viewtitle' => 'Aviso',
        'notice' => $notice,
      ];

      return view('notice.notice', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function edit(Notice $notice)
    {
      $data = [
        'viewname' => 'Editar Aviso',
        'viewtitle' => 'Editar Aviso',
        'notice' => $notice,
      ];

      return view('notice.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notice $notice)
    {
      $request->validate($notice->rules,$notice->messages);

      $notice->fill($request->all());
      $notice->user_id = getUserId();

      if (isAdmin()){
        if ($notice->save()){
          return redirect('notice')->with('informations', ['O aviso foi salvo com sucesso!']);
        } else {
          return back()->with('problems', ['Erro inesperado. O aviso não foi salvo!']);
        }
      } else {
        return back()->with('problems', ['Acesso não permitido. O aviso não foi salvo!']);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notice $notice)
    {
      if (isAdmin()){

        if ($notice->delete()){
          $message = getMsgDeleteSuccess();
        } else {
          $message = getMsgDeleteError();
        }

      } else {
        $message = getMsgAccessForbidden();
      }
      return response()->json($message);
    }
}

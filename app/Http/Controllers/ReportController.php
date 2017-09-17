<?php

namespace App\Http\Controllers;

use App\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $reports = Report::orderBy('finished')
                  ->orderBy('updated_at','desc')
                  ->paginate(10);

      $data = [
        'viewname' => 'Denúncias',
        'viewtitle' => 'Denúncias',
        'reports' => $reports,
        'profileView' => False,
      ];

      return view('report.list',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $report = new Report;
      $request->validate($report->rules,$report->messages);

      $reportedUser = getUser($request->reported_id);

      if (hasOpenReport($reportedUser)){
        return back()->with('warnings', ['Você já possui denúncia(s) aberta(s) contra este usuário! Por favor aguarde pela conclusão.']);
      }

      $userOpenReports = getUserOpenReports();
      $maxReportsSent = (integer) nullToZero(getConfiguration('MAX_REPORTS_SENT'));

      if ($userOpenReports > $maxReportsSent) {
        return back()->with('warnings', ['Você atingiu o limite de envio de denúncias. Por favor aguarde pela conclusão ou entre em contato pelo Fale Conosco.']);
      }

      $report->fill($request->all());
      $report->user_id = getUserId();

      if ($report->save()){

        $openReports = getTotalOpenDenounces($report->reportedUser);
        $maxOpenReports = (integer) nullToZero(getConfiguration('MAX_OPEN_REPORTS'));

        if ($openReports > $maxOpenReports) {
          lockUser($report->reportedUser);
          $request->session()->flash('warnings',['O usuário '.$report->reportedUser->name.' foi bloqueado por atingir o limite de denúncias!']);
        }

        return redirect('report/'.$report->id.'/edit')->with('informations', ['A denúncia foi salva com sucesso!']);

      } else {
        return back()->with('problems', ['Erro inesperado. A denúncia não foi salva!']);
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
      $reported = getUser($report->reported_id);

      $data = [
        'viewname' => 'Editar Denúncia',
        'viewtitle' => 'Editar Denúncia',
        'report' => $report,
        'reported' => $reported,
      ];

      return view('report.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
      $request->validate($report->rules,$report->messages);
      $report->fill($request->all());
      $report->finished = (boolean) $request->finished;

      if ($report->save()){
        if ($report->finished){
          sendReportConclusionEmail($report);
        }
        return redirect('report/'.$report->id.'/edit')->with('informations', ['A denúncia foi salva com sucesso!']);
      } else {
        return back()->with('problems', ['Erro inesperado. A denúncia não foi salva!']);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
      if (isSuperAdmin()){

        if ($report->delete()){
          $message = getMsgDeleteSuccess();
        } else {
          $message = getMsgDeleteError();
        }

      } else {
        $message = getMsgDeleteAccessForbidden();
      }
      return response()->json($message);
    }

    public function userReport($id)
    {
      $reported = getUser($id);

      $data = [
        'viewname' => 'Nova Denúncia',
        'viewtitle' => 'Nova Denúncia',
        'reported' => $reported,
      ];

      return view('report.edit', $data);
    }
}

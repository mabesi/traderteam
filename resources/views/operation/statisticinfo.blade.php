<ul class="list-group list-group-unbordered">
  <li class="list-group-item no-padding">
    <div class="row top-bottom-10">
      <div class="col-xs-12 text-center text-bold font-16 text-navy">
        Não Iniciadas: {{ App\Operation::getNewOperations($user->id) }} |
        Em Andamento: {{ App\Operation::getStartedOperations($user->id) }} |
        Finalizadas: {{ App\Operation::getCompleteOperations($user->id) }}
      </div>
    </div>
  </li>
</ul>

<div class="row top-10">
  <div class="col-sm-4 text-bold text-navy">
    No Alvo ({{ App\Operation::getTargetedOperations($user->id) }})
  </div>
  <div class="col-sm-8">
    <div class="progress">
      <div class=" no-padding progress-bar progress-bar-green progress-bar-striped" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"
       style="width:23%">
        <span class="font-11 text-bold">23%</span>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-sm-4 text-bold text-navy">
    Lucrativas ({{ App\Operation::getLucrativeOperations($user->id) }})
  </div>
  <div class="col-sm-8">
    <div class="progress">
      <div class="progress-bar progress-bar-blue progress-bar-striped" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"
       style="width:44%">
        <span class="font-11 text-bold">44%</span>
      </div>
    </div>
  </div>
</div>

<div class="row no-padding">
  <div class="col-sm-4 text-bold text-navy">
    Zero a Zero ({{ App\Operation::getBreakEvenOperations($user->id) }})
  </div>
  <div class="col-sm-8">
    <div class="progress">
      <div class="progress-bar progress-bar-yellow progress-bar-striped" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"
       style="width:8%">
        <span class="font-11 text-bold">8%</span>
      </div>
    </div>
  </div>
</div>

<div class="row no-padding">
  <div class="col-sm-4 text-bold text-navy">
    Com Prejuízo ({{ App\Operation::getLossyOperations($user->id) }})
  </div>
  <div class="col-sm-8">
    <div class="progress">
      <div class="progress-bar progress-bar-red progress-bar-striped" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"
       style="width:32%">
        <span class="font-11 text-bold">32%</span>
      </div>
    </div>
  </div>
</div>

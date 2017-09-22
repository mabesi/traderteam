<span class="font-12 label bg-{{ ($operation->riskReturn()>=3?'green':($operation->riskReturn()>=1?'primary':'maroon')) }}"
  title="Relação Risco/Retorno da Operação" >
  {{ $operation->riskReturn() }}
</span>
{{ nbsp(1) }}
<span class="font-14">
  <span class="btn btn-default no-padding" title="Porcentagens de Risco / Retorno da Operação" >
    <b>%O</b>: {{ $operation->prevRisk() }}/{{ $operation->prevReturn() }}
  </span>
  {{ nbsp(1) }}
  <span class="btn btn-default no-padding" title="Porcentagens de Risco / Retorno do Capital de Investimento" >
    <b>%C</b>: {{ $operation->prevCapitalRisk() }}/{{ $operation->prevCapitalReturn() }}
  </span>
</span>
@if ($operation->status=='E' || $operation->status=='S' || $operation->status=='T')
{{ nbsp(1) }}
<span class="font-14 label bg-{{ ($operation->result==0?'gray':($operation->result>0?'green':'red')) }}"
  title="Resultado da Operação em relação ao Capital" >
  {{ $operation->result }}%
</span>
@endif

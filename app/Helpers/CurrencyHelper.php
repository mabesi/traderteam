<?php

function formatRealNumber($number,$decimals=0)
{
  return number_format($number,$decimals,',','.');
}

function formatCurrency($number)
{
  $formatter = new NumberFormatter('pt_BR', NumberFormatter::CURRENCY);
  return $formatter->formatCurrency($number,'BRL');
}

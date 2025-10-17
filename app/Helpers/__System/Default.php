<?php

use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Models\Activity;

function activities($model)
{
  $data = Activity::where('subject_type', $model)->orderBy('created_at', 'desc')->get();
  return $data;
}

function ManagementRoles()
{
  $items = DB::table('roles')->orderBy('created_at', 'asc')->where('active', 1)->pluck('name', 'id')->toArray();
  return $items;
}

function ManagementUsers()
{
  $items = DB::table('users')->orderBy('created_at', 'asc')->where('active', 1)->pluck('name', 'id')->toArray();
  return $items;
}

function mask_email(string $email): string
{
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    return $email;
  }

  [$local, $domain] = explode('@', $email, 2);

  // mask local part
  $len = mb_strlen($local);
  if ($len <= 2) {
    $maskedLocal = mb_substr($local, 0, 1) . str_repeat('*', max(0, $len - 1));
  } else {
    $first = mb_substr($local, 0, 1);
    $last = mb_substr($local, -1);
    $maskedLocal = $first . str_repeat('*', max(3, $len - 2)) . $last;
  }

  // mask domain (keep domain root + tld partly)
  // split domain to name + tld
  $parts = explode('.', $domain);
  if (count($parts) >= 2) {
    $tld = array_pop($parts);
    $domainName = implode('.', $parts);
    $dlen = mb_strlen($domainName);
    $keep = mb_substr($domainName, 0, 1);
    $maskedDomainName = $keep . str_repeat('*', max(2, $dlen - 1));
    $maskedDomain = $maskedDomainName . '.' . $tld;
  } else {
    $maskedDomain = substr($domain, 0, 1) . '***';
  }

  return $maskedLocal . '@' . $maskedDomain;
}

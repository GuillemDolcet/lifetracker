@extends('errors.general')

@section('title', ucfirst(__($exception->getMessage() ?: 'errors.forbidden')))
@section('code', '403')

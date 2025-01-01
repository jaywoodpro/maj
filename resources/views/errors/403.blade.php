@extends('errors::minimal')

@section('title', __('دسترسی ممنوع'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'دسترسی ممنوع'))

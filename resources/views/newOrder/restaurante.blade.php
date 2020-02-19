@extends('layouts.app')
@section('content')
<?php  
session_start();
if($_SESSION['newConsumer']){
 echo $_SESSION['newConsumer'];

}
?>
@endsection
<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/pages/contact.blade.php');
$c = str_replace("@extends('frontend.layouts.master')", "@extends('frontend.layouts.master')\n@section('title','SNC || Submit Your Complaint')", $c);
file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/pages/contact.blade.php', $c);
echo "Title added.\n";

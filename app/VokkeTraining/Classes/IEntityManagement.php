<?php

namespace App\VokkeTraining\Classes;


interface IEntityManagement
{
    public function create();
    public function delete();
    public function get();
    public function getAll();
}
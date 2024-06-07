<?php
namespace App\Enums;

enum Role: int 
{
    case SuperAdministrator = 1;
    case salesManager = 2;
    case customer = 3;
    
}
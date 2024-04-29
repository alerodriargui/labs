<?php

namespace App\Models;


class Ticket 
{
    public int $id;
    public array $plants;
    
}

class PlantsRecipt{
    public string $nombreplanta;
    public int $cantidad;
    public int $precio_unidad;
}
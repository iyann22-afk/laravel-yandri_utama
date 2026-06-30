<?php

namespace App\Http\Controllers;

use OpenApi\Attributes as OA;

#[OA\Info(
    version: "1.0.0",
    title: "WMS API Documentation",
    description: "API Documentation for Warehouse Management System"
)]
class ApiDocController extends Controller
{
    // Hanya penampung anotasi
}
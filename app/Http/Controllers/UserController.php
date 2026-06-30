<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class UserController extends Controller
{
    protected $userService;

    // Inject Service Layer ke dalam Controller
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    #[OA\Get(
        path: "/users",
        summary: "Get list of users",
        tags: ["User"],
        responses: [
            new OA\Response(
                response: 200,
                description: "Data User berhasil diambil",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "success", type: "boolean", example: true),
                        new OA\Property(property: "message", type: "string", example: "Data User berhasil diambil"),
                        new OA\Property(property: "data", type: "array", items: new OA\Items(type: "object")),
                    ]
                )
            )
        ]
    )]
    public function index()
    {
        $users = $this->userService->getAllUsers();
        return response()->json([
            'success' => true,
            'message' => 'Data User berhasil diambil',
            'data' => $users
        ]);
    }

    #[OA\Post(
        path: "/users",
        summary: "Create a new user",
        tags: ["User"],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ["name", "email", "password"],
                properties: [
                    new OA\Property(property: "name", type: "string", example: "Yandri Utama"),
                    new OA\Property(property: "email", type: "string", format: "email", example: "yandri@example.com"),
                    new OA\Property(property: "password", type: "string", format: "password", example: "password123"),
                    new OA\Property(property: "roles", type: "array", items: new OA\Items(type: "integer"), example: [1, 2]),
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: "User berhasil dibuat",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "success", type: "boolean", example: true),
                        new OA\Property(property: "message", type: "string", example: "User berhasil dibuat"),
                        new OA\Property(property: "data", type: "object"),
                    ]
                )
            ),
            new OA\Response(response: 422, description: "Validasi gagal")
        ]
    )]
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'roles' => 'array' // Opsional: array ID role
        ]);

        // Lempar data ke Service Layer
        $user = $this->userService->createUser($request->all(), $request->roles ?? []);

        return response()->json([
            'success' => true,
            'message' => 'User berhasil dibuat',
            'data' => $user
        ], 201);
    }
}
<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

$apiUrl = env('API_URL', 'http://api:5000');

Route::get('/', function () {
    if (Session::has('admin')) {
        return redirect('/dashboard');
    }
    return view('empleados.login');
});

Route::post('/login', function (Request $request) use ($apiUrl) {
    $email    = $request->input('email');
    $password = $request->input('password');

    try {
        $response = Http::timeout(5)->post("{$apiUrl}/v1/auth/login", [
            'email'    => $email,
            'password' => $password
        ]);

        if ($response->successful()) {
            $user = $response->json();
            if ($user['role'] !== 'admin') {
                return redirect('/')->with('error', 'Acceso denegado. No eres administrador.');
            }
            Session::put('admin', $user);
            return redirect('/dashboard');
        } else {
            return redirect('/')->with('error', 'Credenciales incorrectas');
        }
    } catch (\Exception $e) {
        return redirect('/')->with('error', 'Error conectando con la API: ' . $e->getMessage());
    }
});

Route::get('/logout', function () {
    Session::forget('admin');
    return redirect('/');
});

Route::get('/dashboard', function () use ($apiUrl) {
    if (!Session::has('admin')) return redirect('/');

    try {
        $response  = Http::timeout(5)->get("{$apiUrl}/v1/productos/");
        $productos = $response->successful() ? $response->json() : [];
        return view('empleados.panel_administrador', [
            'productos' => $productos,
            'admin'     => Session::get('admin')
        ]);
    } catch (\Exception $e) {
        return "Error al cargar dashboard: " . $e->getMessage();
    }
});

Route::get('/productos/nuevo', function () {
    if (!Session::has('admin')) return redirect('/');
    return view('empleados.nuevo_producto', ['admin' => Session::get('admin')]);
});

Route::post('/productos/agregar', function (Request $request) use ($apiUrl) {
    if (!Session::has('admin')) return redirect('/');

    $imagenRaw = $request->input('imagen', '');
    $payload = [
        "nombre"      => $request->input('nombre'),
        "sku"         => $request->input('sku'),
        "descripcion" => $request->input('descripcion') ?: null,
        "precio"      => (float) $request->input('precio'),
        "stock"       => (int) $request->input('stock'),
        "marca_auto"  => $request->input('marca_auto') ?: null,
        "categoria"   => $request->input('categoria') ?: null,
        "imagen"      => $imagenRaw !== '' ? $imagenRaw : null,
    ];

    $response = Http::timeout(5)->post("{$apiUrl}/v1/productos/", $payload);

    if ($response->successful()) {
        return redirect('/dashboard')->with('success', 'Producto agregado correctamente');
    } else {
        return redirect('/productos/nuevo')->with('error', 'Error al agregar el producto: ' . $response->body());
    }
});

Route::post('/productos/borrar/{id}', function ($id) use ($apiUrl) {
    if (!Session::has('admin')) return redirect('/');
    Http::timeout(5)->delete("{$apiUrl}/v1/productos/{$id}");
    return redirect('/dashboard')->with('success', 'Producto eliminado');
});

Route::get('/productos/editar/{id}', function ($id) use ($apiUrl) {
    if (!Session::has('admin')) return redirect('/');
    $response = Http::timeout(5)->get("{$apiUrl}/v1/productos/{$id}");
    $producto = $response->json();
    return view('empleados.editar_producto', [
        'producto' => $producto,
        'admin'    => Session::get('admin')
    ]);
});

Route::post('/productos/actualizar/{id}', function (Request $request, $id) use ($apiUrl) {
    if (!Session::has('admin')) return redirect('/');

    $imagenRaw = $request->input('imagen', '');
    $payload = [
        "nombre"      => $request->input('nombre'),
        "sku"         => $request->input('sku'),
        "descripcion" => $request->input('descripcion') ?: null,
        "precio"      => (float) $request->input('precio'),
        "stock"       => (int) $request->input('stock'),
        "marca_auto"  => $request->input('marca_auto') ?: null,
        "categoria"   => $request->input('categoria') ?: null,
        "imagen"      => $imagenRaw !== '' ? $imagenRaw : null,
    ];

    $response = Http::timeout(5)->put("{$apiUrl}/v1/productos/{$id}", $payload);

    if ($response->successful()) {
        return redirect('/dashboard')->with('success', 'Producto actualizado correctamente');
    } else {
        return redirect("/productos/editar/{$id}")->with('error', 'Error al actualizar: ' . $response->body());
    }
});

Route::get('/compras', function () use ($apiUrl) {
    if (!Session::has('admin')) return redirect('/');

    try {
        $response = Http::timeout(5)->get("{$apiUrl}/v1/compras/");
        $compras  = $response->successful() ? $response->json() : [];
        return view('empleados.panel_compras_admin', [
            'compras' => $compras,
            'admin'   => Session::get('admin')
        ]);
    } catch (\Exception $e) {
        return "Error al cargar compras: " . $e->getMessage();
    }
});

Route::post('/compras/{id}/estado', function (Request $request, $id) use ($apiUrl) {
    if (!Session::has('admin')) return redirect('/');

    $payload  = ['estado' => $request->input('estado')];
    $response = Http::timeout(5)->put("{$apiUrl}/v1/compras/{$id}/estado", $payload);

    if ($response->successful()) {
        return redirect('/compras')->with('success', 'Estado de compra actualizado');
    } else {
        return redirect('/compras')->with('error', 'Error al actualizar estado');
    }
});

Route::get('/personal', function () {
    if (!Session::has('admin')) return redirect('/');
    return view('empleados.gestion_personal', ['admin' => Session::get('admin')]);
});

Route::post('/admins/agregar', function (Request $request) use ($apiUrl) {
    if (!Session::has('admin')) return redirect('/');

    $payload = [
        "nombre"   => $request->input('nombre'),
        "email"    => $request->input('email'),
        "password" => $request->input('password'),
        "role"     => "admin"
    ];

    $response = Http::timeout(5)->post("{$apiUrl}/v1/auth/register", $payload);

    if ($response->successful()) {
        return redirect('/personal')->with('success', 'Administrador creado exitosamente');
    } else {
        return redirect('/personal')->with('error', 'Error al crear administrador: ' . $response->body());
    }
});

Route::get('/panel-accesos', function () use ($apiUrl) {
    if (!Session::has('admin')) return redirect('/');

    try {
        $response = Http::timeout(5)->get("{$apiUrl}/v1/auth/usuarios/");
        $usuarios = $response->successful() ? $response->json() : [];
        return view('empleados.panel_accesos', [
            'admin'    => Session::get('admin'),
            'usuarios' => $usuarios
        ]);
    } catch (\Exception $e) {
        return "Error al cargar usuarios: " . $e->getMessage();
    }
});

Route::post('/admins/borrar/{id}', function ($id) use ($apiUrl) {
    if (!Session::has('admin')) return redirect('/');

    if (Session::get('admin')['id'] == $id) {
        return redirect('/panel-accesos')->with('error', 'No puedes eliminarte a ti mismo');
    }

    Http::timeout(5)->delete("{$apiUrl}/v1/auth/usuarios/{$id}");
    return redirect('/panel-accesos')->with('success', 'Administrador eliminado');
});

Route::get('/admins/nuevo', function () {
    return redirect('/personal');
});

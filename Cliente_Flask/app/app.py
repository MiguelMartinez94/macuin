import os
import json
import requests
from flask import Flask, render_template, request, session, redirect, url_for, flash, jsonify
from datetime import datetime

app = Flask(__name__)
app.secret_key = os.getenv("FLASK_SECRET_KEY", "super_secret_macuin_key")

API_BASE_URL = os.getenv("API_URL", "http://api:5000")

def obtener_productos():
    try:
        resp = requests.get(f"{API_BASE_URL}/v1/productos", timeout=5)
        resp.raise_for_status()
        return resp.json()
    except Exception:
        return []

@app.route('/api/productos')
def api_productos():
    if 'user' not in session:
        return jsonify([]), 401
    return jsonify(obtener_productos())

@app.route('/')
def home():
    if 'user' in session:
        return redirect(url_for('ventas'))
    return render_template('index.html')

@app.route('/registro', methods=['POST'])
def registro():
    nombre           = request.form.get('nombre')
    email            = request.form.get('email')
    password         = request.form.get('password')
    confirm_password = request.form.get('confirm_password')

    if password != confirm_password:
        flash("Las contraseñas no coinciden")
        return redirect(url_for('home'))

    payload = {
        "nombre":   nombre,
        "email":    email,
        "password": password,
        "role":     "cliente"
    }

    try:
        resp = requests.post(f"{API_BASE_URL}/v1/auth/register", json=payload, timeout=5)
        if resp.status_code == 200:
            flash("Registro exitoso. Por favor inicia sesión.")
            return redirect(url_for('mostrar_login'))
        else:
            flash(resp.json().get("detail", "Error en el registro"))
    except Exception as e:
        flash(f"Error conectando a la API: {e}")

    return redirect(url_for('home'))

@app.route('/login', methods=['GET', 'POST'])
def mostrar_login():
    if request.method == 'GET':
        if 'user' in session:
            return redirect(url_for('ventas'))
        return render_template('login.html')

    email    = request.form.get('email')
    password = request.form.get('password')

    try:
        resp = requests.post(
            f"{API_BASE_URL}/v1/auth/login",
            json={"email": email, "password": password},
            timeout=5
        )
        if resp.status_code == 200:
            user_data = resp.json()
            if user_data.get('role') != 'cliente':
                flash("Esta cuenta es de administrador. Usa el panel adecuado.")
                return redirect(url_for('mostrar_login'))
            session['user'] = user_data
            return redirect(url_for('ventas'))
        else:
            flash("Credenciales incorrectas")
    except Exception as e:
        flash(f"Error conectando a la API: {e}")

    return redirect(url_for('mostrar_login'))

@app.route('/logout')
def logout():
    session.pop('user', None)
    return redirect(url_for('mostrar_login'))

@app.route('/ventas')
def ventas():
    if 'user' not in session:
        return redirect(url_for('mostrar_login'))
    productos = obtener_productos()
    return render_template('pagina_ventas.html', productos=productos)

@app.route('/carrito')
def carrito():
    if 'user' not in session:
        return redirect(url_for('mostrar_login'))
    carrito_items = session.get('carrito', [])
    total = sum(item['precio'] * item['cantidad'] for item in carrito_items)
    return render_template('carrito_ventas.html', carrito=carrito_items, total=total)

@app.route('/carrito/agregar/<sku>', methods=['POST'])
def agregar_carrito(sku):
    if 'user' not in session:
        return redirect(url_for('mostrar_login'))

    productos = obtener_productos()
    producto  = next((p for p in productos if p['sku'] == sku), None)

    if producto and producto['stock'] > 0:
        carrito   = session.get('carrito', [])
        encontrado = False
        for item in carrito:
            if item['sku'] == sku:
                item['cantidad'] += 1
                encontrado = True
                break
        if not encontrado:
            carrito.append({
                'sku':      producto['sku'],
                'nombre':   producto['nombre'],
                'precio':   producto['precio'],
                'categoria': producto['categoria'],
                'cantidad': 1
            })
        session['carrito'] = carrito
        session.modified   = True
        flash(f"{producto['nombre']} agregado al carrito.")

    return redirect(url_for('ventas'))

@app.route('/carrito/eliminar/<int:index>', methods=['POST'])
def eliminar_carrito(index):
    if 'user' not in session:
        return redirect(url_for('mostrar_login'))
    carrito = session.get('carrito', [])
    if 0 <= index < len(carrito):
        carrito.pop(index)
        session['carrito'] = carrito
        session.modified   = True
    return redirect(url_for('carrito'))

@app.route('/carrito/actualizar/<int:index>', methods=['POST'])
def actualizar_carrito(index):
    if 'user' not in session:
        return redirect(url_for('mostrar_login'))
    carrito = session.get('carrito', [])
    if 0 <= index < len(carrito):
        action = request.form.get('action')
        if action == 'add':
            carrito[index]['cantidad'] += 1
        elif action == 'sub' and carrito[index]['cantidad'] > 1:
            carrito[index]['cantidad'] -= 1
        session['carrito'] = carrito
        session.modified   = True
    return redirect(url_for('carrito'))

@app.route('/carrito/pagar', methods=['POST'])
def pagar_carrito():
    if 'user' not in session:
        return redirect(url_for('mostrar_login'))

    carrito = session.get('carrito', [])
    if not carrito:
        flash("El carrito está vacío.")
        return redirect(url_for('carrito'))

    metodo    = request.form.get('metodo', 'Tarjeta')
    total     = sum(item['precio'] * item['cantidad'] for item in carrito)
    historial = session.get('historial', [])

    articulos_str = ", ".join(
        f"{item['cantidad']} x {item['nombre']}" for item in carrito
    )

    nueva_compra = {
        'id':         len(historial) + 1,
        'fecha':      datetime.now().strftime("%d/%m/%Y"),
        'articulos':  articulos_str,
        'items_list': carrito.copy(),
        'total':      total,
        'estado':     'En Proceso',
        'metodo':     metodo.capitalize()
    }

    try:
        user    = session['user']
        payload = {
            "usuario_id":     user['id'],
            "usuario_nombre": user['nombre'],
            "articulos":      articulos_str,
            "total":          total,
            "estado":         "En Proceso",
            "metodo":         metodo.capitalize()
        }
        resp = requests.post(f"{API_BASE_URL}/v1/compras/", json=payload, timeout=5)
        if resp.status_code == 200:
            nueva_compra['id'] = resp.json().get('id', nueva_compra['id'])
    except Exception:
        pass

    historial.insert(0, nueva_compra)
    session['historial']     = historial
    session['ultima_compra'] = nueva_compra
    session['carrito']       = []
    session.modified         = True

    return redirect(url_for('pago'))

@app.route('/historial')
def historial():
    if 'user' not in session:
        return redirect(url_for('mostrar_login'))
    user = session['user']
    try:
        resp = requests.get(f"{API_BASE_URL}/v1/compras/usuario/{user['id']}", timeout=5)
        compras = resp.json() if resp.status_code == 200 else []
    except Exception:
        compras = []
    # Actualizar sesión con lo más reciente (opcional, pero ayuda a mantener consistencia)
    session['historial'] = compras
    return render_template('historial_compras.html', compras=compras)

@app.route('/api/historial')
def api_historial():
    if 'user' not in session:
        return jsonify([]), 401
    user = session['user']
    try:
        resp = requests.get(f"{API_BASE_URL}/v1/compras/usuario/{user['id']}", timeout=5)
        if resp.status_code == 200:
            return jsonify(resp.json())
    except Exception:
        pass
    return jsonify([])

@app.route('/pago')
def pago():
    if 'user' not in session:
        return redirect(url_for('mostrar_login'))
    ultima_compra = session.get('ultima_compra')
    if not ultima_compra:
        return redirect(url_for('ventas'))
    return render_template('pago_exitoso.html', compra=ultima_compra)

if __name__ == "__main__":
    app.run(debug=True, host='0.0.0.0')
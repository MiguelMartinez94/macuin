import requests

payload = {
    "usuario_id": 1,
    "usuario_nombre": "Test User",
    "articulos": "1 x Filtro",
    "total": 150.0,
    "estado": "En Proceso",
    "metodo": "Tarjeta"
}

try:
    resp = requests.post("http://localhost:15001/v1/compras/", json=payload, timeout=5)
    print("STATUS:", resp.status_code)
    print("BODY:", resp.text)
except Exception as e:
    print("Failed:", e)

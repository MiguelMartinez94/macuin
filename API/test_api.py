import sys
from sqlalchemy.orm import Session
from app.database import SessionLocal, engine, Base
from app.models import Producto
from app.schemas import ProductoCreate
from app.routers.productos import crear_producto

# Force create all tables just in case
print("Creating tables...")
Base.metadata.create_all(bind=engine)

print("Creating session...")
db = SessionLocal()

print("Testing payload...")
try:
    payload = ProductoCreate(
        nombre="Filtro de Aceite Test XYZ",
        sku="TEST-002",
        descripcion="Un filtro de prueba",
        precio=150.0,
        stock=10,
        marca_auto="Universal",
        categoria="Motor",
        imagen="motor.png"
    )
    result = crear_producto(payload, db)
    print("SUCCESS: ", result.id)
except Exception as e:
    print("ERROR:", type(e).__name__)
    print(e)
finally:
    db.close()

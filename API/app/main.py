from fastapi import FastAPI, Depends
from sqlalchemy.orm import Session
from app.database import engine, Base, get_db
from app.models import Producto, Usuario, Compra
from app.routers import productos, auth, compras

from contextlib import asynccontextmanager

@asynccontextmanager
async def lifespan(app: FastAPI):
    # Crear tablas al iniciar
    try:
        Base.metadata.create_all(bind=engine)
        print("Tablas de base de datos verificadas/creadas.")
    except Exception as e:
        print(f"Error al conectar con la base de datos durante el inicio: {e}")
    yield

app = FastAPI(
    title="MACUIN API",
    description="API central del sistema MACUIN de autopartes",
    version="1.0.0",
    lifespan=lifespan
)

app.include_router(productos.router)
app.include_router(auth.router)
app.include_router(compras.router)


@app.get("/v1/prueba-db")
async def prueba_base_datos(db: Session = Depends(get_db)):
    return {"mensaje": "Conexión exitosa a la base de datos"}


@app.get("/")
async def root():
    return {"mensaje": "MACUIN API activa", "docs": "/docs"}
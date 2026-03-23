from fastapi import FastAPI, Depends
from sqlalchemy.orm import Session
from app.database import engine, Base, get_db
from app.models import Producto, Usuario, Compra
from app.routers import productos, auth, compras

Base.metadata.create_all(bind=engine)

app = FastAPI(
    title="MACUIN API",
    description="API central del sistema MACUIN de autopartes",
    version="1.0.0"
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
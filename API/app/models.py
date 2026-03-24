from sqlalchemy import Column, Integer, String, Float, Text, DateTime
from sqlalchemy.sql import func
from app.database import Base

class Producto(Base):
    __tablename__ = "productos"

    id = Column(Integer, primary_key=True, index=True)
    nombre = Column(String(150), nullable=False)
    sku = Column(String(50), unique=True, nullable=False)
    descripcion = Column(Text, nullable=True)
    precio = Column(Float, nullable=False)
    stock = Column(Integer, default=0)
    marca_auto = Column(String(100), nullable=True)
    categoria = Column(String(100), nullable=True)
    imagen = Column(String(100), nullable=True)

class Usuario(Base):
    __tablename__ = "usuarios"

    id = Column(Integer, primary_key=True, index=True)
    nombre = Column(String(100), nullable=False)
    email = Column(String(100), unique=True, index=True, nullable=False)
    password = Column(String(200), nullable=False)
    role = Column(String(20), default="cliente")

class Compra(Base):
    __tablename__ = "compras"

    id = Column(Integer, primary_key=True, index=True)
    usuario_id = Column(Integer, nullable=False)
    usuario_nombre = Column(String(100), nullable=False)
    articulos = Column(Text, nullable=False)
    total = Column(Float, nullable=False)
    estado = Column(String(50), default="En Proceso")
    metodo = Column(String(50), nullable=True)
    fecha = Column(DateTime, server_default=func.now())

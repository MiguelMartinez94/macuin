from pydantic import BaseModel
from typing import Optional, List
from datetime import datetime

class ProductoBase(BaseModel):
    nombre: str
    sku: str
    descripcion: Optional[str] = None
    precio: float
    stock: int = 0
    marca_auto: Optional[str] = None
    categoria: Optional[str] = None
    imagen: Optional[str] = None

class ProductoCreate(ProductoBase):
    pass

class ProductoOut(ProductoBase):
    id: int

    class Config:
        from_attributes = True


class UsuarioBase(BaseModel):
    nombre: str
    email: str
    role: Optional[str] = "cliente"

class UsuarioCreate(UsuarioBase):
    password: str

class UsuarioLogin(BaseModel):
    email: str
    password: str

class UsuarioOut(UsuarioBase):
    id: int

    class Config:
        from_attributes = True


class CompraCreate(BaseModel):
    usuario_id: int
    usuario_nombre: str
    articulos: str
    total: float
    estado: Optional[str] = "En Proceso"
    metodo: Optional[str] = None

class CompraUpdate(BaseModel):
    estado: str

class CompraOut(BaseModel):
    id: int
    usuario_id: int
    usuario_nombre: str
    articulos: str
    total: float
    estado: str
    metodo: Optional[str] = None
    fecha: Optional[datetime] = None

    class Config:
        from_attributes = True

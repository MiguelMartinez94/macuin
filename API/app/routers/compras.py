from fastapi import APIRouter, Depends, HTTPException
from sqlalchemy.orm import Session
from typing import List

from app.database import get_db
from app.models import Compra
from app.schemas import CompraCreate, CompraUpdate, CompraOut

router = APIRouter(prefix="/v1/compras", tags=["Compras"])


@router.get("/", response_model=List[CompraOut])
def listar_compras(db: Session = Depends(get_db)):
    return db.query(Compra).order_by(Compra.id.desc()).all()


@router.get("/usuario/{usuario_id}", response_model=List[CompraOut])
def compras_por_usuario(usuario_id: int, db: Session = Depends(get_db)):
    return db.query(Compra).filter(Compra.usuario_id == usuario_id).order_by(Compra.id.desc()).all()


@router.post("/", response_model=CompraOut)
def crear_compra(compra: CompraCreate, db: Session = Depends(get_db)):
    db_compra = Compra(**compra.model_dump())
    db.add(db_compra)
    db.commit()
    db.refresh(db_compra)
    return db_compra


@router.put("/{compra_id}/estado", response_model=CompraOut)
def actualizar_estado(compra_id: int, update: CompraUpdate, db: Session = Depends(get_db)):
    db_compra = db.query(Compra).filter(Compra.id == compra_id).first()
    if not db_compra:
        raise HTTPException(status_code=404, detail="Compra no encontrada")
    db_compra.estado = update.estado
    db.commit()
    db.refresh(db_compra)
    return db_compra

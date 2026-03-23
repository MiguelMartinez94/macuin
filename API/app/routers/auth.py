from fastapi import APIRouter, Depends, HTTPException, status
from sqlalchemy.orm import Session
from app.database import get_db
from app.models import Usuario
from app.schemas import UsuarioCreate, UsuarioLogin, UsuarioOut

router = APIRouter(prefix="/v1/auth", tags=["Auth"])

@router.post("/register", response_model=UsuarioOut)
def register(user_in: UsuarioCreate, db: Session = Depends(get_db)):
    db_user = db.query(Usuario).filter(Usuario.email == user_in.email).first()
    if db_user:
        raise HTTPException(status_code=400, detail="El email ya está registrado")
    new_user = Usuario(
        nombre=user_in.nombre,
        email=user_in.email,
        password=user_in.password,
        role=user_in.role
    )
    db.add(new_user)
    db.commit()
    db.refresh(new_user)
    return new_user

@router.post("/login", response_model=UsuarioOut)
def login(creds: UsuarioLogin, db: Session = Depends(get_db)):
    user = db.query(Usuario).filter(
        Usuario.email == creds.email,
        Usuario.password == creds.password
    ).first()
    if not user:
        raise HTTPException(status_code=401, detail="Credenciales incorrectas")
    return user

@router.get("/usuarios", response_model=list[UsuarioOut])
def list_usuarios(db: Session = Depends(get_db)):
    return db.query(Usuario).all()

@router.delete("/usuarios/{user_id}")
def delete_usuario(user_id: int, db: Session = Depends(get_db)):
    user = db.query(Usuario).filter(Usuario.id == user_id).first()
    if not user:
        raise HTTPException(status_code=404, detail="Usuario no encontrado")
    db.delete(user)
    db.commit()
    return {"mensaje": "Usuario eliminado correctamente"}

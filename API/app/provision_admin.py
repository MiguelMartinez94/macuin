import sys
import os
sys.path.append('/app')
from app.database import SessionLocal
from app.models import Usuario

db = SessionLocal()
try:
    admin_email = "admin@macuin.com"
    admin = db.query(Usuario).filter(Usuario.email == admin_email).first()
    if not admin:
        new_admin = Usuario(
            nombre="Admin Master",
            email=admin_email,
            password="password",
            role="admin"
        )
        db.add(new_admin)
        db.commit()
    else:
        admin.password = "password"
        admin.role = "admin"
        db.commit()
finally:
    db.close()

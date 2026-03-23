import sys
import os

# Ensure we can import from current directory
sys.path.append(os.path.dirname(__file__))

from database import SessionLocal
from models import Usuario

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
        print(f"Admin created: {admin_email}")
    else:
        # Update password just in case it was changed
        admin.password = "password"
        # Ensure role is admin
        admin.role = "admin"
        db.commit()
        print(f"Admin updated and verified: {admin_email}")
finally:
    db.close()

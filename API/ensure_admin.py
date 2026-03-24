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
        print(f"Admin created: {admin_email}")
    else:
        # Update password just in case it was changed
        admin.password = "password"
        db.commit()
        print(f"Admin updated: {admin_email}")
finally:
    db.close()

from sqlalchemy import text
from database import engine

try:
    # Intentamos abrir la conexión y ejecutar una consulta básica
    with engine.connect() as connection:
        connection.execute(text("SELECT 1"))
        print("¡Conexión a PostgreSQL exitosa! Todo listo.")
except Exception as e:
    print(f"Ocurrió un error al conectar con la base de datos:\n{e}")
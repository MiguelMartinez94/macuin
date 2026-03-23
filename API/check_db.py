import os
from sqlalchemy import create_engine, inspect

DATABASE_URL = "postgresql://neondb_owner:npg_1nQOaU0JpPdx@ep-patient-waterfall-a8l2qbsr-pooler.eastus2.azure.neon.tech/neondb?sslmode=require"
engine = create_engine(DATABASE_URL)
inspector = inspect(engine)
tables = inspector.get_table_names()

print("Verifying database tables...")
print(f"Purchases table 'compras' exists: {'compras' in tables}")
if 'compras' in tables:
    with engine.connect() as conn:
        result = conn.execute("SELECT COUNT(*) FROM compras")
        print("Total purchases in DB:", result.scalar())

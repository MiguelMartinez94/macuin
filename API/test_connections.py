import sqlalchemy
from sqlalchemy import create_engine

urls = [
    'postgresql://neondb_owner:npg_ekvO20yQowRU@ep-small-credit-afnhjrxq-pooler.c-2.us-west-2.aws.neon.tech/macuin?sslmode=require',
    'postgresql://neondb_owner:npg_1nQOaU0JpPdx@ep-patient-waterfall-a8l2qbsr-pooler.eastus2.azure.neon.tech/neondb?sslmode=require'
]

for url in urls:
    print(f"Testing URL: {url.split('@')[1]}")
    try:
        engine = create_engine(url)
        with engine.connect() as conn:
            print("  Connection successful!")
    except Exception as e:
        print(f"  Connection failed: {e}")

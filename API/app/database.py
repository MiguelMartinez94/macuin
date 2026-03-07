from sqlalchemy import create_engine
from sqlalchemy.orm import sessionmaker, declarative_base

URL_BASE_DATOS = 'postgresql://neondb_owner:npg_ekvO20yQowRU@ep-small-credit-afnhjrxq-pooler.c-2.us-west-2.aws.neon.tech/macuin?sslmode=require&channel_binding=require'

engine = create_engine(URL_BASE_DATOS)

SessionLocal = sessionmaker(autocommit=False, autoflush=False, bind=engine)

Base = declarative_base()

def get_db():
    db = SessionLocal()
    try:
        yield db
    finally:
        db.close()
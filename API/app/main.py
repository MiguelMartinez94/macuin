from fastapi import FastAPI, Depends
from sqlalchemy.orm import Session
from app.database import engine, Base, get_db
#Aquí se deben de importar los archivos de routers
from  app.routers import example

app = FastAPI(
    title="MACUIN",
    description="Esta es la API que conectará nuestros clientes Laravel y Flask"
)
#Aquí se incluyen los routers que se han creado
app.include_router(example.router)


@app.get("/v1/prueba-db")
async def prueba_base_datos(db: Session = Depends(get_db)):
    
    return {"mensaje": "¡Conexión exitosa a la base de datos remota!"}
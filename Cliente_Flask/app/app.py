from flask import Flask, render_template

app = Flask(__name__)


@app.route('/')
def home():
    return "Hola Flask"

@app.route('/index')
def index():
    return render_template('index.html')


@app.route('/ventas')
def ventas():
    return render_template('pagina_ventas.html')

@app.route('/carrito')
def carrito():
    return render_template('carrito_ventas.html')

@app.route('/historial')
def historial():
    return render_template('historial_compras.html')

@app.route('/pago')
def pago():
    return render_template('pago_exitoso.html')


if __name__ == "__main__":
    app.run()